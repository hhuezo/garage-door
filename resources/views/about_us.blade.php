@extends('menu')

@section('page_title', 'About Us - Twins Garage Doors')

@push('styles')
<style data-purpose="about-us-custom">
    .card-notched {
        clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 85% 100%, 0% 100%);
    }
    .badge-notched {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 15% 100%);
    }
    .image-notched {
        clip-path: polygon(0% 0%, 100% 0%, 100% 80%, 80% 100%, 0% 100%);
    }
    /* Solo dentro de esta página: no pisa .house-outline-bg del resto del sitio */
    .about-us-main > .house-outline-bg {
        position: absolute;
        right: -5%;
        top: 5%;
        width: 50%;
        height: 70%;
        pointer-events: none;
        z-index: 0;
        opacity: 0.4;
    }
    .about-us-main > .house-outline-bg svg {
        width: 100%;
        height: 100%;
    }
    .about-us-card-btn-shadow {
        box-shadow: 0 10px 25px -5px rgba(11, 49, 105, 0.2);
    }
</style>
@endpush

@section('content')
<div class="bg-[#f0f3f8]">
    <div class="mx-auto w-full max-w-screen-2xl px-6 py-12 sm:px-8 md:py-20 lg:px-12 xl:px-14">
        <main class="about-us-main relative w-full font-body text-gray-800">
    <div class="house-outline-bg hidden lg:block" aria-hidden="true">
        <svg fill="none" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
            <path d="M50 150 L200 50 L350 150 V350 H50 Z" fill="transparent" stroke="white" stroke-width="40"></path>
        </svg>
    </div>

    <header class="mb-12 relative z-10" data-purpose="header">
        <h1 class="font-headline text-6xl font-extrabold text-[#0b3169] mb-1">About us</h1>
        <p class="font-headline text-4xl font-bold text-on-primary-container">Lorem ipsum</p>
    </header>

    <section class="relative grid grid-cols-1 lg:grid-cols-2 gap-16 items-start mb-24" data-purpose="hero-layout">
        <div class="relative z-10" data-purpose="image-container">
            <div class="image-notched bg-white">
                <img alt="Garage Door Technician" class="w-full h-auto object-cover min-h-[500px]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqdfwUqi8SqjPSf2uKRLb8oX6xUMd0IUAAjiI2sgXZliqo7Xd6m--M8zTRbJYUEcITU6ohY9DVyTkKOICVsRwiMNhI-SzyS0jGNL0GomlWeLUhaZlhibFdlucGywhXj5Puy_gSVNMEzpXt_eP0DD1Kkld2S1IPPNIc2KVVT2KWKeEKL1906hMa26Si3P6CzquA3xuLSC_9rksxiY09zKVhyYtNm7a58NfZMNYxR_BTUfifAnc1WgtlLjMadmHrQhPWk_1LvFyMcP-r">
            </div>
            <div class="absolute bottom-10 -left-8 bg-[#0b3169] text-white p-8 badge-notched flex items-center gap-4 shadow-2xl min-w-[280px]" data-purpose="stats-badge">
                <span class="text-6xl font-bold font-headline">3.5k</span>
                <span class="text-[11px] leading-tight uppercase font-extrabold tracking-widest opacity-90">Proyectos<br>Este Año</span>
            </div>
        </div>

        <div class="relative z-10 lg:pt-12" data-purpose="content-right">
            <div class="flex flex-col gap-8">
                <div class="flex items-center gap-5">
                    <div class="bg-secondary-container/50 p-4 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#0b3169] text-3xl font-bold">engineering</span>
                    </div>
                    <h2 class="text-5xl font-headline font-extrabold text-[#0b3169]">Lorem ipsum</h2>
                </div>
                <div class="space-y-6 text-[#0b3169]/80 leading-relaxed text-lg">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</p>
                </div>
                <div class="pt-4">
                    <p class="text-on-primary-container font-extrabold uppercase tracking-widest leading-relaxed text-[11px] max-w-md">
                        LOREM IPSUM DOLOR SIT AMET, CONSECTETUER ADIPISCING ELIT, SED DIAM NONUMMY NIBH EUISMOD TINCIDUNT UT LAOREET DOLORE MAGNA ALIQUAM ERAT VOLUTPAT. UT WISI ENIM AD MINIM VENIAM,
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 mb-10 flex flex-col items-center justify-center text-center" data-purpose="middle-logo">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 border-[5px] border-[#0b3169] flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 border-t-[5px] border-[#0b3169] transform -rotate-45 origin-top-left scale-150"></div>
                <div class="w-8 h-8 border-2 border-[#0b3169]/20 rotate-45 flex items-center justify-center"></div>
            </div>
            <div class="flex flex-col items-start leading-none">
                <span class="text-[#0b3169] font-black text-3xl uppercase tracking-tighter">Twins</span>
                <span class="text-[#0b3169] font-bold text-xl uppercase tracking-tighter -mt-1">Garage Doors</span>
            </div>
        </div>
        <h3 class="font-headline text-5xl font-bold text-on-primary-container">Lorem ipsum</h3>
    </section>

    <section class="relative z-10 grid grid-cols-1 gap-10 pt-6 md:grid-cols-3 md:pt-4" data-purpose="cards-container">
        {{-- Tarjeta 1: icono fuera del clip para que no se recorte --}}
        <div class="relative z-10 flex h-full flex-col" data-purpose="feature-card">
            <div class="absolute left-12 top-8 z-20 w-fit -translate-y-1/2 rounded-full bg-on-primary-container p-5">
                <span class="material-symbols-outlined text-4xl text-white">engineering</span>
            </div>
            <div class="card-notched mt-8 flex min-h-[480px] flex-grow flex-col overflow-hidden bg-[#0b3169] px-12 pb-20 pt-20 text-white shadow-2xl">
                <h4 class="mb-6 font-headline text-4xl font-bold">Lorem ipsum</h4>
                <p class="mb-auto text-base leading-relaxed opacity-90">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
                <a href="{{ url('/#contacto') }}" class="mt-5 flex w-fit items-center gap-3 rounded-full bg-white px-8 py-3.5 text-xs font-black uppercase tracking-widest text-[#0b3169] transition hover:bg-secondary-container">
                    Leer más
                    <span class="text-xl font-bold">»</span>
                </a>
            </div>
        </div>

        {{-- Tarjeta 2 --}}
        <div class="relative z-10 flex h-full flex-col" data-purpose="feature-card">
            <div class="absolute left-12 top-8 z-20 -translate-y-1/2 rounded-full bg-secondary-container p-5">
                <span class="material-symbols-outlined text-4xl text-[#0b3169]">engineering</span>
            </div>
            <div class="card-notched mt-8 flex min-h-[480px] flex-grow flex-col overflow-hidden bg-white px-12 pb-20 pt-20 text-[#0b3169] shadow-lg">
                <h4 class="mb-6 font-headline text-4xl font-bold text-on-primary-container">Lorem ipsum</h4>
                <p class="mb-auto text-base font-medium leading-relaxed text-gray-600">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
                <a href="{{ url('/#contacto') }}" class="about-us-card-btn-shadow mt-5 flex w-fit items-center gap-3 rounded-full bg-[#0b3169] px-8 py-3.5 text-xs font-black uppercase tracking-widest text-white shadow-lg transition hover:bg-[#0b3169]/90">
                    Leer más
                    <span class="text-xl font-bold">»</span>
                </a>
            </div>
        </div>

        {{-- Tarjeta 3 --}}
        <div class="relative z-10 flex h-full flex-col" data-purpose="feature-card">
            <div class="absolute left-12 top-8 z-20 -translate-y-1/2 rounded-full bg-secondary-container p-5">
                <span class="material-symbols-outlined text-4xl text-[#0b3169]">engineering</span>
            </div>
            <div class="card-notched mt-8 flex min-h-[480px] flex-grow flex-col overflow-hidden bg-white px-12 pb-20 pt-20 text-[#0b3169] shadow-lg">
                <h4 class="mb-6 font-headline text-4xl font-bold text-on-primary-container">Lorem ipsum</h4>
                <p class="mb-auto text-base font-medium leading-relaxed text-gray-600">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
                <a href="{{ url('/#contacto') }}" class="about-us-card-btn-shadow mt-5 flex w-fit items-center gap-3 rounded-full bg-[#0b3169] px-8 py-3.5 text-xs font-black uppercase tracking-widest text-white shadow-lg transition hover:bg-[#0b3169]/90">
                    Leer más
                    <span class="text-xl font-bold">»</span>
                </a>
            </div>
        </div>
    </section>
        </main>
    </div>
</div>
@endsection
