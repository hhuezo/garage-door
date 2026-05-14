{{-- Editor Our Work: our_work_contents / our_work_projects --}}
@php
    $ourWorkContent = $page->ourWorkContent;
    $projects = $ourWorkContent?->projects ?? collect();
    $heroMainFilename = $ourWorkContent?->hero_main_image_filename;
    $heroInsetFilename = $ourWorkContent?->hero_inset_image_filename;
    $formId = 'form-our-work';
    $iconChoices = \App\Support\MaterialIconOptions::serviceCardIcons();
    $selectedHeroIcon = old('our_work_content.hero_icon', $ourWorkContent?->hero_icon ?? 'tune');
    if (! is_string($selectedHeroIcon) || ! array_key_exists($selectedHeroIcon, $iconChoices)) {
        $selectedHeroIcon = 'tune';
    }
@endphp

<div class="our-work-edit">
    <div class="bg-surface">
        <div class="mx-auto w-full max-w-screen-2xl px-4 py-12 sm:px-8 md:px-16 md:py-20 lg:px-20">
            <main class="font-body text-on-surface position-relative">
                @if ($ourWorkContent)
                <button type="button" class="btn btn-primary shadow-sm position-absolute top-0 end-0 m-2" style="z-index: 30;" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-our-work-cabecera" aria-controls="offcanvas-our-work-cabecera">
                    Editar hero y textos
                </button>
                    <div class="offcanvas offcanvas-end cms-page-offcanvas d-flex flex-column" tabindex="-1" id="offcanvas-our-work-cabecera" aria-labelledby="offcanvas-our-work-cabecera-label" data-bs-scroll="true">
                        <div class="offcanvas-header border-bottom flex-shrink-0">
                            <h5 class="offcanvas-title" id="offcanvas-our-work-cabecera-label">Hero — Our Work</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
                        </div>
                        <div class="offcanvas-body flex-grow-1 overflow-auto">
                            <div class="form-group">
                                <label class="form-label" for="our-work-hero-line1">Título — primera línea</label>
                                <input type="text" class="form-control" id="our-work-hero-line1" form="{{ $formId }}"
                                    name="our_work_content[hero_title_primary]"
                                    value="{{ old('our_work_content.hero_title_primary', $ourWorkContent->hero_title_primary) }}" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="our-work-hero-accent">Título — acento (cursiva)</label>
                                <input type="text" class="form-control" id="our-work-hero-accent" form="{{ $formId }}"
                                    name="our_work_content[hero_title_accent]"
                                    value="{{ old('our_work_content.hero_title_accent', $ourWorkContent->hero_title_accent) }}" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label class="form-label d-block" for="our-work-hero-icon">Icono (círculo junto al título)</label>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="material-symbols-outlined text-primary border rounded p-2 bg-white" style="font-size: 2rem; line-height: 1;" id="our-work-hero-icon-preview">{{ $selectedHeroIcon }}</span>
                                    <select name="our_work_content[hero_icon]" id="our-work-hero-icon" class="form-select flex-grow-1 js-cms-material-icon-select" style="min-width: 10rem;" form="{{ $formId }}"
                                        data-icon-preview="our-work-hero-icon-preview">
                                        @foreach ($iconChoices as $val => $lab)
                                            <option value="{{ $val }}" @selected($selectedHeroIcon === $val)>{{ $lab }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="our-work-hero-intro">Párrafo introductorio</label>
                                <textarea class="form-control" id="our-work-hero-intro" rows="8" form="{{ $formId }}"
                                    name="our_work_content[hero_intro]">{{ old('our_work_content.hero_intro', $ourWorkContent->hero_intro) }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label" for="our-work-cta-label">Texto del botón (hero)</label>
                                    <input type="text" class="form-control" id="our-work-cta-label" form="{{ $formId }}"
                                        name="our_work_content[hero_cta_label]"
                                        value="{{ old('our_work_content.hero_cta_label', $ourWorkContent->hero_cta_label) }}" maxlength="255">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label" for="our-work-cta-url">Enlace del botón</label>
                                    <input type="text" class="form-control" id="our-work-cta-url" form="{{ $formId }}"
                                        name="our_work_content[hero_cta_url]"
                                        value="{{ old('our_work_content.hero_cta_url', $ourWorkContent->hero_cta_url) }}" maxlength="512" placeholder="/#contacto o https://…">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label" for="our-work-stat-value">Cifra (tarjeta flotante)</label>
                                    <input type="text" class="form-control" id="our-work-stat-value" form="{{ $formId }}"
                                        name="our_work_content[stat_value]"
                                        value="{{ old('our_work_content.stat_value', $ourWorkContent->stat_value) }}" maxlength="64" placeholder="+100">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label" for="our-work-stat-caption">Texto bajo la cifra</label>
                                    <input type="text" class="form-control" id="our-work-stat-caption" form="{{ $formId }}"
                                        name="our_work_content[stat_caption]"
                                        value="{{ old('our_work_content.stat_caption', $ourWorkContent->stat_caption) }}" maxlength="255">
                                </div>
                            </div>
                            <p class="form-text text-muted small mb-3">Si dejas vacíos cifra y texto, no se muestra la tarjeta flotante.</p>
                            <div class="form-group">
                                <label class="form-label d-block">Imagen principal (columna derecha, grande)</label>
                                <div class="text-center mb-2">
                                    @if ($heroMainFilename)
                                        <img src="{{ \App\Support\CmsPage::imageUrlFromFilename($heroMainFilename) }}" alt="" class="img-fluid rounded border" style="max-height: 140px; object-fit: cover;">
                                    @else
                                        <span class="form-text text-muted d-block text-start">Sin imagen propia; se usa una imagen por defecto en la vista previa.</span>
                                    @endif
                                </div>
                                <input type="file" class="form-control cms-offcanvas-file-input" id="our-work-hero-main-image" form="{{ $formId }}" name="our_work_hero_main_image" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="our-work-remove-hero-main" name="our_work_remove_hero_main_image">
                                    <label class="form-check-label" for="our-work-remove-hero-main">Quitar imagen principal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label d-block">Imagen secundaria (esquina inferior)</label>
                                <div class="text-center mb-2">
                                    @if ($heroInsetFilename)
                                        <img src="{{ \App\Support\CmsPage::imageUrlFromFilename($heroInsetFilename) }}" alt="" class="img-fluid rounded border" style="max-height: 120px; object-fit: cover;">
                                    @else
                                        <span class="form-text text-muted d-block text-start">Sin imagen propia; se usa una imagen por defecto.</span>
                                    @endif
                                </div>
                                <input type="file" class="form-control cms-offcanvas-file-input" id="our-work-hero-inset-image" form="{{ $formId }}" name="our_work_hero_inset_image" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="our-work-remove-hero-inset" name="our_work_remove_hero_inset_image">
                                    <label class="form-check-label" for="our-work-remove-hero-inset">Quitar imagen secundaria</label>
                                </div>
                                <span class="form-text text-muted">JPG, PNG, GIF o WebP (máx. 8&nbsp;MB). <code>public/images/our_work/</code></span>
                            </div>
                        </div>
                        <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
                        </div>
                    </div>
                @endif

                @if (! $ourWorkContent)
                    <p class="alert alert-warning">No hay registro en <code>our_work_contents</code>. Ejecuta migraciones y <code>php artisan db:seed --class=SiteContentSeeder</code>.</p>
                @endif

                <section class="mb-20 md:mb-24" id="hero" data-purpose="page-hero">
                    <div class="flex flex-col items-center gap-12 lg:flex-row">
                        <div class="w-full space-y-6 lg:w-1/2">
                            <div class="flex items-center gap-4">
                                <div class="rounded-full bg-primary-container p-3 text-on-primary">
                                    <span class="material-symbols-outlined text-4xl md:text-[2.5rem]" aria-hidden="true">{{ $selectedHeroIcon }}</span>
                                </div>
                                <h1 class="font-headline text-4xl font-black leading-none text-primary-container md:text-5xl lg:text-6xl">
                                    {{ $ourWorkContent?->hero_title_primary ?: 'Our' }} <br/>
                                    <span class="text-on-primary-container uppercase italic">{{ $ourWorkContent?->hero_title_accent ?: 'Work' }}</span>
                                </h1>
                            </div>
                            <p class="max-w-xl text-base leading-relaxed text-on-surface-variant md:text-lg whitespace-pre-wrap">{{ $ourWorkContent?->hero_intro }}</p>
                            @php
                                $previewCta = $ourWorkContent?->hero_cta_label ?: 'Leer más';
                            @endphp
                            <span class="inline-flex items-center gap-2 rounded-full bg-primary-container px-6 py-3 font-headline text-xs font-bold uppercase tracking-widest text-on-primary opacity-90">
                                {{ $previewCta }}
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>

                        <div class="relative w-full lg:w-1/2">
                            <div class="our-work-hero-bg-shape bg-secondary-container/30 p-6 md:p-8">
                                <img
                                    alt=""
                                    class="our-work-hero-bg-shape w-full object-cover shadow-2xl transition duration-500 hover:grayscale-0"
                                    src="{{ $heroMainFilename ? \App\Support\CmsPage::imageUrlFromFilename($heroMainFilename) : \App\Support\CmsPage::publicImageOrUrl(null) }}"
                                />
                            </div>
                            @if ($ourWorkContent && (($ourWorkContent->stat_value ?? '') !== '' || ($ourWorkContent->stat_caption ?? '') !== ''))
                            <div class="absolute right-0 top-10 z-10 rounded-l-3xl bg-primary-container p-5 text-on-primary shadow-xl md:p-6">
                                <p class="font-headline text-3xl font-black md:text-4xl">{{ $ourWorkContent->stat_value ?: '+100' }}</p>
                                <p class="text-sm font-semibold text-on-primary-container opacity-90">{{ $ourWorkContent->stat_caption }}</p>
                            </div>
                            @endif
                            <div class="absolute bottom-10 right-4 z-20 w-1/2 max-w-[220px] overflow-hidden rounded-2xl border-4 border-surface-container-lowest shadow-2xl sm:max-w-xs">
                                <img alt="" class="w-full object-cover" src="{{ $heroInsetFilename ? \App\Support\CmsPage::imageUrlFromFilename($heroInsetFilename) : \App\Support\CmsPage::publicImageOrUrl('service2.jpg') }}"/>
                            </div>
                        </div>
                    </div>
                </section>

                @if ($projects->isNotEmpty())
                    <section id="projects" data-purpose="projects-grid">
                        <div class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 md:gap-y-16 lg:grid-cols-3 lg:gap-x-10">
                            @foreach ($projects as $project)
                                @php
                                    $iconName = \App\Support\CmsPage::materialIconFromStored($project->icon, $loop->index);
                                    $imgSrc = \App\Support\CmsPage::publicImageOrUrl($project->image_path);
                                    $drawerId = 'offcanvas-our-work-project-'.$project->id;
                                @endphp
                                <article class="flex flex-col position-relative" data-purpose="project-card">
                                    <button type="button" class="btn btn-sm btn-primary shadow-sm position-absolute top-0 end-0 m-1" style="z-index: 25;" data-bs-toggle="offcanvas" data-bs-target="#{{ $drawerId }}" aria-controls="{{ $drawerId }}">
                                        Editar proyecto
                                    </button>
                                    <div class="relative mb-6">
                                        <div class="our-work-diagonal-cut-img overflow-hidden">
                                            <img alt="{{ $project->title }}" class="block h-72 w-full object-cover" src="{{ $imgSrc }}"/>
                                        </div>
                                        <div class="absolute bottom-0 right-0 p-1">
                                            <div class="our-work-icon-shadow rounded-full border-4 border-surface bg-[#365e9e] p-3 text-on-primary">
                                                <span class="material-symbols-outlined text-2xl" aria-hidden="true">{{ $iconName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-2">
                                        <h3 class="mb-2 font-headline text-xl font-bold text-primary-container md:text-2xl">{{ $project->title }}</h3>
                                        <p class="mb-6 text-base leading-snug text-on-surface-variant whitespace-pre-wrap">{{ $project->body }}</p>
                                        <span class="inline-flex items-center gap-2 rounded bg-primary-container px-4 py-2 font-headline text-xs font-bold uppercase tracking-wide text-on-primary opacity-90">
                                            {{ $project->link_label ?: 'Leer más' }}
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @else
                    <p class="text-on-surface-variant text-sm">No hay proyectos en <code>our_work_projects</code>.</p>
                @endif
            </main>
        </div>
    </div>
</div>
