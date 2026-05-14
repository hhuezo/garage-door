{{-- Editor About Us: datos en about_us_contents / about_us_cards --}}
@php
    $aboutContent = $page->aboutUsContent;
    $aboutCards = $aboutContent?->cards ?? collect();
    $heroImageFilename = $aboutContent?->hero_image_filename;
    $introIconFileUrl = \App\Support\CmsPage::introIconFileUrl($aboutContent?->intro_icon_filename);
    $introIconChoices = \App\Support\MaterialIconOptions::aboutIntroIcons();
    $selectedIntroIcon = old('about_content.intro_icon', $aboutContent?->intro_icon ?? 'engineering');
    if (! array_key_exists($selectedIntroIcon, $introIconChoices)) {
        $selectedIntroIcon = 'engineering';
    }
    $introIconName = \App\Support\CmsPage::materialIconOrDefault($aboutContent?->intro_icon);
    $valuesSectionHeadingRaw = old('about_content.values_section_heading', $aboutContent?->values_section_heading);
    $valuesSectionHeading = ($valuesSectionHeadingRaw !== null && $valuesSectionHeadingRaw !== '') ? (string) $valuesSectionHeadingRaw : 'Valores';
    $valuesSectionLogoUrl = ($aboutContent && $aboutContent->values_section_logo_filename)
        ? \App\Support\CmsPage::imageUrlFromFilename($aboutContent->values_section_logo_filename)
        : null;
    $formId = 'form-about-us';
@endphp

@push('styles')
<style data-purpose="about-us-cms">
    .about-us-cms .card-notched {
        clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 85% 100%, 0% 100%);
    }
    .about-us-cms .badge-notched {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 15% 100%);
    }
    .about-us-cms .image-notched {
        clip-path: polygon(0% 0%, 100% 0%, 100% 80%, 80% 100%, 0% 100%);
    }
    .about-us-cms.about-us-main > .house-outline-bg {
        position: absolute;
        right: -5%;
        top: 5%;
        width: 50%;
        height: 70%;
        pointer-events: none;
        z-index: 0;
        opacity: 0.4;
    }
    .about-us-cms.about-us-main > .house-outline-bg svg {
        width: 100%;
        height: 100%;
    }
    /* Círculo perfecto: mismo ancho/alto + border-radius 50% (evita que otras hojas de estilo lo dejen como cuadrado redondeado) */
    .about-us-cms .about-us-card-icon-bubble {
        box-sizing: border-box;
        width: 5.75rem;
        height: 5.75rem;
        min-width: 5.75rem;
        min-height: 5.75rem;
        max-width: 5.75rem;
        max-height: 5.75rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        overflow: hidden;
    }
    .about-us-cms .about-us-card-icon-bubble .material-symbols-outlined {
        font-size: 2.5rem;
        line-height: 1;
    }
    @media (min-width: 768px) {
        .about-us-cms .about-us-card-icon-bubble {
            width: 6.75rem;
            height: 6.75rem;
            min-width: 6.75rem;
            min-height: 6.75rem;
            max-width: 6.75rem;
            max-height: 6.75rem;
        }
        .about-us-cms .about-us-card-icon-bubble .material-symbols-outlined {
            font-size: 3rem;
        }
    }
</style>
@endpush

