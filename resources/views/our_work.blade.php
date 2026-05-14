@extends('menu')

@section('page_title', 'Our Work — Twins Garage Doors')

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
    $heroMain = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCvc7AOPo-ZttsJRZS2MH2-FgtubnNVvXlO3neFJEpZCHr3P2G7Y4m0hOErxJAtcmc5P4JZ-JEgQdF9lX-TGudGVSH4ZTvVLpige8__n6Kr76hkGl0nkptweA7SHuL86rBat7WrNdxVZoCOoFeDJwjHucQm6q6AbmmOm9Ua2i0FSimWfdybSmNYK_-b1wK416TQUORhKt6991fj3ZbNPnZoCVHUnW5w7B0IarZi6drdzOUY2tOlJbRss-x1Hbm1BF_ZfQR5U7zFG6w';
    $heroInset = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsE1QvQ2WdcCfKvFKUQAyUjBc_G4aR0l8R3LnU7CO7sQuR1-6cPDnHsxiETzNJUiXJsZ8pCGI-7mTAZrQez1OtUWg77LDPQFLWfeMSp6n3VGcUOwgU33nCNizmULwHJvBjnAICahFCDIKJEFl34tG5R5wkVY2fMlwZ2t3-EOdUok2SKJ8L6I-4Pg4-5kzsGRscK85kHz7cgWYp_d5da5ykFQnMTkFbIBYBa3cIe_5DNCNCbio062HZ8JsG9gVsaJXJ6CJZBsW2Kqs';
    $projects = [
        'https://lh3.googleusercontent.com/aida-public/AB6AXuDKe3TmRrE15itoghxZt_ynRciglxYcHJfUSkpabUWJmVz7r6wrknqDtekb8ShfVGN2mPB22mCjM8aLigEJHkdMivfDMDsMfoa_R8Ubt2cB1sCwkHWg5bUeGalPm6Vcy_YbbmBFkhXVVbAjvUhcyumjmP0jHgjChPfwMweZhhx8r1tTzUKORMqaF3LaO2oENhCAfsva7TxMyYnrgqt_g4I6SSOPVUQFm4wWaV7PQELRENjQE42sib1wCbJDi0zAcsWteVY2umhlJP0',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuDr8HRcPmTz-09dPTWINJDMydxGKnDjFsDhcyU4o-VP2L-EY2az6HbzIOKsKzyvkVyfzTsam-dbDjN07kxsO43zW9o9XdtcrfT6t5CpqAJBusVgflOfWKAAvO95jHb4HdcdCu-4XjaDM-8JCeB0W2iqiVUPvsDgOeVrqDz4HcSqdTZnvtMIBRotN3HVst5HZde2L_xrCTo29mYD6Np4hOxT5ip2v0qFUtlBrkfTMi1GmQ2S_YaiKCrMDLvGeDwj2DxZmw3kEUQu1B8',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuB7Zt0DbBlPWfa0lERx62-t2c387TBzi3umr_VQA5cSYk0ALC7pB7e1FdzEHa8MOiic6hh4bs9tRMOXLWGHxoXSGE5BMchXqPeEwAMOmBwiNegU9_12xxIDls7iCWVq7UoLOnCEQ6KUXcBs0sKV6DfoJjl2iOW1aFVctVdjzJRDQVQqUiEY6LzyB7_8CxrcRQ_k-ym1MmR0vtMuwrTTLEmRUkgvqZB-qPTlxOE43Oc3WNMFBOhLU-_w5tDXMAqmy2M-JPp3ExvBAsI',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuAxU5JJTR0pOttthQEYrULXYUr7TFtG59VeCfrBqp8NAh9rNZ6dI-zUhAgXgrpKDLiWyA90RqYe0_i5higWW5b-72q6MK7ZWdhkMgUuc6Hh0yyc5Eq8f4Py_zJyCdWFhuTP_Z-FhtEMF6CMLOqMnMeyeAAUfpj6zyzpadwTeBjTDOP3jUZC2YUuo86xa90Nhc1WZyoBznIWgTR6uevV7Bzmdy_e_wJjo324fH1leydCE3j5CEUA-iBZyoUB9SwEKCCGP5kCRiawAIw',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuABPnPYv_EiW5o5p49rsP5ePl7zAxou33pB4rtqS5hYOObO8B5BM7bxpJQvJ8JbV3c_I2kKFKHcEtEsvO4NRah5h2BvdJEGoEvJp-Q0Mju3UIeCFfgLlLwP2wKGDXPLGWRN7Q-lFqv7LqOcIuF0qm33JIl6mIpkYwZxXy-pPunI-kSa0TF0gqjsFo92MUCOP5ozR8ASVnj1dXUSEDBzZHp5yh-E6ajyG1dFxeLZq1R7IRW9hUoq4WMifc21qJf39o4W9K2iGPvHAnM',
        'https://lh3.googleusercontent.com/aida-public/AB6AXuDfigx7d3j07Xhq18X2pWJOOjWFJq9w_tlLnfy3aSf1S1xGoGy1r63hOrzi0V27q6cgoMmOW064ORyLbFpiGlsYmFKX806xxoS5mXdJ094T7I22T-OSrGh4uCcCppxUp6oXx5Bt3sTA06sGDQfhYcU8nUtNjouAqCY7KH6-Zp69bXS74zT334zv7HgQRqFtD0hthG90NbUATTOKrhEgVYFwFvlEEkAcwcx40GKnHMxenMf2TaLZwpqqHbw_cciUqmRxQyEohpPOHJE',
    ];
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
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </div>
                            <h1 class="font-headline text-4xl font-black leading-none text-primary-container md:text-5xl lg:text-6xl">
                                Our <br/>
                                <span class="text-on-primary-container uppercase italic">Work</span>
                            </h1>
                        </div>
                        <p class="max-w-xl text-base leading-relaxed text-on-surface-variant md:text-lg">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                        </p>
                        <a href="{{ url('/#contacto') }}" class="inline-flex items-center gap-2 rounded-full bg-primary-container px-6 py-3 font-headline text-xs font-bold uppercase tracking-widest text-on-primary transition-colors hover:bg-secondary">
                            Leer más
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="relative w-full lg:w-1/2">
                        <div class="our-work-hero-bg-shape bg-secondary-container/30 p-6 md:p-8">
                            <img
                                alt="Professional technician"
                                class="our-work-hero-bg-shape w-full object-cover shadow-2xl transition duration-500 hover:grayscale-0"
                                src="{{ $heroMain }}"
                            />
                        </div>
                        <div class="absolute right-0 top-10 z-10 rounded-l-3xl bg-primary-container p-5 text-on-primary shadow-xl md:p-6">
                            <p class="font-headline text-3xl font-black md:text-4xl">+100</p>
                            <p class="text-sm font-semibold text-on-primary-container opacity-90">Lorem ipsum</p>
                        </div>
                        <div class="absolute bottom-10 right-4 z-20 w-1/2 max-w-[220px] overflow-hidden rounded-2xl border-4 border-surface-container-lowest shadow-2xl sm:max-w-xs">
                            <img alt="Finished installation" class="w-full object-cover" src="{{ $heroInset }}"/>
                        </div>
                    </div>
                </div>
            </section>

            <section id="projects" data-purpose="projects-grid">
                <div class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 md:gap-y-16 lg:grid-cols-3 lg:gap-x-10">
                    @foreach ($projects as $src)
                        <article class="flex flex-col" data-purpose="project-card">
                            <div class="relative mb-6">
                                <div class="our-work-diagonal-cut-img overflow-hidden">
                                    <img alt="Garage door project" class="block h-72 w-full object-cover" src="{{ $src }}"/>
                                </div>
                                <div class="absolute bottom-0 right-0 p-1">
                                    <div class="our-work-icon-shadow rounded-full border-4 border-surface bg-[#365e9e] p-3 text-on-primary">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2">
                                <h3 class="mb-2 font-headline text-xl font-bold text-primary-container md:text-2xl">Lorem ipsum</h3>
                                <p class="mb-6 text-base leading-snug text-on-surface-variant">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt
                                </p>
                                <a href="{{ url('/#contacto') }}" class="inline-flex items-center gap-2 rounded bg-primary-container px-4 py-2 font-headline text-xs font-bold uppercase tracking-wide text-on-primary transition-colors hover:bg-secondary">
                                    Leer más
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
