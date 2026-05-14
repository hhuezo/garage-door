@extends('menu_main')

@section('page_title', 'Reviews — Twins Garage Doors')

@push('styles')
<style data-purpose="reviews-page">
    .reviews-diagonal-img {
        clip-path: polygon(0 0, 100% 0, 100% 82%, 82% 100%, 0 100%);
    }
    .reviews-hard-shadow {
        box-shadow: 3px 3px 0 0 #1b365d;
    }
    .reviews-fill-icon {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>
@endpush

@php
    $testimonials = [
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAFCiJ6-oonoQnyMfU9Ag66YyJZ8AysmMkFuT4uHL5-tnRYrSODzx4ZW-k3cpWRn8LShnABrRteQeCrKFKrBMYhBtAmbzaAzfzKVx5NTBlWNpe_0Vfe-efzVD0RIcrf_IycOei8RGoDTrBtvAGRBzwi_bVbvJcx-i6m9jw5jYoKhvyUkBeqstdfZ4xvQjDrAqXMHHvnBSBkJUFHYihGXZ8qbs1oGFMZf818wWtQf78X62-ZzBZKtFp3ZnoHOIdfSwaZDEoiX1T5JOY',
            'title' => 'Professional installation and spotless cleanup.',
            'body' => 'From the first call to the final walkthrough, the crew was on time, respectful of our property, and the new door looks fantastic.',
            'name' => 'Maria G.',
            'offset' => false,
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDQ4UjQXXb6KDNSZlsz5dyulMMi5jMDqr-O_JL8UcvXwmZDiDlq9FAXRb4oliv71AEmOUizQYgu-TgDl4D0jnT-nv443bhlVnweY0-Kyfr7ZF99_q9Zmgm-5jsKf_UU6qJmaSSszTDGC3IPxoXLZ7-W5EbIrUMLqh2ybxV6RP5T2aOpUKhh-FGjf0QUwKzNoX6U4YpvOFWBlM3lvUc7Np4v7ANbb9bmT1_afnyCBO-rZ8Xjy4RGcZziApG-zjMDAiUZy_jJV7PEgVo',
            'title' => 'Fast response when our spring failed — highly recommend.',
            'body' => 'They diagnosed the issue quickly, explained the options clearly, and had us back in business the same day. Fair pricing and honest service.',
            'name' => 'James T.',
            'offset' => true,
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDCos-3Mi_vxPTWYu4xYtZ7NBB-h8l5piYkiOpeYflwVwFx8wMPdK6RaEPyZy-m_tOryYtZcRy2baAVwLZ_WbPylErlQg_pkDso9V993NX7_g22NfK1hOX0Uo5AWc0BrSQ_INSDD9urd-Si7eZiEzAHsDBCCUk0DbMcFQ5CDmu9MrlrAKiDzpO-JthuMUt5D5qpdfJPTceQyXHxMBFBNsrNrWQHaYU4TebAK1cmwnNqKCMI0fHVatcF36ktYCXj9ELLyD9UEF6L6Hw',
            'title' => 'Beautiful modern doors — our curb appeal jumped overnight.',
            'body' => 'Twins Garage Doors helped us pick the right style for our home. Installation was smooth and the team communicated every step of the way.',
            'name' => 'Elena R.',
            'offset' => false,
        ],
    ];
@endphp

@section('content')
<div class="bg-background font-body text-on-background">
    <div class="mx-auto w-full max-w-screen-2xl">
        <section class="px-4 py-12 text-center sm:px-8 md:px-16 md:py-16 lg:px-20 lg:py-20">
            <h1 class="font-headline text-3xl font-extrabold tracking-tight text-secondary-container sm:text-4xl md:text-[2.25rem]">
                What our customers say
            </h1>
            <h2 class="mt-2 font-headline text-3xl font-extrabold tracking-tight text-primary-container sm:text-4xl md:text-[2.25rem]">
                Reviews &amp; testimonials
            </h2>
        </section>

        <section class="px-4 pb-12 sm:px-8 md:px-16 md:pb-16 lg:px-20">
            <div class="mx-auto grid max-w-7xl grid-cols-1 items-start gap-6 md:grid-cols-3 md:gap-8">
                @foreach ($testimonials as $item)
                    <article class="flex flex-col overflow-hidden rounded-xl border border-surface-variant bg-surface-container-lowest shadow-sm {{ $item['offset'] ? 'md:translate-y-10 lg:translate-y-12' : '' }}">
                        <div class="relative h-56 overflow-hidden sm:h-60 md:h-64">
                            <div class="reviews-diagonal-img h-full w-full overflow-hidden">
                                <img
                                    alt="Garage door project"
                                    class="h-full w-full object-cover"
                                    src="{{ $item['image'] }}"
                                />
                            </div>
                        </div>
                        <div class="flex flex-grow flex-col p-6 sm:p-8">
                            <p class="mb-4 font-headline text-base font-bold leading-snug text-primary sm:text-lg">
                                {{ $item['title'] }}
                            </p>
                            <p class="mb-6 flex-grow text-sm leading-relaxed text-on-surface-variant sm:text-base">
                                {{ $item['body'] }}
                            </p>
                            <div class="mt-auto flex items-center gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-full bg-secondary-fixed text-primary-container">
                                    <span class="material-symbols-outlined text-3xl">person</span>
                                </div>
                                <div>
                                    <p class="font-headline text-xs font-bold uppercase tracking-wide text-primary">{{ $item['name'] }}</p>
                                    <div class="flex text-[#FFD700]">
                                        @for ($s = 0; $s < 5; $s++)
                                            <span class="material-symbols-outlined reviews-fill-icon text-base">star</span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center gap-6 md:mt-16">
                <button type="button" class="flex h-14 w-14 items-center justify-center rounded-full bg-secondary-fixed text-primary transition-all hover:bg-secondary-container" aria-label="Previous testimonials">
                    <span class="material-symbols-outlined text-3xl">arrow_back</span>
                </button>
                <button type="button" class="flex h-14 w-14 items-center justify-center rounded-full bg-secondary-fixed text-primary transition-all hover:bg-secondary-container" aria-label="Next testimonials">
                    <span class="material-symbols-outlined text-3xl">arrow_forward</span>
                </button>
            </div>
        </section>

        <section class="px-4 pb-12 sm:px-8 md:px-16 md:pb-16 lg:px-20">
            <div class="reviews-hard-shadow mx-auto max-w-md rounded-2xl border-2 border-secondary-container bg-primary-container px-4 py-4 text-center sm:max-w-lg sm:rounded-3xl sm:px-6 sm:py-5">
                <h3 class="mb-4 font-headline text-sm font-bold text-on-primary sm:mb-5 sm:text-base">Call for service</h3>
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-6">
                    <a href="tel:+14692888881" class="flex items-center gap-2 text-on-primary transition-opacity hover:opacity-90">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-secondary-container text-primary-container">
                            <span class="material-symbols-outlined reviews-fill-icon text-base">call</span>
                        </span>
                        <span class="font-headline text-sm font-semibold sm:text-[0.9375rem]">469-288-8881</span>
                    </a>
                    <a href="mailto:twinsgaragedoors@gmail.com" class="flex min-w-0 items-center gap-2 text-on-primary transition-opacity hover:opacity-90">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-secondary-container text-primary-container">
                            <span class="material-symbols-outlined reviews-fill-icon text-base">mail</span>
                        </span>
                        <span class="break-all text-left font-body text-xs font-medium leading-snug sm:text-sm">twinsgaragedoors@gmail.com</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
