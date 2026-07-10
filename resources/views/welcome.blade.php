@extends('menu_main')

@section('page_title', ($page?->meta_title ?? 'Twins Garage Doors — DFW'))

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .services-swiper .swiper-slide {
        height: auto;
    }
    .services-swiper .swiper-button-prev,
    .services-swiper .swiper-button-next {
        color: #fff;
    }
    .services-swiper .swiper-button-prev::after,
    .services-swiper .swiper-button-next::after {
        font-size: 1.5rem;
        font-weight: 700;
    }
    .services-swiper .swiper-pagination-bullet {
        background: #87A0CD;
        opacity: 0.5;
    }
    .services-swiper .swiper-pagination-bullet-active {
        background: #fff;
        opacity: 1;
    }
</style>
@endpush

@php
    $heroBgSrc = $homeContent?->hero_bg_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($homeContent->hero_bg_image_filename)
        : asset('images/lifting-gates-garage.jpg');
    $heroInsetSrc = $homeContent?->hero_inset_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($homeContent->hero_inset_image_filename)
        : asset('images/instalacion-de-puertas-automaticas.jpg.webp');
    $workMainSrc = $homeContent?->work_main_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($homeContent->work_main_image_filename)
        : asset('images/lifting-gates-garage.jpg');
    $contactPhone = $homeContent?->contact_phone ?: '469-288-8881';
    $contactPhoneTel = preg_replace('/\D+/', '', $contactPhone) ?: '14692888881';
    if (! str_starts_with($contactPhoneTel, '1') && strlen($contactPhoneTel) === 10) {
        $contactPhoneTel = '1'.$contactPhoneTel;
    }
    $homeStats = $homeContent?->stats ?? collect();
    $homeTestimonials = $homeContent?->testimonials ?? collect();
    $mapEmbedUrl = $homeContent?->map_embed_url ?: 'https://maps.google.com/maps?q=Dallas-Fort%20Worth%2C%20TX&t=&z=9&ie=UTF8&iwloc=&output=embed';
@endphp

