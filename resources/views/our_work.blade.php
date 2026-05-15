@extends('menu_main')

@section('page_title', ($page->meta_title ?? 'Our Work').' — Twins Garage Doors')

@push('styles')
<style data-purpose="our-work-page">
    .our-work-diagonal-cut-img {
        clip-path: polygon(0 0, 100% 0, 100% 82%, 82% 100%, 0 100%);
    }
    .our-work-hero-bg-shape {
        clip-path: polygon(15% 0%, 100% 0%, 100% 85%, 85% 100%, 0% 100%, 0% 15%);
    }
    .our-work-icon-shadow {
        box-shadow: 0 4px 6px -1px rgba(10, 37, 88, 0.2), 0 2px 4px -1px rgba(10, 37, 88, 0.1);
    }
</style>
@endpush

@php
    $resolveHref = function (?string $raw): string {
        $r = trim((string) ($raw ?? ''));
        if ($r === '') {
            return '/#contacto';
        }
        if (str_starts_with($r, 'http://') || str_starts_with($r, 'https://')) {
            return $r;
        }

        return $r;
    };
    $heroMainSrc = $ourWorkContent->hero_main_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($ourWorkContent->hero_main_image_filename)
        : \App\Support\CmsPage::publicImageOrUrl(null);
    $heroInsetSrc = $ourWorkContent->hero_inset_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($ourWorkContent->hero_inset_image_filename)
        : \App\Support\CmsPage::publicImageOrUrl('service2.jpg');
    $heroIcon = \App\Support\CmsPage::materialIconOrDefault($ourWorkContent->hero_icon, 'tune');
    $ctaHref = $resolveHref($ourWorkContent->hero_cta_url);
    $ctaLabel = $ourWorkContent->hero_cta_label !== null && $ourWorkContent->hero_cta_label !== ''
        ? $ourWorkContent->hero_cta_label
        : 'Leer más';
@endphp

@section('content')
<div class="bg-surface">
    <div class="mx-auto w-full max-w-screen-2xl px-4 py-12 sm:px-8 md:px-16 md:py-20 lg:px-20">
        <main class="font-body text-on-surface">
            <section class="mb-20 md:mb-24" id="hero" data-purpose="page-hero">
                <div class="flex flex-col items-center gap-12 lg:flex-row">
                    <div class="w-full space-y-6 lg:w-1/2">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-primary-container p-3 text-on-primary">
                                <span class="material-symbols-outlined text-4xl md:text-[2.5rem]" aria-hidden="true">{{ $heroIcon }}</span>
                            </div>
                            <h1 class="font-headline text-3xl sm:text-4xl font-black leading-none text-primary-container md:text-5xl lg:text-6xl">
                                {{ $ourWorkContent->hero_title_primary ?: 'Our' }} <br/>
                                <span class="text-on-primary-container uppercase italic">{{ $ourWorkContent->hero_title_accent ?: 'Work' }}</span>
                            </h1>
                        </div>
                        <p class="max-w-xl text-base leading-relaxed text-on-surface-variant md:text-lg whitespace-pre-wrap">{{ $ourWorkContent->hero_intro }}</p>
                        <a href="{{ $ctaHref }}" class="inline-flex items-center gap-2 rounded-full bg-primary-container px-6 py-3 font-headline text-xs font-bold uppercase tracking-widest text-on-primary transition-colors hover:bg-secondary">
                            {{ $ctaLabel }}
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="relative w-full min-h-[280px] sm:min-h-[340px] lg:min-h-0 lg:w-1/2">
                        <div class="our-work-hero-bg-shape bg-secondary-container/30 p-4 sm:p-6 md:p-8">
                            <img
                                alt=""
                                class="our-work-hero-bg-shape w-full object-cover shadow-2xl transition duration-500 hover:grayscale-0"
                                src="{{ $heroMainSrc }}"
                            />
                        </div>
                        @if (($ourWorkContent->stat_value ?? '') !== '' || ($ourWorkContent->stat_caption ?? '') !== '')
                        <div class="absolute right-0 top-4 sm:top-10 z-10 rounded-l-2xl sm:rounded-l-3xl bg-primary-container p-3 sm:p-5 text-on-primary shadow-xl md:p-6 max-w-[58%] sm:max-w-none">
                            <p class="font-headline text-2xl sm:text-3xl font-black md:text-4xl">{{ $ourWorkContent->stat_value ?: '+100' }}</p>
                            <p class="text-xs sm:text-sm font-semibold text-on-primary-container opacity-90">{{ $ourWorkContent->stat_caption }}</p>
                        </div>
                        @endif
                        <div class="absolute bottom-4 sm:bottom-10 right-2 sm:right-4 z-20 w-[45%] max-w-[160px] sm:w-1/2 sm:max-w-[220px] overflow-hidden rounded-xl sm:rounded-2xl border-2 sm:border-4 border-surface-container-lowest shadow-2xl sm:max-w-xs">
                            <img alt="" class="w-full object-cover" src="{{ $heroInsetSrc }}"/>
                        </div>
                    </div>
                </div>
            </section>

            <section id="projects" data-purpose="projects-grid">
                <div class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 md:gap-y-16 lg:grid-cols-3 lg:gap-x-10">
                    @foreach ($ourWorkContent->projects as $project)
                        @php
                            $iconName = \App\Support\CmsPage::materialIconFromStored($project->icon, $loop->index);
                            $imgSrc = \App\Support\CmsPage::publicImageOrUrl($project->image_path);
                            $cardHref = $resolveHref($project->link_url);
                            $cardLabel = $project->link_label !== null && $project->link_label !== '' ? $project->link_label : 'Leer más';
                        @endphp
                        <article class="flex flex-col" data-purpose="project-card">
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
                                <a href="{{ $cardHref }}" class="inline-flex items-center gap-2 rounded bg-primary-container px-4 py-2 font-headline text-xs font-bold uppercase tracking-wide text-on-primary transition-colors hover:bg-secondary">
                                    {{ $cardLabel }}
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</div>
@endsection
