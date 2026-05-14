@extends('menu_main')

@section('page_title', ($page->meta_title ?? 'Servicios').' — Twins Garage Doors')

@push('styles')
<style data-purpose="services-page">
    .services-diagonal-cut {
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 40px), calc(100% - 40px) 100%, 0 100%);
    }
    .services-image-mask {
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 60px), calc(100% - 60px) 100%, 0 100%);
    }
</style>
@endpush

@section('content')
<div class="bg-surface">
    <div class="mx-auto w-full max-w-screen-2xl px-6 py-12 sm:px-8 md:py-16 lg:px-12 xl:px-14">
        <main class="font-body text-on-surface">
            @php
                $cabeceraImg = $servicesContent->hero_image_filename
                    ? \App\Support\CmsPage::imageUrlFromFilename($servicesContent->hero_image_filename)
                    : \App\Support\CmsPage::publicImageOrUrl(null);
            @endphp
            <section class="relative mb-12 overflow-hidden bg-primary-container p-8 md:p-12 lg:mb-16">
                <div class="flex flex-col items-center gap-10 lg:flex-row lg:gap-12">
                    <div class="w-full lg:w-1/2">
                        <img
                            class="services-image-mask h-[320px] w-full object-cover md:h-[400px]"
                            alt=""
                            src="{{ $cabeceraImg }}"
                        />
                    </div>
                    <div class="w-full space-y-6 lg:w-1/2">
                        <h1 class="font-headline text-4xl font-black text-on-primary md:text-5xl">{{ $servicesContent->hero_title ?: 'Servicios' }}</h1>
                        <p class="text-lg leading-relaxed text-on-primary-container md:text-xl whitespace-pre-wrap">{{ $servicesContent->hero_lead }}</p>
                    </div>
                </div>
            </section>

            @if ($servicesContent->cards->isNotEmpty())
                <section class="grid grid-cols-1 gap-10 md:grid-cols-2 md:gap-12 lg:grid-cols-3">
                    @foreach ($servicesContent->cards as $card)
                        @php
                            $isAccent = ($card->theme ?? 'light') === 'accent';
                            $iconName = \App\Support\CmsPage::materialIconFromStored($card->icon, $loop->index);
                            $imgSrc = \App\Support\CmsPage::publicImageOrUrl($card->image_path);
                        @endphp
                        <div class="services-diagonal-cut group relative flex flex-col overflow-hidden transition-transform duration-300 hover:-translate-y-2 {{ $isAccent ? 'bg-secondary text-on-secondary' : 'bg-surface-container-lowest' }}">
                            <div class="relative">
                                <img class="h-56 w-full object-cover" alt="{{ $card->title }}" src="{{ $imgSrc }}"/>
                                <div class="absolute -bottom-6 right-6 flex h-12 w-12 items-center justify-center rounded-full border-4 {{ $isAccent ? 'border-secondary bg-primary-container' : 'border-surface-container-lowest bg-secondary-container' }}">
                                    <span class="material-symbols-outlined {{ $isAccent ? 'text-on-primary' : 'text-primary' }}">{{ $iconName }}</span>
                                </div>
                            </div>
                            <div class="space-y-4 p-8">
                                <h3 class="font-headline text-xl font-bold {{ $isAccent ? 'text-on-primary' : 'text-primary' }} md:text-2xl">{{ $card->title }}</h3>
                                <p class="text-base leading-relaxed {{ $isAccent ? 'text-secondary-fixed' : 'text-on-surface-variant' }}">{{ $card->body }}</p>
                                <div class="flex items-end justify-between pt-4">
                                    <a href="{{ url('/#contacto') }}" class="flex items-center gap-2 font-headline text-sm font-bold uppercase tracking-wide transition-all hover:gap-4 {{ $isAccent ? 'text-on-primary' : 'text-secondary' }}">
                                        Leer más
                                        <span class="material-symbols-outlined text-sm">double_arrow</span>
                                    </a>
                                    <span class="font-headline text-[10px] font-black uppercase opacity-20 {{ $isAccent ? 'text-on-primary' : 'text-primary' }}">TGD</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>
            @endif

            <div class="mt-16 flex flex-wrap items-center justify-center gap-8 md:mt-24 lg:justify-start">
                <a href="{{ url('/#contacto') }}" class="rounded-full border-2 border-primary bg-surface-container-lowest px-8 py-3 font-headline text-sm font-bold uppercase tracking-wide text-primary transition-colors hover:bg-secondary-container">
                    Contáctanos
                </a>
                <a href="tel:+14692888881" class="font-headline text-2xl font-bold text-primary md:text-3xl">469-288-8881</a>
            </div>
        </main>
    </div>
</div>
@endsection
