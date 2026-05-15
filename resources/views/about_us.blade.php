@extends('menu_main')

@section('page_title', $page->meta_title ?: 'About Us — Twins Garage Doors')

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

@section('content')
    @php
        $aboutCards = $aboutContent?->cards ?? collect();
        $heroImageFilename = $aboutContent?->hero_image_filename;
        $introIconFileUrl = \App\Support\CmsPage::introIconFileUrl($aboutContent?->intro_icon_filename);
        $introIconName = \App\Support\CmsPage::materialIconOrDefault($aboutContent?->intro_icon ?? null);
        $valuesHeadingRaw = $aboutContent?->values_section_heading ?? null;
        $valuesSectionHeading = ($valuesHeadingRaw !== null && $valuesHeadingRaw !== '') ? (string) $valuesHeadingRaw : 'Valores';
        $valuesSectionLogoUrl = ($aboutContent && $aboutContent->values_section_logo_filename)
            ? \App\Support\CmsPage::imageUrlFromFilename($aboutContent->values_section_logo_filename)
            : null;
    @endphp

    <div class="bg-[#f0f3f8]">
        <div class="mx-auto w-full max-w-screen-2xl px-4 py-10 sm:px-6 sm:py-12 md:py-20 lg:px-12 xl:px-14">
            <main class="about-us-cms about-us-main relative w-full font-body text-gray-800">
                <div class="house-outline-bg hidden lg:block" aria-hidden="true">
                    <svg fill="none" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 150 L200 50 L350 150 V350 H50 Z" fill="transparent" stroke="white" stroke-width="40"></path>
                    </svg>
                </div>

                <header class="mb-12 relative z-10">
                    <h1 class="font-headline text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#0b3169] mb-2 leading-tight">{{ $aboutContent->hero_title ?: 'Built on family, trust, and craftsmanship.' }}</h1>
                    <p class="font-headline text-base sm:text-lg md:text-xl font-bold text-on-primary-container mb-0">{{ $aboutContent->hero_eyebrow ?: 'About Twins Garage Doors' }}</p>
                </header>

                <section class="relative grid grid-cols-1 lg:grid-cols-2 gap-16 items-start mb-24">
                    <div class="relative z-10">
                        <div class="image-notched bg-white">
                            @if ($heroImageFilename)
                                <img alt="" class="w-full h-auto object-cover min-h-[240px] sm:min-h-[320px] md:min-h-[500px]" src="{{ \App\Support\CmsPage::imageUrlFromFilename($heroImageFilename) }}">
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
                                    <p class="whitespace-pre-wrap">{{ $aboutContent->intro }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="relative z-10 mb-12 flex flex-col items-start text-left">
                    <div class="mb-4 flex items-center gap-4">
                        @if ($valuesSectionLogoUrl)
                            <div class="flex shrink-0 items-center justify-center">
                                <img src="{{ $valuesSectionLogoUrl }}" alt="" class="max-h-24 max-w-24 object-contain sm:max-h-28 sm:max-w-28 md:max-h-32 md:max-w-32">
                            </div>
                        @endif

                    </div>
                    <h3 class="font-headline text-3xl md:text-4xl font-bold text-on-primary-container">{{ $valuesSectionHeading }}</h3>
                </section>

                @if ($aboutCards->isNotEmpty())
                    <section class="relative z-10 grid grid-cols-1 gap-10 pt-2 md:grid-cols-3 md:pt-0">
                        @foreach ($aboutCards as $card)
                            @php
                                $iconName = \App\Support\CmsPage::materialIconFromStored($card->icon, $loop->index);
                                $isFirst = $loop->first;
                            @endphp
                            <div class="relative z-10 flex h-full flex-col">
                                <div class="about-us-card-icon-bubble absolute left-4 sm:left-8 md:left-12 top-8 z-20 shrink-0 -translate-y-1/2 {{ $isFirst ? 'bg-on-primary-container' : 'bg-secondary-container' }}">
                                    <span class="material-symbols-outlined {{ $isFirst ? 'text-white' : 'text-[#0b3169]' }}">{{ $iconName }}</span>
                                </div>
                                @if ($isFirst)
                                    <div class="card-notched mt-8 flex min-h-[320px] sm:min-h-[380px] md:min-h-[480px] flex-grow flex-col overflow-hidden bg-[#0b3169] px-6 sm:px-8 md:px-12 pb-12 sm:pb-16 md:pb-20 pt-14 sm:pt-16 md:pt-20 text-white shadow-2xl">
                                        <h4 class="mb-4 md:mb-6 font-headline text-2xl sm:text-3xl md:text-4xl font-bold text-on-primary-container">{{ $card->title }}</h4>
                                        <p class="mb-auto text-base leading-relaxed opacity-90">{{ $card->body }}</p>
                                    </div>
                                @else
                                    <div class="card-notched mt-8 flex min-h-[320px] sm:min-h-[380px] md:min-h-[480px] flex-grow flex-col overflow-hidden bg-white px-6 sm:px-8 md:px-12 pb-12 sm:pb-16 md:pb-20 pt-14 sm:pt-16 md:pt-20 text-[#0b3169] shadow-lg">
                                        <h4 class="mb-4 md:mb-6 font-headline text-2xl sm:text-3xl md:text-4xl font-bold text-on-primary-container">{{ $card->title }}</h4>
                                        <p class="mb-auto text-base font-medium leading-relaxed text-gray-600">{{ $card->body }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @else
                    <p class="text-on-surface-variant text-sm relative z-10">No hay tarjetas configuradas para esta página.</p>
                @endif
            </main>
        </div>
    </div>
@endsection
