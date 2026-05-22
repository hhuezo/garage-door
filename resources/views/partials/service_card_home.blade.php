@php
    $iconName = \App\Support\CmsPage::materialIconFromStored($card->icon, $iconIndex ?? 0);
    $imgSrc = \App\Support\CmsPage::publicImageOrUrl($card->image_path);
@endphp
<div class="bg-white rounded-[2rem] overflow-hidden flex flex-col h-full shadow-2xl relative">
    <div class="relative h-64 overflow-hidden">
        <img alt="{{ $card->title }}" class="w-full h-full object-cover" src="{{ $imgSrc }}" />
        <div class="absolute bottom-0 right-0 w-20 h-20 bg-[#aec7f7] rounded-tl-[2rem] flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-4xl">{{ $iconName }}</span>
        </div>
    </div>
    <div class="p-6 sm:p-8 flex flex-col flex-grow">
        <h3 class="text-primary font-headline font-bold text-lg sm:text-xl mb-6 leading-tight">
            {{ $card->title }}
        </h3>
        <div class="flex justify-between items-center mt-auto">
            <a class="bg-primary text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-opacity-90 transition-all uppercase"
                href="{{ route('services') }}">
                Read more
                <span class="material-symbols-outlined text-sm">double_arrow</span>
            </a>
            <div class="flex flex-col items-end opacity-70">
                <span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Twins</span>
                <span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Garage</span>
                <span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Doors</span>
            </div>
        </div>
    </div>
</div>
