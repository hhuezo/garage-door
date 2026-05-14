<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsCard;
use App\Models\AboutUsContent;
use App\Models\Page;
use App\Models\ServicesCard;
use App\Models\ServicesContent;
use App\Support\MaterialIconOptions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PageController extends Controller
{
    /** Subcarpeta de public/images para subidas gestionadas de About Us (hero, logo Valores, etc.). */
    private const ABOUT_US_SECTION_IMAGES_DIR = 'about_us';

    /** Subcarpeta de public/images para la página Servicios (cabecera con imagen). */
    private const SERVICES_SECTION_IMAGES_DIR = 'services';

    /** Prefijo de archivos de imagen de tarjeta Servicios subidos por el CMS (solo esos se borran al reemplazar o quitar). */
    private const SERVICES_CARD_UPLOAD_PREFIX = 'services-card-';

    public function index(): View
    {
        $pages = Page::query()
            ->orderBy('name')
            ->get();

        return view('admin.pages.index', [
            'pages' => $pages,
        ]);
    }

    public function edit(int $id): View|RedirectResponse
    {
        $page = Page::query()->findOrFail($id);

        if ($page->slug === 'about-us') {
            $page->load(['aboutUsContent.cards']);

            return view('admin.pages.edit', [
                'page' => $page,
            ]);
        }

        if ($page->slug === 'services') {
            $page->load(['servicesContent.cards']);

            return view('admin.pages.edit', [
                'page' => $page,
            ]);
        }

        return redirect()
            ->route('pages.index')
            ->with('error', 'Esta página aún no tiene editor en el panel.');
    }

    public function updateAboutUs(Request $request, int $id): RedirectResponse
    {
        $page = Page::query()->findOrFail($id);
        if ($page->slug !== 'about-us') {
            abort(404);
        }

        $request->validate([
            'about_content' => ['nullable', 'array'],
            'about_content.hero_eyebrow' => ['sometimes', 'nullable', 'string', 'max:255'],
            'about_content.hero_title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'about_content.intro' => ['sometimes', 'nullable', 'string', 'max:65535'],
            'about_hero_image' => ['nullable', 'image', 'max:8192'],
            'about_remove_hero_image' => ['sometimes', 'boolean'],
            'about_content.intro_icon' => ['sometimes', 'nullable', 'string', 'max:64', Rule::in(array_keys(MaterialIconOptions::aboutIntroIcons()))],
            'about_content.values_section_heading' => ['sometimes', 'nullable', 'string', 'max:255'],
            'about_values_section_logo' => ['nullable', 'image', 'max:8192'],
            'about_remove_values_section_logo' => ['sometimes', 'boolean'],
            'about_cards' => ['nullable', 'array'],
            'about_cards.*' => ['nullable', 'array'],
            'about_cards.*.title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'about_cards.*.body' => ['sometimes', 'nullable', 'string', 'max:65535'],
            'about_cards.*.icon' => ['sometimes', 'nullable', 'string', 'max:64', Rule::in(array_keys(MaterialIconOptions::aboutValueCardIcons()))],
        ]);

        DB::transaction(function () use ($request, $page) {
            $about = AboutUsContent::query()->firstOrCreate(
                ['page_id' => $page->id],
                [
                    'hero_eyebrow' => '',
                    'hero_title' => '',
                    'intro' => '',
                ]
            );

            $incoming = $request->input('about_content');
            if (is_array($incoming)) {
                foreach (['hero_eyebrow', 'hero_title', 'intro', 'values_section_heading'] as $field) {
                    if (array_key_exists($field, $incoming)) {
                        $about->{$field} = $incoming[$field];
                    }
                }
                if (array_key_exists('intro_icon', $incoming)) {
                    $this->deleteAboutManagedUpload($about->intro_icon_filename, 'about-us-intro-');
                    $about->intro_icon_filename = null;
                    $pick = $incoming['intro_icon'];
                    $about->intro_icon = ($pick !== '' && $pick !== null) ? (string) $pick : null;
                }
            }

            if ($request->boolean('about_remove_hero_image')) {
                $this->deleteAboutManagedUpload($about->hero_image_filename, 'about-us-hero-');
                $about->hero_image_filename = null;
            }

            if ($request->hasFile('about_hero_image')) {
                $file = $request->file('about_hero_image');
                if (! $file instanceof UploadedFile || ! $file->isValid()) {
                    throw ValidationException::withMessages([
                        'about_hero_image' => ['No se pudo subir la imagen principal.'],
                    ]);
                }
                $this->deleteAboutManagedUpload($about->hero_image_filename, 'about-us-hero-');
                $about->hero_image_filename = $this->storeAboutUploadInPublicImages(
                    $file,
                    'about-us-hero-',
                    ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    'about_hero_image',
                    self::ABOUT_US_SECTION_IMAGES_DIR
                );
            }

            if ($request->boolean('about_remove_values_section_logo')) {
                $this->deleteAboutManagedUpload($about->values_section_logo_filename, 'about-us-values-logo-');
                $about->values_section_logo_filename = null;
            }

            if ($request->hasFile('about_values_section_logo')) {
                $file = $request->file('about_values_section_logo');
                if (! $file instanceof UploadedFile || ! $file->isValid()) {
                    throw ValidationException::withMessages([
                        'about_values_section_logo' => ['No se pudo subir el logo de la sección Valores.'],
                    ]);
                }
                $this->deleteAboutManagedUpload($about->values_section_logo_filename, 'about-us-values-logo-');
                $about->values_section_logo_filename = $this->storeAboutUploadInPublicImages(
                    $file,
                    'about-us-values-logo-',
                    ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    'about_values_section_logo',
                    self::ABOUT_US_SECTION_IMAGES_DIR
                );
            }

            $allowedCardIds = $about->cards()->pluck('id')->all();
            foreach ($request->input('about_cards', []) as $cardId => $fields) {
                $cardId = (int) $cardId;
                if (! in_array($cardId, $allowedCardIds, true) || ! is_array($fields)) {
                    continue;
                }
                $card = AboutUsCard::query()
                    ->where('id', $cardId)
                    ->where('about_us_content_id', $about->id)
                    ->first();
                if (! $card) {
                    continue;
                }
                if (! array_key_exists('title', $fields) && ! array_key_exists('body', $fields) && ! array_key_exists('icon', $fields)) {
                    continue;
                }
                $iconRaw = $fields['icon'] ?? null;
                $icon = array_key_exists('icon', $fields)
                    ? ((is_string($iconRaw) && $iconRaw !== '') ? $iconRaw : null)
                    : $card->icon;
                $card->update([
                    'title' => array_key_exists('title', $fields) ? $fields['title'] : $card->title,
                    'body' => array_key_exists('body', $fields) ? $fields['body'] : $card->body,
                    'icon' => $icon,
                    'image_filename' => null,
                    'link_label' => null,
                    'link_url' => null,
                ]);
            }

            $about->save();

            $page->touch();
        });

        return redirect()
            ->route('pages.edit', ['id' => $page->id])
            ->with('success', 'Contenido About Us guardado. Recarga la vista previa si hace falta.');
    }

    public function updateServices(Request $request, int $id): RedirectResponse
    {
        $page = Page::query()->findOrFail($id);
        if ($page->slug !== 'services') {
            abort(404);
        }

        $request->validate([
            'services_content' => ['nullable', 'array'],
            'services_content.hero_title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'services_content.hero_lead' => ['sometimes', 'nullable', 'string', 'max:65535'],
            'services_hero_image' => ['nullable', 'image', 'max:8192'],
            'services_remove_hero_image' => ['sometimes', 'boolean'],
            'services_cards' => ['nullable', 'array'],
            'services_cards.*' => ['nullable', 'array'],
            'services_cards.*.title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'services_cards.*.body' => ['sometimes', 'nullable', 'string', 'max:65535'],
            'services_cards.*.icon' => ['sometimes', 'nullable', 'string', 'max:64', Rule::in(array_keys(MaterialIconOptions::serviceCardIcons()))],
            'services_cards.*.theme' => ['sometimes', 'nullable', 'string', 'max:16', Rule::in(['light', 'accent'])],
            'services_card_images' => ['nullable', 'array'],
            'services_card_images.*' => ['nullable', 'image', 'max:8192'],
            'services_card_remove' => ['nullable', 'array'],
            'services_card_remove.*' => ['sometimes', 'boolean'],
        ]);

        DB::transaction(function () use ($request, $page) {
            $content = ServicesContent::query()->firstOrCreate(
                ['page_id' => $page->id],
                [
                    'hero_title' => 'Servicios',
                    'hero_lead' => '',
                ]
            );

            $incoming = $request->input('services_content');
            if (is_array($incoming)) {
                foreach (['hero_title', 'hero_lead'] as $field) {
                    if (array_key_exists($field, $incoming)) {
                        $content->{$field} = $incoming[$field];
                    }
                }
            }

            if ($request->boolean('services_remove_hero_image')) {
                $this->deleteAboutManagedUpload($content->hero_image_filename, 'services-hero-');
                $content->hero_image_filename = null;
            }

            if ($request->hasFile('services_hero_image')) {
                $file = $request->file('services_hero_image');
                if (! $file instanceof UploadedFile || ! $file->isValid()) {
                    throw ValidationException::withMessages([
                        'services_hero_image' => ['No se pudo subir la imagen de la cabecera.'],
                    ]);
                }
                $this->deleteAboutManagedUpload($content->hero_image_filename, 'services-hero-');
                $content->hero_image_filename = $this->storeAboutUploadInPublicImages(
                    $file,
                    'services-hero-',
                    ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    'services_hero_image',
                    self::SERVICES_SECTION_IMAGES_DIR
                );
            }

            $allowedCardIds = $content->cards()->pluck('id')->all();
            foreach ($request->input('services_cards', []) as $cardId => $fields) {
                $cardId = (int) $cardId;
                if (! in_array($cardId, $allowedCardIds, true) || ! is_array($fields)) {
                    continue;
                }
                $card = ServicesCard::query()
                    ->where('id', $cardId)
                    ->where('services_content_id', $content->id)
                    ->first();
                if (! $card) {
                    continue;
                }
                if (! array_key_exists('title', $fields) && ! array_key_exists('body', $fields) && ! array_key_exists('icon', $fields) && ! array_key_exists('theme', $fields)) {
                    continue;
                }
                $iconRaw = $fields['icon'] ?? null;
                $icon = array_key_exists('icon', $fields)
                    ? ((is_string($iconRaw) && $iconRaw !== '') ? $iconRaw : null)
                    : $card->icon;
                $themeRaw = $fields['theme'] ?? null;
                $theme = $card->theme;
                if (array_key_exists('theme', $fields) && is_string($themeRaw) && in_array($themeRaw, ['light', 'accent'], true)) {
                    $theme = $themeRaw;
                }
                $card->update([
                    'title' => array_key_exists('title', $fields) ? $fields['title'] : $card->title,
                    'body' => array_key_exists('body', $fields) ? $fields['body'] : $card->body,
                    'icon' => $icon,
                    'theme' => $theme,
                ]);
            }

            foreach ($allowedCardIds as $cardId) {
                $card = ServicesCard::query()
                    ->where('id', $cardId)
                    ->where('services_content_id', $content->id)
                    ->first();
                if (! $card) {
                    continue;
                }
                if ($request->boolean('services_card_remove.'.$cardId)) {
                    $this->deleteAboutManagedUpload($card->image_path, self::SERVICES_CARD_UPLOAD_PREFIX);
                    $card->image_path = null;
                    $card->save();

                    continue;
                }
                if ($request->hasFile('services_card_images.'.$cardId)) {
                    $file = $request->file('services_card_images.'.$cardId);
                    if (! $file instanceof UploadedFile || ! $file->isValid()) {
                        throw ValidationException::withMessages([
                            'services_card_images.'.$cardId => ['No se pudo subir la imagen de la tarjeta.'],
                        ]);
                    }
                    $this->deleteAboutManagedUpload($card->image_path, self::SERVICES_CARD_UPLOAD_PREFIX);
                    $card->image_path = $this->storeAboutUploadInPublicImages(
                        $file,
                        self::SERVICES_CARD_UPLOAD_PREFIX,
                        ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                        'services_card_images.'.$cardId,
                        self::SERVICES_SECTION_IMAGES_DIR
                    );
                    $card->save();
                }
            }

            $content->save();

            $page->touch();
        });

        return redirect()
            ->route('pages.edit', ['id' => $page->id])
            ->with('success', 'Contenido Servicios guardado. Recarga el sitio público si hace falta.');
    }

    private function deleteAboutManagedUpload(?string $filename, string $prefix): void
    {
        if ($filename === null || $filename === '' || str_contains($filename, '..')) {
            return;
        }
        $normalized = str_replace('\\', '/', $filename);
        $base = basename($normalized);
        if ($base === '' || ! str_starts_with($base, $prefix)) {
            return;
        }
        $path = public_path('images/'.$normalized);
        if (is_file($path)) {
            @unlink($path);
        }
    }

    /**
     * @param  list<string>  $allowedExtensions
     */
    private function storeAboutUploadInPublicImages(
        UploadedFile $file,
        string $basenamePrefix,
        array $allowedExtensions,
        string $errorKey,
        ?string $relativeSubdirectory = null,
    ): string {
        $ext = strtolower((string) ($file->getClientOriginalExtension() ?: $file->guessExtension()));
        if ($ext === 'jpeg') {
            $ext = 'jpg';
        }
        if (! in_array($ext, $allowedExtensions, true)) {
            throw ValidationException::withMessages([
                $errorKey => ['Tipo de archivo no permitido: '.implode(', ', $allowedExtensions).'.'],
            ]);
        }

        $name = $basenamePrefix.Str::lower(Str::random(12)).'.'.$ext;
        $subdir = $relativeSubdirectory !== null && $relativeSubdirectory !== ''
            ? trim(str_replace('\\', '/', $relativeSubdirectory), '/')
            : '';
        if ($subdir !== '' && ! preg_match('/^[a-z0-9_-]+$/', $subdir)) {
            throw ValidationException::withMessages([
                $errorKey => ['Ruta de subida no válida.'],
            ]);
        }

        $dir = $subdir !== ''
            ? public_path('images/'.$subdir)
            : public_path('images');
        if (! is_dir($dir)) {
            if (! mkdir($dir, 0755, true) && ! is_dir($dir)) {
                throw ValidationException::withMessages([
                    $errorKey => ['No se pudo crear el directorio de imágenes.'],
                ]);
            }
        }

        $file->move($dir, $name);

        return $subdir !== '' ? $subdir.'/'.$name : $name;
    }
}
