@extends('menu_main')

@section('page_title', 'Contact Us — Twins Garage Doors')

@push('styles')
<style data-purpose="contact-page">
    /* Sombra desplazada: el contenedor max-w-6xl lleva pr/pb extra para que no se recorte */
    .contact-page-hard-shadow {
        box-shadow: 6px 6px 0 0 #002046;
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

    <section class="relative z-20 -mt-12 px-4 pb-10 sm:-mt-14 sm:px-6 md:-mt-20 md:px-8 md:pb-16 lg:-mt-24 lg:px-20">
        <div class="mx-auto max-w-6xl pr-2 pb-2 sm:pr-3 sm:pb-3 md:pr-4 md:pb-4">
            @if (session('status'))
                <div class="contact-page-hard-shadow mb-5 rounded-md border border-outline-variant bg-secondary-container/30 px-4 py-3 font-body text-xs text-primary sm:text-sm" role="status">
                    {{ session('status') }}
                </div>
            @endif

            <div class="contact-page-hard-shadow grid grid-cols-1 gap-0 overflow-hidden rounded-md border border-outline-variant bg-surface-container-lowest md:grid-cols-12">
                <div class="border-outline-variant bg-surface-container-low p-6 md:col-span-5 md:border-r md:p-8 lg:p-10">
                    <h2 class="mb-4 font-headline text-lg font-bold text-primary md:text-xl">Get in touch</h2>
                    <p class="mb-8 text-sm leading-relaxed text-on-surface-variant md:text-[0.9375rem]">
                        Our team is ready to help with garage door and gate installation, repairs, and support. Reach out for a reliable, built-to-last solution.
                    </p>
                    <div class="mb-8 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center bg-primary">
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
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center bg-secondary">
                                <span class="material-symbols-outlined text-xl text-on-secondary" style="font-variation-settings: 'FILL' 1;">call</span>
                            </div>
                            <div>
                                <h4 class="mb-0.5 font-headline text-[10px] font-bold uppercase tracking-widest text-primary">Call or WhatsApp</h4>
                                <p class="text-sm text-on-surface md:text-[0.9375rem]">
                                    <a href="tel:+14692888881" class="hover:text-secondary transition-colors">469-288-8881</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center bg-primary">
                                <span class="material-symbols-outlined text-xl text-on-primary" style="font-variation-settings: 'FILL' 1;">mail</span>
                            </div>
                            <div>
                                <h4 class="mb-0.5 font-headline text-[10px] font-bold uppercase tracking-widest text-primary">Email</h4>
                                <p class="text-sm text-on-surface md:text-[0.9375rem]">
                                    <a href="mailto:twinsgaragedoors@gmail.com" class="break-all hover:text-secondary transition-colors">twinsgaragedoors@gmail.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-3 font-headline text-[10px] font-bold uppercase tracking-widest text-primary">Follow us</h3>
                        <div class="flex gap-3">
                            <a class="flex h-10 w-10 items-center justify-center bg-primary text-on-primary transition-colors hover:bg-secondary" href="#" aria-label="TikTok">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.29 0 .57.04.83.12V9.5a6.33 6.33 0 0 0-1.25-.12 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 10.75 4.51c.29-.27.53-.57.73-.91V6.69z"/></svg>
                            </a>
                            <a class="flex h-10 w-10 items-center justify-center bg-primary text-on-primary transition-colors hover:bg-secondary" href="#" aria-label="Instagram">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                            </a>
                            <a class="flex h-10 w-10 items-center justify-center bg-primary text-on-primary transition-colors hover:bg-secondary" href="#" aria-label="Facebook">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-surface-container-lowest p-6 md:col-span-7 md:p-8 lg:p-10">
                    <h2 class="mb-6 font-headline text-lg font-bold text-primary md:text-xl">Send us a message</h2>
                    <form class="space-y-4 md:space-y-5" method="post" action="{{ route('contact.submit') }}">
                        @csrf
                        <div>
                            <label class="mb-1.5 block font-headline text-[10px] font-bold uppercase tracking-widest text-primary" for="contact-name">Full Name</label>
                            <input
                                class="w-full border-2 border-surface-container-highest px-3 py-2.5 font-body text-sm outline-none transition-all focus:border-secondary focus:ring-0 md:text-[0.9375rem]"
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
                                <label class="mb-1.5 block font-headline text-[10px] font-bold uppercase tracking-widest text-primary" for="contact-phone">Phone</label>
                                <input
                                    class="w-full border-2 border-surface-container-highest px-3 py-2.5 font-body text-sm outline-none transition-all focus:border-secondary focus:ring-0 md:text-[0.9375rem]"
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
                                <label class="mb-1.5 block font-headline text-[10px] font-bold uppercase tracking-widest text-primary" for="contact-email">Email address</label>
                                <input
                                    class="w-full border-2 border-surface-container-highest px-3 py-2.5 font-body text-sm outline-none transition-all focus:border-secondary focus:ring-0 md:text-[0.9375rem]"
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
                            <label class="mb-1.5 block font-headline text-[10px] font-bold uppercase tracking-widest text-primary" for="contact-subject">Subject</label>
                            <input
                                class="w-full border-2 border-surface-container-highest px-3 py-2.5 font-body text-sm outline-none transition-all focus:border-secondary focus:ring-0 md:text-[0.9375rem]"
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
                            <label class="mb-1.5 block font-headline text-[10px] font-bold uppercase tracking-widest text-primary" for="contact-message">Message</label>
                            <textarea
                                class="w-full resize-none border-2 border-surface-container-highest px-3 py-2.5 font-body text-sm outline-none transition-all focus:border-secondary focus:ring-0 md:text-[0.9375rem]"
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
                            <button class="bg-primary px-6 py-2.5 font-headline text-[10px] font-bold uppercase tracking-widest text-on-primary transition-colors hover:bg-secondary sm:px-8 sm:text-xs" type="submit">
                                Send message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
