{{-- Editor Home: home_contents / home_stats / home_testimonials --}}
@php
    $homeContent = $page->homeContent;
    $homeStats = $homeContent?->stats ?? collect();
    $homeTestimonials = $homeContent?->testimonials ?? collect();
    $serviceCards = $serviceCards ?? collect();
    $formId = 'form-home';
    $heroBgSrc = $homeContent?->hero_bg_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($homeContent->hero_bg_image_filename)
        : asset('images/lifting-gates-garage.jpg');
    $heroInsetSrc = $homeContent?->hero_inset_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($homeContent->hero_inset_image_filename)
        : asset('images/instalacion-de-puertas-automaticas.jpg.webp');
    $workMainSrc = $homeContent?->work_main_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($homeContent->work_main_image_filename)
        : asset('images/lifting-gates-garage.jpg');
    $mapEmbedUrl = $homeContent?->map_embed_url ?: 'https://maps.google.com/maps?q=Dallas-Fort%20Worth%2C%20TX&t=&z=9&ie=UTF8&iwloc=&output=embed';
@endphp

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style data-purpose="home-cms-editor">
    .services-swiper .swiper-slide { height: auto; }
    .services-swiper .swiper-button-prev,
    .services-swiper .swiper-button-next { color: #fff; }
    .services-swiper .swiper-button-prev::after,
    .services-swiper .swiper-button-next::after { font-size: 1.5rem; font-weight: 700; }
    .services-swiper .swiper-pagination-bullet { background: #87A0CD; opacity: 0.5; }
    .services-swiper .swiper-pagination-bullet-active { background: #fff; opacity: 1; }
    .home-edit-section { position: relative; }
    .home-edit-section .cms-section-edit-btn { position: absolute; z-index: 30; top: 0.5rem; right: 0.5rem; }
</style>
@endpush

<div class="home-edit">
    @if (! $homeContent)
        <p class="alert alert-warning">No hay registro en <code>home_contents</code>. Ejecuta migraciones y <code>php artisan db:seed --class=SiteContentSeeder</code>.</p>
    @else
    <main>
        {{-- Hero --}}
        <section class="home-edit-section relative min-h-[480px] sm:min-h-[540px] md:min-h-[600px] flex items-center overflow-hidden bg-primary py-12 sm:py-16">
            <button type="button" class="btn btn-primary btn-sm shadow-sm cms-section-edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-hero" aria-controls="offcanvas-home-hero">Editar hero</button>
            <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-home-hero" aria-labelledby="offcanvas-home-hero-label" data-bs-scroll="true">
                <div class="offcanvas-header border-bottom flex-shrink-0">
                    <h5 class="offcanvas-title" id="offcanvas-home-hero-label">Hero — Home</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                </div>
                <div class="offcanvas-body flex-grow-1 overflow-auto">
                    <div class="form-group">
                        <label class="form-label" for="home-hero-line1">Título — línea 1</label>
                        <input type="text" class="form-control" id="home-hero-line1" form="{{ $formId }}" name="home_content[hero_title_line1]" value="{{ old('home_content.hero_title_line1', $homeContent->hero_title_line1) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-hero-line2">Título — línea 2 (teléfono)</label>
                        <input type="text" class="form-control" id="home-hero-line2" form="{{ $formId }}" name="home_content[hero_title_line2]" value="{{ old('home_content.hero_title_line2', $homeContent->hero_title_line2) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-hero-accent">Título — acento</label>
                        <input type="text" class="form-control" id="home-hero-accent" form="{{ $formId }}" name="home_content[hero_title_accent]" value="{{ old('home_content.hero_title_accent', $homeContent->hero_title_accent) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-hero-lead">Párrafo introductorio</label>
                        <textarea class="form-control" id="home-hero-lead" rows="6" form="{{ $formId }}" name="home_content[hero_lead]">{{ old('home_content.hero_lead', $homeContent->hero_lead) }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="form-label" for="home-hero-cta-primary">Botón principal</label>
                            <input type="text" class="form-control" id="home-hero-cta-primary" form="{{ $formId }}" name="home_content[hero_cta_primary_label]" value="{{ old('home_content.hero_cta_primary_label', $homeContent->hero_cta_primary_label) }}" maxlength="255">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label" for="home-hero-cta-secondary">Botón secundario</label>
                            <input type="text" class="form-control" id="home-hero-cta-secondary" form="{{ $formId }}" name="home_content[hero_cta_secondary_label]" value="{{ old('home_content.hero_cta_secondary_label', $homeContent->hero_cta_secondary_label) }}" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block">Imagen de fondo</label>
                        @if ($homeContent->hero_bg_image_filename)
                            <img src="{{ $heroBgSrc }}" alt="" class="img-fluid rounded border mb-2" style="max-height: 120px; object-fit: cover;">
                        @endif
                        <input type="file" class="form-control cms-offcanvas-file-input" id="home-hero-bg-image" form="{{ $formId }}" name="home_hero_bg_image" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="home-remove-hero-bg" name="home_remove_hero_bg_image">
                            <label class="form-check-label" for="home-remove-hero-bg">Quitar imagen de fondo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block">Imagen inset (columna derecha)</label>
                        @if ($homeContent->hero_inset_image_filename)
                            <img src="{{ $heroInsetSrc }}" alt="" class="img-fluid rounded border mb-2" style="max-height: 120px; object-fit: cover;">
                        @endif
                        <input type="file" class="form-control cms-offcanvas-file-input" id="home-hero-inset-image" form="{{ $formId }}" name="home_hero_inset_image" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="home-remove-hero-inset" name="home_remove_hero_inset_image">
                            <label class="form-check-label" for="home-remove-hero-inset">Quitar imagen inset</label>
                        </div>
                        <span class="form-text text-muted">JPG, PNG, GIF o WebP (máx. 8&nbsp;MB). <code>public/images/home/</code></span>
                    </div>
                </div>
                <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                </div>
            </div>
            <div class="absolute inset-0 z-0">
                <img alt="" class="w-full h-full object-cover" src="{{ $heroBgSrc }}" />
                <div class="absolute inset-0 hero-overlay"></div>
            </div>
            <div class="relative z-10 max-w-screen-2xl mx-auto px-4 sm:px-6 w-full grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12">
                <div class="relative">
                    <h1 class="font-headline font-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white leading-tight mb-6 sm:mb-8">
                        {{ $homeContent->hero_title_line1 }} <br /> {{ $homeContent->hero_title_line2 }} <br>
                        <span class="text-on-primary-container">{{ $homeContent->hero_title_accent }}</span>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-200 font-light mb-8 sm:mb-10 max-w-lg whitespace-pre-wrap">{{ $homeContent->hero_lead }}</p>
                    <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                        <span class="inline-flex w-full sm:w-auto items-center justify-center bg-on-primary-container text-primary px-6 sm:px-8 py-3 rounded font-headline font-bold text-sm sm:text-lg">{{ $homeContent->hero_cta_primary_label }}</span>
                        <span class="w-full sm:w-auto border border-white/30 text-white px-6 sm:px-8 py-3 rounded font-headline font-bold text-sm sm:text-lg">{{ $homeContent->hero_cta_secondary_label }}</span>
                    </div>
                </div>
                <div class="hidden md:flex justify-end">
                    <div class="relative w-80 h-96 bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden border border-white/20 p-4 shadow-2xl rotate-3 transform">
                        <img alt="" class="w-full h-full object-cover rounded-2xl" src="{{ $heroInsetSrc }}" />
                    </div>
                </div>
            </div>
        </section>

        {{-- About preview --}}
        <section class="home-edit-section bg-surface py-12 sm:py-16 md:py-20 px-4 sm:px-6">
            <button type="button" class="btn btn-primary btn-sm shadow-sm cms-section-edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-about" aria-controls="offcanvas-home-about">Editar About</button>
            <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-home-about" aria-labelledby="offcanvas-home-about-label" data-bs-scroll="true">
                <div class="offcanvas-header border-bottom flex-shrink-0">
                    <h5 class="offcanvas-title" id="offcanvas-home-about-label">About preview — Home</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                </div>
                <div class="offcanvas-body flex-grow-1 overflow-auto">
                    <div class="form-group">
                        <label class="form-label" for="home-about-heading">Título (H2)</label>
                        <input type="text" class="form-control" id="home-about-heading" form="{{ $formId }}" name="home_content[about_heading]" value="{{ old('home_content.about_heading', $homeContent->about_heading) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-about-subheading">Subtítulo</label>
                        <input type="text" class="form-control" id="home-about-subheading" form="{{ $formId }}" name="home_content[about_subheading]" value="{{ old('home_content.about_subheading', $homeContent->about_subheading) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-about-link">Texto del enlace</label>
                        <input type="text" class="form-control" id="home-about-link" form="{{ $formId }}" name="home_content[about_link_label]" value="{{ old('home_content.about_link_label', $homeContent->about_link_label) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-about-p1">Párrafo 1</label>
                        <textarea class="form-control" id="home-about-p1" rows="4" form="{{ $formId }}" name="home_content[about_paragraph_1]">{{ old('home_content.about_paragraph_1', $homeContent->about_paragraph_1) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-about-p2">Párrafo 2</label>
                        <textarea class="form-control" id="home-about-p2" rows="4" form="{{ $formId }}" name="home_content[about_paragraph_2]">{{ old('home_content.about_paragraph_2', $homeContent->about_paragraph_2) }}</textarea>
                    </div>
                </div>
                <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                </div>
            </div>
            <div class="max-w-screen-2xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <div class="lg:col-span-4">
                    <h2 class="font-headline font-black text-3xl sm:text-4xl text-primary uppercase leading-tight mb-2">{{ $homeContent->about_heading }}</h2>
                    <p class="font-headline font-bold text-on-primary-container text-lg sm:text-xl">{{ $homeContent->about_subheading }}</p>
                    <span class="mt-6 inline-flex items-center gap-2 text-primary font-headline font-bold text-sm uppercase tracking-wide">{{ $homeContent->about_link_label }}</span>
                </div>
                <div class="lg:col-span-8 space-y-6 text-on-surface-variant leading-relaxed text-base sm:text-lg">
                    <p class="whitespace-pre-wrap">{{ $homeContent->about_paragraph_1 }}</p>
                    <p class="whitespace-pre-wrap">{{ $homeContent->about_paragraph_2 }}</p>
                </div>
            </div>
        </section>

        {{-- Services headings + carousel --}}
        <section class="home-edit-section py-12 sm:py-16 md:py-24 bg-[#1B365D]">
            <button type="button" class="btn btn-primary btn-sm shadow-sm cms-section-edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-services" aria-controls="offcanvas-home-services">Editar títulos</button>
            <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-home-services" aria-labelledby="offcanvas-home-services-label" data-bs-scroll="true">
                <div class="offcanvas-header border-bottom flex-shrink-0">
                    <h5 class="offcanvas-title" id="offcanvas-home-services-label">Services — títulos Home</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                </div>
                <div class="offcanvas-body flex-grow-1 overflow-auto">
                    <p class="form-text text-muted mb-3">Las tarjetas del carrusel se editan en la página <strong>Services</strong> del panel.</p>
                    <div class="form-group">
                        <label class="form-label" for="home-services-primary">Título principal</label>
                        <input type="text" class="form-control" id="home-services-primary" form="{{ $formId }}" name="home_content[services_heading_primary]" value="{{ old('home_content.services_heading_primary', $homeContent->services_heading_primary) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-services-accent">Subtítulo / acento</label>
                        <input type="text" class="form-control" id="home-services-accent" form="{{ $formId }}" name="home_content[services_heading_accent]" value="{{ old('home_content.services_heading_accent', $homeContent->services_heading_accent) }}" maxlength="255">
                    </div>
                </div>
                <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                </div>
            </div>
            <div class="grid-container">
                <div class="text-center mb-10 sm:mb-16">
                    <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-headline font-black text-white uppercase mb-0 tracking-tight leading-none">{{ $homeContent->services_heading_primary }}</h2>
                    <p class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-headline font-bold text-[#87A0CD] -mt-1 sm:-mt-2">{{ $homeContent->services_heading_accent }}</p>
                </div>
                @if ($serviceCards->isNotEmpty())
                    <div class="services-swiper swiper relative px-10 sm:px-12" data-services-count="{{ $serviceCards->count() }}">
                        <div class="swiper-wrapper">
                            @foreach ($serviceCards as $card)
                                <div class="swiper-slide h-auto">
                                    @include('partials.service_card_home', ['card' => $card, 'iconIndex' => $loop->index])
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="swiper-button-prev" aria-label="Previous services"></button>
                        <button type="button" class="swiper-button-next" aria-label="Next services"></button>
                        <div class="swiper-pagination !relative mt-8"></div>
                    </div>
                @else
                    <p class="text-center text-white/70 text-sm">Sin tarjetas en Services. Configúralas en la página Services.</p>
                @endif
            </div>
        </section>

        {{-- Our Work preview --}}
        <section class="home-edit-section overflow-hidden">
            <div class="bg-[#87A0CD] py-12 sm:py-16 md:py-20 px-4 sm:px-6 relative">
                <button type="button" class="btn btn-primary btn-sm shadow-sm cms-section-edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-work" aria-controls="offcanvas-home-work">Editar Our Work</button>
                <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-home-work" aria-labelledby="offcanvas-home-work-label" data-bs-scroll="true">
                    <div class="offcanvas-header border-bottom flex-shrink-0">
                        <h5 class="offcanvas-title" id="offcanvas-home-work-label">Our Work preview — Home</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                    </div>
                    <div class="offcanvas-body flex-grow-1 overflow-auto">
                        <div class="form-group">
                            <label class="form-label" for="home-work-primary">Título — línea 1</label>
                            <input type="text" class="form-control" id="home-work-primary" form="{{ $formId }}" name="home_content[work_heading_primary]" value="{{ old('home_content.work_heading_primary', $homeContent->work_heading_primary) }}" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="home-work-accent">Título — acento</label>
                            <input type="text" class="form-control" id="home-work-accent" form="{{ $formId }}" name="home_content[work_heading_accent]" value="{{ old('home_content.work_heading_accent', $homeContent->work_heading_accent) }}" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="home-work-intro">Intro</label>
                            <textarea class="form-control" id="home-work-intro" rows="4" form="{{ $formId }}" name="home_content[work_intro]">{{ old('home_content.work_intro', $homeContent->work_intro) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="home-work-cta">Texto del botón</label>
                            <input type="text" class="form-control" id="home-work-cta" form="{{ $formId }}" name="home_content[work_cta_label]" value="{{ old('home_content.work_cta_label', $homeContent->work_cta_label) }}" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label d-block">Imagen principal</label>
                            @if ($homeContent->work_main_image_filename)
                                <img src="{{ $workMainSrc }}" alt="" class="img-fluid rounded border mb-2" style="max-height: 120px; object-fit: cover;">
                            @endif
                            <input type="file" class="form-control cms-offcanvas-file-input" id="home-work-main-image" form="{{ $formId }}" name="home_work_main_image" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="home-remove-work-main" name="home_remove_work_main_image">
                                <label class="form-check-label" for="home-remove-work-main">Quitar imagen</label>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                    </div>
                </div>
                <div class="max-w-screen-2xl mx-auto">
                    <div class="mb-8 sm:mb-12">
                        <h2 class="text-primary font-headline font-black text-3xl sm:text-4xl md:text-5xl leading-none uppercase">{{ $homeContent->work_heading_primary }}</h2>
                        <h3 class="text-white font-headline font-black text-4xl sm:text-5xl md:text-6xl lg:text-8xl leading-none uppercase -mt-1 sm:-mt-2">{{ $homeContent->work_heading_accent }}</h3>
                        <div class="mt-6 max-w-2xl flex flex-col md:flex-row md:items-end gap-6">
                            <p class="text-primary font-body font-medium leading-relaxed whitespace-pre-wrap">{{ $homeContent->work_intro }}</p>
                            <span class="inline-flex items-center gap-2 bg-primary text-white px-6 py-2 rounded-full text-sm font-bold uppercase">{{ $homeContent->work_cta_label }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-center bg-[#1B365D] rounded-2xl sm:rounded-[2rem] lg:rounded-[3rem] p-4 sm:p-6 lg:p-8 relative">
                        <div class="lg:col-span-8 h-56 sm:h-80 lg:h-[400px] overflow-hidden rounded-xl sm:rounded-[2.5rem]">
                            <img alt="" class="w-full h-full object-cover" src="{{ $workMainSrc }}" />
                        </div>
                        <div class="lg:col-span-4 bg-white/10 backdrop-blur-md rounded-xl sm:rounded-[2.5rem] p-6 sm:p-8 flex flex-col justify-center gap-6 sm:gap-8">
                            @foreach ($homeStats as $stat)
                                <div class="position-relative">
                                    <button type="button" class="btn btn-outline-light btn-sm position-absolute top-0 end-0" style="z-index:5;" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-stat-{{ $stat->id }}" aria-controls="offcanvas-home-stat-{{ $stat->id }}">Editar</button>
                                    <div class="text-white font-headline font-black text-4xl sm:text-5xl leading-tight">{{ $stat->stat_value }}</div>
                                    <div class="text-[#87A0CD] font-headline font-bold text-xl uppercase tracking-wider">{{ $stat->stat_caption }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reviews --}}
            <div class="home-edit-section bg-white py-12 sm:py-16 md:py-24 px-4 sm:px-6 relative">
                <button type="button" class="btn btn-primary btn-sm shadow-sm cms-section-edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-reviews" aria-controls="offcanvas-home-reviews">Editar Reviews</button>
                <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-home-reviews" aria-labelledby="offcanvas-home-reviews-label" data-bs-scroll="true">
                    <div class="offcanvas-header border-bottom flex-shrink-0">
                        <h5 class="offcanvas-title" id="offcanvas-home-reviews-label">Reviews — títulos Home</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                    </div>
                    <div class="offcanvas-body flex-grow-1 overflow-auto">
                        <p class="form-text text-muted mb-3">Edita cada testimonio con el botón «Editar» sobre la tarjeta.</p>
                        <div class="form-group">
                            <label class="form-label" for="home-reviews-primary">Título — línea 1</label>
                            <input type="text" class="form-control" id="home-reviews-primary" form="{{ $formId }}" name="home_content[reviews_heading_primary]" value="{{ old('home_content.reviews_heading_primary', $homeContent->reviews_heading_primary) }}" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="home-reviews-accent">Título — acento</label>
                            <input type="text" class="form-control" id="home-reviews-accent" form="{{ $formId }}" name="home_content[reviews_heading_accent]" value="{{ old('home_content.reviews_heading_accent', $homeContent->reviews_heading_accent) }}" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="home-reviews-cta">Texto del botón</label>
                            <input type="text" class="form-control" id="home-reviews-cta" form="{{ $formId }}" name="home_content[reviews_cta_label]" value="{{ old('home_content.reviews_cta_label', $homeContent->reviews_cta_label) }}" maxlength="255">
                        </div>
                    </div>
                    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                    </div>
                </div>
                <div class="max-w-screen-2xl mx-auto">
                    <div class="text-center mb-10 sm:mb-16">
                        <h2 class="text-[#87A0CD] font-headline font-black text-3xl sm:text-4xl md:text-5xl leading-none uppercase">{{ $homeContent->reviews_heading_primary }}</h2>
                        <h3 class="text-primary font-headline font-black text-4xl sm:text-5xl md:text-6xl lg:text-8xl leading-none uppercase -mt-1 sm:-mt-2">{{ $homeContent->reviews_heading_accent }}</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        @foreach ($homeTestimonials as $testimonial)
                            @php $testimonialIcon = \App\Support\CmsPage::materialIconFromStored($testimonial->icon, $loop->index); @endphp
                            <div class="bg-[#1B365D] rounded-2xl sm:rounded-[2.5rem] p-6 sm:p-8 md:p-10 pt-14 sm:pt-16 relative shadow-xl mt-8 sm:mt-0">
                                <button type="button" class="btn btn-outline-light btn-sm position-absolute top-2 end-2" style="z-index:5;" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-testimonial-{{ $testimonial->id }}" aria-controls="offcanvas-home-testimonial-{{ $testimonial->id }}">Editar</button>
                                <div class="absolute -top-6 left-4 sm:left-8 bg-[#87A0CD] p-3 sm:p-4 rounded-2xl">
                                    <span class="material-symbols-outlined text-white text-5xl font-black rotate-180">format_quote</span>
                                </div>
                                <div class="absolute -top-10 right-8 w-20 h-20 rounded-full bg-white flex items-center justify-center border-4 border-[#1B365D]">
                                    <span class="material-symbols-outlined text-4xl text-[#1B365D]">{{ $testimonialIcon }}</span>
                                </div>
                                <p class="text-white/80 text-sm leading-relaxed mb-8 italic whitespace-pre-wrap">{{ $testimonial->quote }}</p>
                                <div class="flex gap-1">
                                    @for ($i = 0; $i < 5; $i++)
                                        <span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center mt-10 sm:mt-12">
                        <span class="inline-flex items-center gap-2 bg-[#87A0CD] text-primary px-8 py-3 rounded-full font-headline font-bold text-sm uppercase tracking-wide">{{ $homeContent->reviews_cta_label }}</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Contact --}}
        <section class="home-edit-section bg-[#A5C2F1] py-12 sm:py-16 px-4 sm:px-6">
            <button type="button" class="btn btn-primary btn-sm shadow-sm cms-section-edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-home-contact" aria-controls="offcanvas-home-contact">Editar contacto</button>
            <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-home-contact" aria-labelledby="offcanvas-home-contact-label" data-bs-scroll="true">
                <div class="offcanvas-header border-bottom flex-shrink-0">
                    <h5 class="offcanvas-title" id="offcanvas-home-contact-label">Contacto — Home</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                </div>
                <div class="offcanvas-body flex-grow-1 overflow-auto">
                    <div class="form-group">
                        <label class="form-label" for="home-contact-heading">Título (H2)</label>
                        <input type="text" class="form-control" id="home-contact-heading" form="{{ $formId }}" name="home_content[contact_heading]" value="{{ old('home_content.contact_heading', $homeContent->contact_heading) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-contact-phone">Teléfono</label>
                        <input type="text" class="form-control" id="home-contact-phone" form="{{ $formId }}" name="home_content[contact_phone]" value="{{ old('home_content.contact_phone', $homeContent->contact_phone) }}" maxlength="64">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-contact-email">Email</label>
                        <input type="text" class="form-control" id="home-contact-email" form="{{ $formId }}" name="home_content[contact_email]" value="{{ old('home_content.contact_email', $homeContent->contact_email) }}" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="home-map-url">URL embed del mapa (iframe)</label>
                        <textarea class="form-control" id="home-map-url" rows="3" form="{{ $formId }}" name="home_content[map_embed_url]">{{ old('home_content.map_embed_url', $homeContent->map_embed_url) }}</textarea>
                    </div>
                </div>
                <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                </div>
            </div>
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-stretch gap-8 md:gap-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <h2 class="text-[#002046] font-headline font-black text-3xl sm:text-4xl mb-6 sm:mb-8">{{ $homeContent->contact_heading }}</h2>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center gap-3 text-primary font-bold">
                                <span class="material-symbols-outlined text-lg">call</span>
                                <span>{{ $homeContent->contact_phone }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-primary font-bold">
                                <span class="material-symbols-outlined text-lg">mail</span>
                                <span class="break-all">{{ $homeContent->contact_email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 min-h-[280px]">
                        <div class="h-full w-full min-h-[280px] rounded-2xl overflow-hidden shadow-2xl border-4 border-white/20">
                            <iframe allowfullscreen="" height="100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="{{ $mapEmbedUrl }}" style="border:0;" width="100%"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
(function () {
    var el = document.querySelector('.home-edit .services-swiper');
    if (!el || typeof Swiper === 'undefined') return;
    var count = parseInt(el.getAttribute('data-services-count') || '0', 10);
    new Swiper(el, {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: count > 3,
        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
        navigation: {
            nextEl: el.querySelector('.swiper-button-next'),
            prevEl: el.querySelector('.swiper-button-prev'),
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });
})();
</script>
@endpush
