@php
    $content = $ourWorkContent ?? null;
    if (! $content) {
        return;
    }

    $heading = trim((string) ($content->cta_heading ?? ''));
    $body = trim((string) ($content->cta_body ?? ''));
    $callLabel = trim((string) ($content->cta_call_label ?? '')) ?: 'Call now';
    $quoteLabel = trim((string) ($content->cta_quote_label ?? '')) ?: 'Request quote';
    $ctaIcon = \App\Support\CmsPage::materialIconOrDefault($content->cta_icon ?? null, 'handyman');

    $imageSrc = ($content->cta_image_filename ?? '') !== ''
        ? \App\Support\CmsPage::imageUrlFromFilename($content->cta_image_filename)
        : \App\Support\CmsPage::publicImageOrUrl(null);

    $contactPhone = $homeContent?->contact_phone ?? '469-288-8881';
    $contactPhoneTel = preg_replace('/\D+/', '', $contactPhone) ?: '14692888881';
    if (! str_starts_with($contactPhoneTel, '1') && strlen($contactPhoneTel) === 10) {
        $contactPhoneTel = '1'.$contactPhoneTel;
    }
@endphp

<div class="our-work-cta-banner relative overflow-hidden rounded-2xl bg-[#0b3169] px-6 py-10 sm:rounded-3xl sm:px-10 sm:py-12 md:px-12 md:py-14 lg:px-16">
    <div class="flex flex-col items-center gap-10 lg:flex-row lg:items-center lg:gap-12">
        <div class="w-full space-y-6 lg:w-1/2">
            @include('partials.brand_logo', ['size' => 'lg', 'link' => false, 'class' => 'brightness-0 invert'])
            @if ($heading !== '')
                <h2 class="font-headline text-2xl font-black leading-tight text-on-primary sm:text-3xl md:text-4xl whitespace-pre-wrap">
                    {{ $heading }}
                </h2>
            @endif
            @if ($body !== '')
                <p class="max-w-xl text-base leading-relaxed text-on-primary-container/90 sm:text-lg whitespace-pre-wrap">
                    {{ $body }}
                </p>
            @endif
            <div class="flex flex-col gap-4 sm:flex-row sm:flex-wrap">
                <a href="tel:+{{ $contactPhoneTel }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-secondary-container px-8 py-3 font-headline text-sm font-bold uppercase tracking-wide text-primary-container transition-opacity hover:opacity-90">
                    <span class="material-symbols-outlined text-lg">call</span>
                    {{ $callLabel }}
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-on-primary-container px-8 py-3 font-headline text-sm font-bold uppercase tracking-wide text-on-primary-container transition-colors hover:bg-white/10">
                    {{ $quoteLabel }}
                </a>
            </div>
        </div>

        <div class="relative w-full lg:w-1/2">
            <div class="absolute -top-2 left-4 z-10 sm:left-8 sm:-top-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-full border-4 border-[#0b3169] bg-surface-container-lowest text-primary-container shadow-lg sm:h-16 sm:w-16">
                    <span class="material-symbols-outlined text-3xl sm:text-4xl" aria-hidden="true">{{ $ctaIcon }}</span>
                </div>
            </div>
            <div class="our-work-cta-image-mask overflow-hidden shadow-2xl">
                <img
                    alt=""
                    class="block h-56 w-full object-cover sm:h-72 md:h-80 lg:h-[22rem]"
                    src="{{ $imageSrc }}"
                />
            </div>
        </div>
    </div>
</div>