@section('content')
    <main>
        <section
            class="relative min-h-[480px] sm:min-h-[540px] md:min-h-[600px] flex items-center overflow-hidden bg-primary py-12 sm:py-16">
            <div class="absolute inset-0 z-0">
                <img alt="Professional garage door technician" class="w-full h-full object-cover"
                    src="{{ $heroBgSrc }}" />
                <div class="absolute inset-0 hero-overlay"></div>
            </div>
            <div
                class="relative z-10 max-w-screen-2xl mx-auto px-4 sm:px-6 w-full grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12">
                <div class="relative">
                    <div
                        class="hidden sm:block absolute -left-4 sm:-left-8 -top-4 sm:-top-8 w-16 sm:w-24 h-16 sm:h-24 border-l-4 sm:border-l-8 border-t-4 sm:border-t-8 border-slate-400 opacity-50">
                    </div>
                    <h1
                        class="font-headline font-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white leading-tight mb-6 sm:mb-8">
                        {{ $homeContent?->hero_title_line1 ?: 'Serving Your Home and Business' }} <br />
                        {{ $homeContent?->hero_title_line2 ?: '469-288-8881' }} <br>
                        <span class="text-on-primary-container">{{ $homeContent?->hero_title_accent ?: 'One Door at a Time.' }}</span>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-200 font-light mb-8 sm:mb-10 max-w-lg whitespace-pre-wrap">
                        {{ $homeContent?->hero_lead ?: 'Licensed, experienced, and ready to take care of any job — big or small. Twins Garage Doors LLC is your trusted local expert for garage door and gate installation, repair, and service — for homes and businesses of all sizes. Service area: DFW. English & Spanish.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                        <a href="tel:+{{ $contactPhoneTel }}"
                            class="inline-flex w-full sm:w-auto items-center justify-center bg-on-primary-container text-primary px-6 sm:px-8 py-3 rounded font-headline font-bold text-sm sm:text-lg hover:brightness-110 transition-all text-center">
                            {{ $homeContent?->hero_cta_primary_label ?: 'Call Us Today For a Free Quote' }}
                        </a>
                        <button type="button"
                            class="w-full sm:w-auto border border-white/30 text-white px-6 sm:px-8 py-3 rounded font-headline font-bold text-sm sm:text-lg hover:bg-white/10 transition-all"
                            onclick="document.getElementById('servicios')?.scrollIntoView({behavior:'smooth'})">
                            {{ $homeContent?->hero_cta_secondary_label ?: 'Our Models' }}
                        </button>
                    </div>
                </div>
                <div class="hidden md:flex justify-end">
                    <div
                        class="relative w-80 h-96 bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden border border-white/20 p-4 shadow-2xl rotate-3 transform">
                        <img alt="Technician detail" class="w-full h-full object-cover rounded-2xl"
                            src="{{ $heroInsetSrc }}" />
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-surface py-12 sm:py-16 md:py-20 px-4 sm:px-6" id="about-preview">
            <div class="max-w-screen-2xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <div class="lg:col-span-4">
                    <h2 class="font-headline font-black text-3xl sm:text-4xl text-primary uppercase leading-tight mb-2">
                        {{ $homeContent?->about_heading ?: 'About us' }}
                    </h2>
                    <p class="font-headline font-bold text-on-primary-container text-lg sm:text-xl">
                        {{ $homeContent?->about_subheading ?: 'Twins Garage Doors LLC' }}
                    </p>
                    <a href="{{ route('about') }}"
                        class="mt-6 inline-flex items-center gap-2 text-primary font-headline font-bold text-sm uppercase tracking-wide hover:text-secondary transition-colors">
                        {{ $homeContent?->about_link_label ?: 'Learn more' }}
                        <span class="material-symbols-outlined text-lg">double_arrow</span>
                    </a>
                </div>
                <div class="lg:col-span-8 space-y-6 text-on-surface-variant leading-relaxed text-base sm:text-lg">
                    <p class="whitespace-pre-wrap">{{ $homeContent?->about_paragraph_1 ?: 'Twins Garage Doors LLC is a family-owned garage door and gate company serving the Dallas–Fort Worth metro area. We combine licensed workmanship, honest pricing, and responsive service for residential and commercial customers — in English and Spanish.' }}</p>
                    <p class="whitespace-pre-wrap">{{ $homeContent?->about_paragraph_2 ?: 'From new installations and opener upgrades to spring repairs and emergency calls, our team treats every property with care. We stand behind our work and build long-term relationships one door at a time.' }}</p>
                </div>
            </div>
        </section>
        <section class="py-12 sm:py-16 md:py-24 bg-[#1B365D]" id="servicios">
            <div class="grid-container">
                <div class="text-center mb-10 sm:mb-16">
                    <h2
                        class="text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-headline font-black text-white uppercase mb-0 tracking-tight leading-none">
                        {{ $homeContent?->services_heading_primary ?: 'Services' }}
                    </h2>
                    <p
                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-headline font-bold text-[#87A0CD] -mt-1 sm:-mt-2">
                        {{ $homeContent?->services_heading_accent ?: 'you need' }}
                    </p>
                </div>
                @if ($serviceCards->isNotEmpty())
                    <div class="services-swiper swiper relative px-10 sm:px-12"
                        data-services-count="{{ $serviceCards->count() }}">
                        <div class="swiper-wrapper">
                            @foreach ($serviceCards as $card)
                                <div class="swiper-slide h-auto">
                                    @include('partials.service_card_home', [
                                        'card' => $card,
                                        'iconIndex' => $loop->index,
                                    ])
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="swiper-button-prev" aria-label="Previous services"></button>
                        <button type="button" class="swiper-button-next" aria-label="Next services"></button>
                        <div class="swiper-pagination !relative mt-8"></div>
                    </div>
                @endif
            </div>
        </section>
        <section class="overflow-hidden" id="trabajo">
            <div class="bg-[#87A0CD] py-12 sm:py-16 md:py-20 px-4 sm:px-6">
                <div class="max-w-screen-2xl mx-auto">
                    <div class="mb-8 sm:mb-12">
                        <h2
                            class="text-primary font-headline font-black text-3xl sm:text-4xl md:text-5xl leading-none uppercase">
                            {{ $homeContent?->work_heading_primary ?: 'Our' }}</h2>
                        <h3
                            class="text-white font-headline font-black text-4xl sm:text-5xl md:text-6xl lg:text-8xl leading-none uppercase -mt-1 sm:-mt-2">
                            {{ $homeContent?->work_heading_accent ?: 'Work' }}</h3>
                        <div class="mt-6 max-w-2xl flex flex-col md:flex-row md:items-end gap-6">
                            <p class="text-primary font-body font-medium leading-relaxed whitespace-pre-wrap">
                                {{ $homeContent?->work_intro ?: 'Project photos will be featured here — residential and commercial installs and repairs across DFW.' }}
                            </p>
                            <a class="inline-flex items-center gap-2 bg-primary text-white px-6 py-2 rounded-full text-sm font-bold whitespace-nowrap hover:bg-opacity-90 transition-all uppercase"
                                href="{{ route('our_work') }}">
                                {{ $homeContent?->work_cta_label ?: 'Read more' }} <span class="material-symbols-outlined text-lg">double_arrow</span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-center bg-[#1B365D] rounded-2xl sm:rounded-[2rem] lg:rounded-[3rem] p-4 sm:p-6 lg:p-8">
                        <div
                            class="lg:col-span-8 h-56 sm:h-80 lg:h-[400px] overflow-hidden rounded-xl sm:rounded-[2.5rem]">
                            <img alt="Our team at work" class="w-full h-full object-cover"
                                src="{{ $workMainSrc }}" />
                        </div>
                        <div
                            class="lg:col-span-4 bg-white/10 backdrop-blur-md rounded-xl sm:rounded-[2.5rem] p-6 sm:p-8 flex flex-col justify-center gap-6 sm:gap-8">
                            @foreach ($homeStats as $stat)
                            <div>
                                <div class="text-white font-headline font-black text-4xl sm:text-5xl leading-tight">{{ $stat->stat_value }}</div>
                                <div class="text-[#87A0CD] font-headline font-bold text-xl uppercase tracking-wider">{{ $stat->stat_caption }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white py-12 sm:py-16 md:py-24 px-4 sm:px-6 relative" id="reviews">
                <div class="max-w-screen-2xl mx-auto">
                    <div class="text-center mb-10 sm:mb-16">
                        <h2
                            class="text-[#87A0CD] font-headline font-black text-3xl sm:text-4xl md:text-5xl leading-none uppercase">
                            {{ $homeContent?->reviews_heading_primary ?: 'Our' }}</h2>
                        <h3
                            class="text-primary font-headline font-black text-4xl sm:text-5xl md:text-6xl lg:text-8xl leading-none uppercase -mt-1 sm:-mt-2">
                            {{ $homeContent?->reviews_heading_accent ?: 'Experience' }}</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        @foreach ($homeTestimonials as $testimonial)
                            @php
                                $testimonialIcon = \App\Support\CmsPage::materialIconFromStored($testimonial->icon, $loop->index);
                            @endphp
                        <div
                            class="bg-[#1B365D] rounded-2xl sm:rounded-[2.5rem] p-6 sm:p-8 md:p-10 pt-14 sm:pt-16 relative shadow-xl mt-8 sm:mt-0">
                            <div class="absolute -top-6 {{ $loop->first ? 'left-8' : 'left-4 sm:left-8' }} bg-[#87A0CD] p-3 sm:p-4 rounded-2xl">
                                <span
                                    class="material-symbols-outlined text-white text-5xl font-black rotate-180">format_quote</span>
                            </div>
                            <div
                                class="absolute -top-10 right-8 w-20 h-20 rounded-full bg-white flex items-center justify-center border-4 border-[#1B365D]">
                                <span class="material-symbols-outlined text-4xl text-[#1B365D]">{{ $testimonialIcon }}</span>
                            </div>
                            <p class="text-white/80 text-sm leading-relaxed mb-8 italic whitespace-pre-wrap">
                                {{ $testimonial->quote }}
                            </p>
                            <div class="flex gap-1">
                                <span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
                                <span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
                                <span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
                                <span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
                                <span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center mt-10 sm:mt-12">
                        <a href="{{ route('reviews') }}"
                            class="inline-flex items-center gap-2 bg-[#87A0CD] text-primary px-8 py-3 rounded-full font-headline font-bold text-sm uppercase tracking-wide hover:brightness-110 transition-all">
                            {{ $homeContent?->reviews_cta_label ?: 'See all reviews' }}
                            <span class="material-symbols-outlined text-lg">double_arrow</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#A5C2F1] py-12 sm:py-16 px-4 sm:px-6" id="contacto">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-stretch gap-8 md:gap-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        @include('partials.brand_logo', ['size' => 'lg', 'link' => false, 'class' => 'mb-8'])
                        <h2 class="text-[#002046] font-headline font-black text-3xl sm:text-4xl mb-6 sm:mb-8">{{ $homeContent?->contact_heading ?: 'Contact Us' }}
                        </h2>
                        @if (session('status'))
                            <div class="mb-4 rounded-xl bg-white px-4 py-3 text-sm text-primary shadow-sm" role="status">
                                {{ session('status') }}
                            </div>
                        @endif
                        @error('mail')
                            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <form class="space-y-4" method="post" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <label class="block text-primary font-bold mb-1 text-sm" for="home-contact-name">Name</label>
                                <input
                                    class="w-full border-none p-0 focus:ring-0 text-on-surface-variant placeholder:text-slate-300"
                                    id="home-contact-name" name="name" type="text" value="{{ old('name') }}"
                                    placeholder="Your name" required />
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <label class="block text-primary font-bold mb-1 text-sm" for="home-contact-email">Email</label>
                                <input
                                    class="w-full border-none p-0 focus:ring-0 text-on-surface-variant placeholder:text-slate-300"
                                    id="home-contact-email" name="email" type="email" value="{{ old('email') }}"
                                    placeholder="you@example.com" required />
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <label class="block text-primary font-bold mb-1 text-sm" for="home-contact-message">Message</label>
                                <textarea class="w-full border-none p-0 focus:ring-0 text-on-surface-variant placeholder:text-slate-300 min-h-[120px]"
                                    id="home-contact-message" name="message" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="bg-[#1B365D] text-white px-10 py-3 rounded-full font-headline font-bold text-sm tracking-widest hover:brightness-110 transition-all shadow-md uppercase">
                                    Send
                                </button>
                            </div>
                        </form>
                        <div class="mt-12 space-y-4">
                            <div class="flex items-center gap-3 text-primary font-bold">
                                <div class="w-8 h-8 rounded-full border-2 border-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-lg">call</span>
                                </div>
                                <span>{{ $contactPhone }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-primary font-bold">
                                <div class="w-8 h-8 rounded-full border-2 border-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-lg">mail</span>
                                </div>
                                <span class="break-all text-sm sm:text-base">{{ $homeContent?->contact_email ?: 'twinsgaragedoors@gmail.com' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 min-h-[280px] sm:min-h-[360px] md:min-h-[400px]">
                        @include('partials.map_embed', ['mapEmbedUrl' => $mapEmbedUrl])
                    </div>
                </div>
                <div class="mt-16 pt-8 border-t border-primary/10">
                    @include('partials.social_follow', ['variant' => 'compact'])
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
(function () {
    var el = document.querySelector('.services-swiper');
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
