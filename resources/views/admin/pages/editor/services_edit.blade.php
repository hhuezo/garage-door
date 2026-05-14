{{-- Editor Servicios: services_contents / services_cards --}}
@php
    $servicesContent = $page->servicesContent;
    $serviceCards = $servicesContent?->cards ?? collect();
    $cabeceraImageFilename = $servicesContent?->hero_image_filename;
    $formId = 'form-services';
@endphp

@push('styles')
<style data-purpose="services-cms-editor">
    .services-diagonal-cut {
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 40px), calc(100% - 40px) 100%, 0 100%);
    }
    .services-image-mask {
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 60px), calc(100% - 60px) 100%, 0 100%);
    }
</style>
@endpush

<div class="services-edit">
    <div class="bg-surface">
        <div class="mx-auto w-full max-w-screen-2xl px-6 py-12 sm:px-8 md:py-16 lg:px-12 xl:px-14">
            <main class="font-body text-on-surface position-relative">
                @if ($servicesContent)
                <button type="button" class="btn btn-primary shadow-sm position-absolute top-0 end-0 m-2" style="z-index: 30;" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-services-cabecera" aria-controls="offcanvas-services-cabecera">
                    Editar textos e imagen
                </button>
                    <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-services-cabecera" aria-labelledby="offcanvas-services-cabecera-label" data-bs-scroll="true">
                        <div class="offcanvas-header border-bottom flex-shrink-0">
                            <h5 class="offcanvas-title" id="offcanvas-services-cabecera-label">Textos — Servicios</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                        </div>
                        <div class="offcanvas-body flex-grow-1 overflow-auto">
                            <div class="form-group">
                                <label class="form-label" for="services-cabecera-title">Título (H1)</label>
                                <input type="text" class="form-control" id="services-cabecera-title" form="{{ $formId }}"
                                    name="services_content[hero_title]"
                                    value="{{ old('services_content.hero_title', $servicesContent->hero_title) }}" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="services-cabecera-lead">Texto introductorio</label>
                                <textarea class="form-control" id="services-cabecera-lead" rows="8" form="{{ $formId }}"
                                    name="services_content[hero_lead]">{{ old('services_content.hero_lead', $servicesContent->hero_lead) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label d-block">Imagen de la cabecera (columna izquierda)</label>
                                <div class="text-center mb-2">
                                    @if ($cabeceraImageFilename)
                                        <img src="{{ \App\Support\CmsPage::imageUrlFromFilename($cabeceraImageFilename) }}" alt="" class="img-fluid rounded border" style="max-height: 140px; object-fit: cover;">
                                    @else
                                        <span class="form-text text-muted d-block text-start">Sin imagen propia; se usará una imagen por defecto en la vista previa.</span>
                                    @endif
                                </div>
                                <input type="file" class="form-control cms-offcanvas-file-input" id="services-cabecera-image" form="{{ $formId }}" name="services_hero_image" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="services-remove-cabecera-imagen" name="services_remove_hero_image">
                                    <label class="form-check-label" for="services-remove-cabecera-imagen">Quitar imagen de la cabecera (y archivo subido por el sistema, si aplica)</label>
                                </div>
                                <span class="form-text text-muted">JPG, PNG, GIF o WebP (máx. 8&nbsp;MB). Se guarda en <code>public/images/services/</code> con nombre único.</span>
                            </div>
                        </div>
                        <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                        </div>
                    </div>
                @endif

                @if (! $servicesContent)
                    <p class="alert alert-warning">No hay registro en <code>services_contents</code>. Ejecuta migraciones y <code>php artisan db:seed --class=SiteContentSeeder</code>.</p>
                @endif

                <section class="relative mb-12 overflow-hidden bg-primary-container p-8 md:p-12 lg:mb-16">
                    <div class="flex flex-col items-center gap-10 lg:flex-row lg:gap-12">
                        <div class="w-full lg:w-1/2">
                            <img
                                class="services-image-mask h-[320px] w-full object-cover md:h-[400px]"
                                alt=""
                                src="{{ $cabeceraImageFilename ? \App\Support\CmsPage::imageUrlFromFilename($cabeceraImageFilename) : \App\Support\CmsPage::publicImageOrUrl(null) }}"
                            />
                        </div>
                        <div class="w-full space-y-6 lg:w-1/2">
                            <h1 class="font-headline text-4xl font-black text-on-primary md:text-5xl">{{ $servicesContent?->hero_title ?: 'Servicios' }}</h1>
                            <p class="text-lg leading-relaxed text-on-primary-container md:text-xl whitespace-pre-wrap">{{ $servicesContent?->hero_lead }}</p>
                        </div>
                    </div>
                </section>

                @if ($serviceCards->isNotEmpty())
                    <section class="grid grid-cols-1 gap-10 md:grid-cols-2 md:gap-12 lg:grid-cols-3">
                        @foreach ($serviceCards as $card)
                            @php
                                $isAccent = ($card->theme ?? 'light') === 'accent';
                                $iconName = \App\Support\CmsPage::materialIconFromStored($card->icon, $loop->index);
                                $imgSrc = \App\Support\CmsPage::publicImageOrUrl($card->image_path);
                                $drawerId = 'offcanvas-services-card-'.$card->id;
                            @endphp
                            <div class="services-diagonal-cut group relative flex flex-col overflow-hidden transition-transform duration-300 hover:-translate-y-2 {{ $isAccent ? 'bg-secondary text-on-secondary' : 'bg-surface-container-lowest' }}">
                                <div class="relative">
                                    <img class="h-56 w-full object-cover" alt="{{ $card->title }}" src="{{ $imgSrc }}"/>
                                    <div class="absolute -bottom-6 right-6 flex h-12 w-12 items-center justify-center rounded-full border-4 {{ $isAccent ? 'border-secondary bg-primary-container' : 'border-surface-container-lowest bg-secondary-container' }}">
                                        <span class="material-symbols-outlined {{ $isAccent ? 'text-on-primary' : 'text-primary' }}">{{ $iconName }}</span>
                                    </div>
                                </div>
                                <div class="space-y-4 p-8">
                                    <h3 class="font-headline text-xl font-bold {{ $isAccent ? 'text-on-primary' : 'text-primary' }} md:text-2xl">{{ $card->title }}</h3>
                                    <p class="text-base leading-relaxed {{ $isAccent ? 'text-secondary-fixed' : 'text-on-surface-variant' }}">{{ $card->body }}</p>
                                    <div class="flex items-end justify-between pt-4">
                                        <a href="{{ url('/#contacto') }}" class="flex items-center gap-2 font-headline text-sm font-bold uppercase tracking-wide transition-all hover:gap-4 {{ $isAccent ? 'text-on-primary' : 'text-secondary' }}">
                                            Leer más
                                            <span class="material-symbols-outlined text-sm">double_arrow</span>
                                        </a>
                                        <span class="font-headline text-[10px] font-black uppercase opacity-20 {{ $isAccent ? 'text-on-primary' : 'text-primary' }}">TGD</span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary shadow-sm position-absolute top-0 end-0 m-2" style="z-index: 25;" data-bs-toggle="offcanvas" data-bs-target="#{{ $drawerId }}" aria-controls="{{ $drawerId }}">
                                    Editar tarjeta
                                </button>
                            </div>
                        @endforeach
                    </section>
                @else
                    <p class="text-on-surface-variant text-sm">No hay tarjetas en <code>services_cards</code>.</p>
                @endif

                <div class="mt-16 flex flex-wrap items-center justify-center gap-8 md:mt-24 lg:justify-start">
                    <a href="{{ url('/#contacto') }}" class="rounded-full border-2 border-primary bg-surface-container-lowest px-8 py-3 font-headline text-sm font-bold uppercase tracking-wide text-primary transition-colors hover:bg-secondary-container">
                        Contáctanos
                    </a>
                    <a href="tel:+14692888881" class="font-headline text-2xl font-bold text-primary md:text-3xl">469-288-8881</a>
                </div>
            </main>
        </div>
    </div>
</div>