<div class="about-us-edit">
    <div class="bg-[#f0f3f8]">
        <div class="mx-auto w-full max-w-screen-2xl px-6 py-12 sm:px-8 md:py-20 lg:px-12 xl:px-14">
            <main class="about-us-cms about-us-main relative w-full font-body text-gray-800">
                <div class="house-outline-bg hidden lg:block" aria-hidden="true">
                    <svg fill="none" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 150 L200 50 L350 150 V350 H50 Z" fill="transparent" stroke="white" stroke-width="40"></path>
                    </svg>
                </div>

                @if ($aboutContent)
                <button type="button" class="btn btn-primary shadow-sm position-absolute top-0 end-0 m-2" style="z-index: 30;" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-about-content" aria-controls="offcanvas-about-content">
                    Editar textos e imagen
                </button>
                <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-about-content" aria-labelledby="offcanvas-about-content-label" data-bs-scroll="true">
                    <div class="offcanvas-header border-bottom flex-shrink-0">
                        <h5 class="offcanvas-title" id="offcanvas-about-content-label">Textos — About us</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                    </div>
                    <div class="offcanvas-body flex-grow-1 overflow-auto">
                        <div class="form-group">
                            <label class="form-label" for="about-hero-title">Título principal</label>
                            <textarea class="form-control" id="about-hero-title" rows="3" form="{{ $formId }}"
                                name="about_content[hero_title]">{{ old('about_content.hero_title', $aboutContent->hero_title) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="about-hero-eyebrow">Subtítulo / eyebrow</label>
                            <input type="text" class="form-control" id="about-hero-eyebrow" form="{{ $formId }}"
                                name="about_content[hero_eyebrow]"
                                value="{{ old('about_content.hero_eyebrow', $aboutContent->hero_eyebrow) }}" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="about-intro-body">Intro (párrafo)</label>
                            <textarea class="form-control" id="about-intro-body" rows="6" form="{{ $formId }}"
                                name="about_content[intro]">{{ old('about_content.intro', $aboutContent->intro) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label d-block">Imagen principal (columna izquierda)</label>
                            <div class="text-center mb-2">
                                @if ($heroImageFilename)
                                    <img src="{{ \App\Support\CmsPage::imageUrlFromFilename($heroImageFilename) }}" alt="" class="img-fluid rounded border" style="max-height: 140px; object-fit: cover;">
                                @else
                                    <span class="form-text text-muted d-block text-start">Sin imagen propia; se usará la de la primera tarjeta de «Valores» si existe.</span>
                                @endif
                            </div>
                            <input type="file" class="form-control cms-offcanvas-file-input" id="about-hero-image" form="{{ $formId }}" name="about_hero_image" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="about-remove-hero" name="about_remove_hero_image">
                                <label class="form-check-label" for="about-remove-hero">Quitar imagen principal (y archivo subido por el sistema, si aplica)</label>
                            </div>
                            <span class="form-text text-muted">JPG, PNG, GIF o WebP (máx. 8&nbsp;MB). Se guarda en <code>public/images/about_us/</code> con nombre único.</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="about-intro-icon-select">Icono Material junto al intro</label>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <span class="material-symbols-outlined text-primary border rounded p-2 bg-white" style="font-size: 2.25rem; line-height: 1;" id="about-intro-icon-preview">{{ $selectedIntroIcon }}</span>
                                <select name="about_content[intro_icon]" id="about-intro-icon-select" class="form-select flex-grow-1 js-cms-material-icon-select" style="min-width: 12rem;" form="{{ $formId }}"
                                    data-icon-preview="about-intro-icon-preview">
                                    @foreach ($introIconChoices as $val => $lab)
                                        <option value="{{ $val }}" @selected($selectedIntroIcon === $val)>{{ $lab }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($introIconFileUrl)
                                <span class="form-text text-warning d-block mt-1">Había un icono como archivo; al guardar se usará solo el Material elegido y se quitará el archivo del sistema (si era subida automática).</span>
                            @endif
                            <span class="form-text text-muted d-block mt-1">Iconos de Google Material Symbols (misma fuente que el sitio público).</span>
                        </div>

                        <hr class="my-4">
                        <h6 class="text-muted text-uppercase small mb-3">Sección «Valores»</h6>
                        <div class="form-group">
                            <label class="form-label" for="about-values-heading">Título de la sección</label>
                            <input type="text" class="form-control" id="about-values-heading" form="{{ $formId }}"
                                name="about_content[values_section_heading]"
                                value="{{ old('about_content.values_section_heading', $aboutContent->values_section_heading ?? 'Valores') }}" maxlength="255" placeholder="Valores">
                            <span class="form-text text-muted">Texto del encabezado que aparece sobre las tarjetas (p. ej. «Valores»).</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label d-block" for="about-values-logo">Logo junto al nombre (imagen)</label>
                            @if ($valuesSectionLogoUrl)
                                <div class="mb-2 text-center">
                                    <img src="{{ $valuesSectionLogoUrl }}" alt="" class="img-fluid rounded border" style="max-height: 72px; object-fit: contain;">
                                </div>
                            @endif
                            <input type="file" class="form-control cms-offcanvas-file-input" id="about-values-logo" form="{{ $formId }}" name="about_values_section_logo" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="about-remove-values-logo" name="about_remove_values_section_logo">
                                <label class="form-check-label" for="about-remove-values-logo">Quitar logo (vuelve el dibujo por defecto)</label>
                            </div>
                            <span class="form-text text-muted">Si no subes imagen, se muestra el recuadro decorativo. JPG, PNG, GIF o WebP (máx. 8&nbsp;MB). Se guarda en <code>public/images/about_us/</code>.</span>
                        </div>
                    </div>
                    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                    </div>
                </div>
                @endif

                @if (! $aboutContent)
                    <p class="alert alert-warning relative z-10 small">No hay registro en <code>about_us_contents</code> para esta página. Ejecuta migraciones y seed o crea el contenido desde la base de datos.</p>
                @endif

                <header class="mb-12 relative z-10">
                    <h1 class="font-headline text-5xl md:text-6xl font-extrabold text-[#0b3169] mb-2 leading-tight">{{ $aboutContent?->hero_title ?: 'Built on family, trust, and craftsmanship.' }}</h1>
                    <p class="font-headline text-xl font-bold text-on-primary-container mb-0">{{ $aboutContent?->hero_eyebrow ?: 'About Twins Garage Doors' }}</p>
                </header>

                <section class="relative grid grid-cols-1 lg:grid-cols-2 gap-16 items-start mb-24">
                    <div class="relative z-10">
                        <div class="image-notched bg-white">
                            @if ($heroImageFilename)
                                <img alt="" class="w-full h-auto object-cover min-h-[400px] md:min-h-[500px]" src="{{ \App\Support\CmsPage::imageUrlFromFilename($heroImageFilename) }}">
                            @else
                                <div class="min-h-[400px] bg-slate-200 flex items-center justify-center text-slate-500 text-sm">Sin imagen</div>
                            @endif
                        </div>
                    </div>

                    <div class="relative z-10 lg:pt-8">
                        <div class="flex flex-col gap-6">
                            <div class="flex items-start gap-5">
                                <div class="bg-secondary-container/50 p-4 rounded-full flex items-center justify-center shrink-0">
                                    @if ($introIconFileUrl)
                                        <img src="{{ $introIconFileUrl }}" alt="" class="h-9 w-9 object-contain">
                                    @else
                                        <span class="material-symbols-outlined text-[#0b3169] text-3xl font-bold">{{ $introIconName }}</span>
                                    @endif
                                </div>
                                <div class="space-y-4 text-[#0b3169]/80 leading-relaxed text-lg">
                                    <p class="whitespace-pre-wrap">{{ $aboutContent?->intro }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="relative z-10 mb-12 flex flex-col items-start text-left">
                    @if ($valuesSectionLogoUrl)
                        <div class="mb-4 flex justify-start">
                            <img src="{{ $valuesSectionLogoUrl }}" alt="" class="max-h-24 max-w-24 object-contain sm:max-h-28 sm:max-w-28 md:max-h-32 md:max-w-32">
                        </div>
                    @endif
                    <h3 class="font-headline text-3xl md:text-4xl font-bold text-on-primary-container">{{ $valuesSectionHeading }}</h3>
                </section>

                @if ($aboutCards->isNotEmpty())
                    <section class="relative z-10 grid grid-cols-1 gap-10 pt-2 md:grid-cols-3 md:pt-0">
                        @foreach ($aboutCards as $card)
                            @php
                                $iconName = \App\Support\CmsPage::materialIconFromStored($card->icon, $loop->index);
                                $isFirst = $loop->first;
                                $valueCardDrawerId = 'offcanvas-about-value-card-'.$card->id;
                            @endphp
                            <div class="relative z-10 flex h-full flex-col position-relative">
                                <div class="about-us-card-icon-bubble absolute left-12 top-8 z-20 shrink-0 -translate-y-1/2 {{ $isFirst ? 'bg-on-primary-container' : 'bg-secondary-container' }}">
                                    <span class="material-symbols-outlined {{ $isFirst ? 'text-white' : 'text-[#0b3169]' }}">{{ $iconName }}</span>
                                </div>
                                @if ($isFirst)
                                    <div class="card-notched mt-8 flex min-h-[420px] md:min-h-[480px] flex-grow flex-col overflow-hidden bg-[#0b3169] px-8 md:px-12 pb-16 md:pb-20 pt-16 md:pt-20 text-white shadow-2xl">
                                        <h4 class="mb-4 md:mb-6 font-headline text-3xl md:text-4xl font-bold text-on-primary-container">{{ $card->title }}</h4>
                                        <p class="mb-auto text-base leading-relaxed opacity-90">{{ $card->body }}</p>
                                    </div>
                                @else
                                    <div class="card-notched mt-8 flex min-h-[420px] md:min-h-[480px] flex-grow flex-col overflow-hidden bg-white px-8 md:px-12 pb-16 md:pb-20 pt-16 md:pt-20 text-[#0b3169] shadow-lg">
                                        <h4 class="mb-4 md:mb-6 font-headline text-3xl md:text-4xl font-bold text-on-primary-container">{{ $card->title }}</h4>
                                        <p class="mb-auto text-base font-medium leading-relaxed text-gray-600">{{ $card->body }}</p>
                                    </div>
                                @endif
                                <button type="button" class="btn btn-sm btn-outline-primary shadow-sm position-absolute top-0 end-0 m-2" style="z-index: 25;" data-bs-toggle="offcanvas" data-bs-target="#{{ $valueCardDrawerId }}" aria-controls="{{ $valueCardDrawerId }}">
                                    Editar tarjeta
                                </button>
                            </div>
                        @endforeach
                    </section>
                @else
                    <p class="text-on-surface-variant text-sm relative z-10">No hay tarjetas configuradas para esta página.</p>
                @endif
            </main>
        </div>
    </div>
</div>
