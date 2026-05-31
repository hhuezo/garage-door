@php
    $content = $homeContent ?? null;
    $mapEmbedUrl = $content?->map_embed_url ?: 'https://maps.google.com/maps?q=Dallas-Fort%20Worth%2C%20TX&t=&z=9&ie=UTF8&iwloc=&output=embed';
    $bgSrc = $content?->hero_bg_image_filename
        ? \App\Support\CmsPage::imageUrlFromFilename($content->hero_bg_image_filename)
        : asset('images/lifting-gates-garage.jpg');
    $mapHeading = trim((string) ($content?->contact_heading ?? ''));
    if ($mapHeading === '') {
        $mapHeading = 'Contact Us';
    }
@endphp

<section class="services-map-section relative overflow-hidden bg-primary-container px-4 py-12 sm:px-6 sm:py-16 md:py-20">
    <div class="absolute inset-0 z-0">
        <img alt="" class="h-full w-full object-cover opacity-25" src="{{ $bgSrc }}" />
        <div class="absolute inset-0 bg-primary-container/80"></div>
    </div>

    <div class="relative z-10 mx-auto w-full max-w-screen-2xl">
        <div class="mb-6 flex items-center gap-3 sm:mb-8">
            <div class="flex h-10 w-12 items-center justify-center rounded-md bg-white/10 sm:h-12">
                <span class="material-symbols-outlined text-2xl font-black text-on-primary sm:text-3xl">garage</span>
            </div>
            <div class="flex flex-col leading-none">
                <span class="font-headline text-lg font-black uppercase text-on-primary sm:text-xl">Twins Garage</span>
                <span class="font-headline text-lg font-black uppercase text-on-primary sm:text-xl">Doors LLC</span>
            </div>
        </div>

        <h2 class="mb-8 font-headline text-2xl font-black text-on-primary-container sm:mb-10 sm:text-3xl md:text-4xl">
            {{ $mapHeading }}
        </h2>

        <div class="mx-auto max-w-4xl">
            @include('partials.map_embed', [
                'mapEmbedUrl' => $mapEmbedUrl,
                'wrapperClass' => 'w-full min-h-[280px] sm:min-h-[340px] md:min-h-[400px] rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20',
            ])
        </div>
    </div>
</section>
