@php
    $content = $aboutContent ?? null;
    if (! $content) {
        return;
    }

    $heading = trim((string) ($content->cta_banner_heading ?? ''));
    $whatsappLabel = trim((string) ($content->cta_banner_whatsapp_label ?? ''));
    $whatsappUrlRaw = trim((string) ($content->cta_banner_whatsapp_url ?? ''));
    $emailLabel = trim((string) ($content->cta_banner_email_label ?? ''));
    $emailRaw = trim((string) ($content->cta_banner_email ?? ''));

    $hasWhatsapp = $whatsappLabel !== '' || $whatsappUrlRaw !== '';
    $hasEmail = $emailLabel !== '' || $emailRaw !== '';

    if ($heading === '' && ! $hasWhatsapp && ! $hasEmail) {
        return;
    }

    $resolveHref = function (?string $raw, string $type = 'generic'): string {
        $r = trim((string) ($raw ?? ''));
        if ($r === '') {
            return $type === 'email' ? '#' : route('contact');
        }
        if (str_starts_with($r, 'http://') || str_starts_with($r, 'https://') || str_starts_with($r, 'mailto:') || str_starts_with($r, 'tel:')) {
            return $r;
        }
        if ($type === 'email' && str_contains($r, '@')) {
            return 'mailto:'.$r;
        }
        if ($type === 'whatsapp' && preg_match('/^\+?\d[\d\s\-().]+$/', $r)) {
            $digits = preg_replace('/\D+/', '', $r);

            return $digits !== '' ? 'https://wa.me/'.$digits : $r;
        }

        return $r;
    };

    $whatsappHref = $resolveHref($whatsappUrlRaw !== '' ? $whatsappUrlRaw : $whatsappLabel, 'whatsapp');
    $emailHref = $resolveHref($emailRaw !== '' ? $emailRaw : $emailLabel, 'email');
    $whatsappDisplay = $whatsappLabel !== '' ? $whatsappLabel : $whatsappUrlRaw;
    $emailDisplay = $emailLabel !== '' ? $emailLabel : $emailRaw;

    $logoUrl = ($content->cta_banner_logo_filename ?? '') !== ''
        ? \App\Support\CmsPage::imageUrlFromFilename($content->cta_banner_logo_filename)
        : null;
@endphp

<div class="about-us-cta-banner relative overflow-hidden rounded-2xl sm:rounded-3xl bg-[#0b3169] px-6 py-10 sm:px-10 sm:py-12 md:px-14 md:py-14">
    <div class="about-us-cta-banner-logo pointer-events-none absolute left-0 top-1/2 -translate-y-1/2 opacity-30" aria-hidden="true">
        @if ($logoUrl)
            <img src="{{ $logoUrl }}" alt="" class="h-32 w-auto max-w-[45%] object-contain sm:h-40 md:h-48 lg:h-56">
        @else
            <svg class="h-32 w-auto sm:h-40 md:h-48 lg:h-56" fill="none" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 150 L200 50 L350 150 V350 H50 Z" fill="transparent" stroke="white" stroke-width="40"></path>
            </svg>
        @endif
    </div>

    <div class="relative z-10 mx-auto max-w-3xl text-center">
        @if ($heading !== '')
            <p class="font-headline text-lg font-bold leading-snug text-on-primary-container sm:text-xl md:text-2xl whitespace-pre-wrap">
                {{ $heading }}
            </p>
        @endif

        @if ($hasWhatsapp || $hasEmail)
            <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:mt-8 sm:flex-row sm:gap-10 md:gap-14">
                @if ($hasWhatsapp)
                    <a href="{{ $whatsappHref }}" class="inline-flex items-center gap-3 text-on-primary-container transition-opacity hover:opacity-90" @if (str_starts_with($whatsappHref, 'http')) target="_blank" rel="noopener noreferrer" @endif>
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border-2 border-on-primary-container/40 bg-white/10">
                            <span class="material-symbols-outlined text-xl text-on-primary-container">chat</span>
                        </span>
                        <span class="font-headline text-sm font-bold sm:text-base">{{ $whatsappDisplay }}</span>
                    </a>
                @endif
                @if ($hasEmail)
                    <a href="{{ $emailHref }}" class="inline-flex items-center gap-3 text-on-primary-container transition-opacity hover:opacity-90">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border-2 border-on-primary-container/40 bg-white/10">
                            <span class="material-symbols-outlined text-xl text-on-primary-container">mail</span>
                        </span>
                        <span class="font-headline text-sm font-bold break-all sm:text-base">{{ $emailDisplay }}</span>
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
