@extends('menu_main')

@section('page_title', 'Contact Us — Twins Garage Doors')

@php
    $contactPhone = $homeContent?->contact_phone ?: '469-288-8881';
    $contactEmail = $homeContent?->contact_email ?: 'twinsgaragedoors@gmail.com';
    $phoneHref = 'tel:+1'.preg_replace('/\D/', '', $contactPhone);
@endphp

@push('styles')
<style data-purpose="contact-page">
    .contact-card {
        border-radius: 1.25rem;
        background: #fff;
        box-shadow: 0 20px 50px rgba(0, 32, 70, 0.12);
    }
    @media (min-width: 640px) {
        .contact-card {
            border-radius: 1.75rem;
        }
    }
    .contact-label {
        display: block;
        margin-bottom: 0.375rem;
        font-family: var(--font-headline, inherit);
        font-size: 0.625rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--color-primary, #002046);
    }
    .contact-input {
        width: 100%;
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
        background: #fff;
        padding: 0.625rem 0.875rem;
        font-family: var(--font-body, inherit);
        font-size: 0.875rem;
        outline: none;
        transition: border-color 0.15s ease;
    }
    .contact-input:focus {
        border-color: var(--color-secondary, #4a90c8);
        box-shadow: 0 0 0 2px rgba(74, 144, 200, 0.15);
    }
    @media (min-width: 768px) {
        .contact-input {
            font-size: 0.9375rem;
        }
    }
    .contact-btn {
        border-radius: 9999px;
        background: var(--color-primary, #002046);
        padding: 0.625rem 1.75rem;
        font-family: var(--font-headline, inherit);
        font-size: 0.625rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #fff;
        transition: background-color 0.15s ease;
    }
    .contact-btn:hover {
        background: var(--color-secondary, #4a90c8);
    }
    @media (min-width: 640px) {
        .contact-btn {
            padding-left: 2rem;
            padding-right: 2rem;
            font-size: 0.75rem;
        }
    }
    .contact-flash {
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
        background: rgba(255, 255, 255, 0.9);
        padding: 0.75rem 1rem;
        font-size: 0.75rem;
        color: var(--color-primary, #002046);
    }
    @media (min-width: 640px) {
        .contact-flash {
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@section('content')
<div class="bg-background font-body text-on-background">
    <section class="relative flex min-h-[200px] flex-col items-center justify-start overflow-hidden bg-primary-container pt-6 pb-8 sm:min-h-[210px] sm:pt-8 md:min-h-[220px] md:pt-10 md:pb-10">
        <div class="absolute inset-0 opacity-20">
            <img
                alt="Technicians performing maintenance on a sectional garage door in a professional workspace"
                class="h-full w-full object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzt3pDpfzSxXN_7221hmY-tXNFX7r96l2oDa5aOCdVzFO6U-zit9jWe6OOtTGTWtqtVNDGB4_ct0UWCdQxe29PK0bhSj86_57Ky4hyvWtuXJqMZdixFSAe9L3-LlqmizCWctQVwdcwEmj5HfJZLuGvuqEUYGW0ac2Zsn57PYZTH7QLSrONdAmUnNtshJlqpEm0ymiedvKbLvY1QtauseL-X4aWuYMT1MaxjCv_4wVDxmbaza0YYFPMqSF19tNewaQHzZLRkO8XpPw"
            />
        </div>
        <div class="relative z-10 w-full px-4 text-center sm:px-6 md:px-8">
            <h1 class="font-headline text-3xl font-black leading-tight text-on-primary sm:text-4xl md:text-[2.25rem]">Contact us</h1>
        </div>
    </section>

    <section class="relative z-20 -mt-12 px-4 pb-12 sm:-mt-14 sm:px-6 sm:pb-16 md:-mt-20 md:px-8 md:pb-20 lg:-mt-24 lg:px-20">
        <div class="mx-auto max-w-6xl">
            @if (session('status'))
                <div class="contact-flash mb-5" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @error('mail')
                <div class="mb-5 rounded-xl border border-error/30 bg-error-container px-4 py-3 text-sm text-on-error-container" role="alert">
                    {{ $message }}
                </div>
            @enderror

            @if (session('appointment_status'))
                <div class="contact-flash mb-5" role="status">
                    {{ session('appointment_status') }}
                </div>
            @endif

            <div class="contact-card grid grid-cols-1 gap-0 overflow-hidden md:grid-cols-12">
                <div class="p-6 md:col-span-5 md:border-r md:border-gray-100 md:p-8 lg:p-10">
                    <h2 class="mb-4 font-headline text-lg font-bold text-primary md:text-xl">Get in touch</h2>
                    <p class="mb-8 text-sm leading-relaxed text-on-surface-variant md:text-[0.9375rem]">
                        Our team is ready to help with garage door and gate installation, repairs, and support. Reach out for a reliable, built-to-last solution.
                    </p>
                    <div class="mb-8 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-primary">
                                <span class="material-symbols-outlined text-xl text-on-primary" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            </div>
                            <div>
                                <h4 class="mb-0.5 font-headline text-[10px] font-bold uppercase tracking-widest text-primary">Service area</h4>
                                <p class="text-sm text-on-surface md:text-[0.9375rem]">
                                    Dallas–Fort Worth metro area<br/>
                                    Texas
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-secondary">
                                <span class="material-symbols-outlined text-xl text-on-secondary" style="font-variation-settings: 'FILL' 1;">call</span>
                            </div>
                            <div>
                                <h4 class="mb-0.5 font-headline text-[10px] font-bold uppercase tracking-widest text-primary">Call or WhatsApp</h4>
                                <p class="text-sm text-on-surface md:text-[0.9375rem]">
                                    <a href="{{ $phoneHref }}" class="transition-colors hover:text-secondary">{{ $contactPhone }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-primary">
                                <span class="material-symbols-outlined text-xl text-on-primary" style="font-variation-settings: 'FILL' 1;">mail</span>
                            </div>
                            <div>
                                <h4 class="mb-0.5 font-headline text-[10px] font-bold uppercase tracking-widest text-primary">Email</h4>
                                <p class="text-sm text-on-surface md:text-[0.9375rem]">
                                    <a href="mailto:{{ $contactEmail }}" class="break-all transition-colors hover:text-secondary">{{ $contactEmail }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @include('partials.social_follow', ['variant' => 'contact'])
                </div>

                <div class="bg-white p-6 md:col-span-7 md:p-8 lg:p-10">
                    <h2 class="mb-6 font-headline text-lg font-bold text-primary md:text-xl">Send us a message</h2>
                    <form class="space-y-4 md:space-y-5" method="post" action="{{ route('contact.submit') }}">
                        @csrf
                        <div>
                            <label class="contact-label" for="contact-name">Full Name</label>
                            <input
                                class="contact-input"
                                id="contact-name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="Your name"
                                required
                            />
                            @error('name')
                                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-5">
                            <div>
                                <label class="contact-label" for="contact-phone">Phone</label>
                                <input
                                    class="contact-input"
                                    id="contact-phone"
                                    name="phone"
                                    type="tel"
                                    value="{{ old('phone') }}"
                                    placeholder="(469) 000-0000"
                                />
                                @error('phone')
                                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="contact-label" for="contact-email">Email address</label>
                                <input
                                    class="contact-input"
                                    id="contact-email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    placeholder="example@domain.com"
                                    required
                                />
                                @error('email')
                                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label class="contact-label" for="contact-subject">Subject</label>
                            <input
                                class="contact-input"
                                id="contact-subject"
                                name="subject"
                                type="text"
                                value="{{ old('subject') }}"
                                placeholder="Service request / inquiry"
                            />
                            @error('subject')
                                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="contact-label" for="contact-message">Message</label>
                            <textarea
                                class="contact-input resize-none"
                                id="contact-message"
                                name="message"
                                rows="5"
                                placeholder="How can we help you?"
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end pt-1">
                            <button class="contact-btn" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('partials.services_map_section', ['homeContent' => $homeContent ?? null])

    @include('partials.contact_appointment_section')
</div>
@endsection
