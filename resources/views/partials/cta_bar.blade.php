@php
    $variant = $variant ?? 'default';
@endphp
@if ($variant === 'reviews')
    <div class="reviews-hard-shadow mx-auto max-w-md rounded-2xl border-2 border-secondary-container bg-primary-container px-4 py-5 text-center sm:max-w-lg sm:rounded-3xl sm:px-6">
        <h3 class="mb-4 font-headline text-sm font-bold text-on-primary sm:mb-5 sm:text-base">Call for service</h3>
        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-6">
            <a href="tel:+14692888881" class="inline-flex items-center gap-2 rounded-full bg-secondary-container px-5 py-2.5 font-headline text-xs font-bold uppercase tracking-wide text-primary-container transition-opacity hover:opacity-90 sm:text-sm">
                <span class="material-symbols-outlined text-base">call</span>
                Call now
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border-2 border-on-primary px-5 py-2.5 font-headline text-xs font-bold uppercase tracking-wide text-on-primary transition-colors hover:bg-white/10 sm:text-sm">
                Request quote
            </a>
        </div>
    </div>
@else
    <div class="mx-auto max-w-2xl rounded-2xl border-2 border-primary-container bg-primary-container px-6 py-6 text-center sm:rounded-3xl sm:px-8 sm:py-8">
        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-8">
            <a href="tel:+14692888881" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-secondary-container px-8 py-3 font-headline text-sm font-bold uppercase tracking-wide text-primary-container transition-opacity hover:opacity-90 sm:w-auto">
                <span class="material-symbols-outlined text-lg">call</span>
                Call now
            </a>
            <a href="{{ route('contact') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full border-2 border-on-primary px-8 py-3 font-headline text-sm font-bold uppercase tracking-wide text-on-primary transition-colors hover:bg-white/10 sm:w-auto">
                Request quote
            </a>
        </div>
    </div>
@endif
