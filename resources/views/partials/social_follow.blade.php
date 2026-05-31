@php
    $variant = $variant ?? 'default';
@endphp
@if ($variant === 'compact')
    <div class="flex items-center gap-6">
        <span class="text-primary font-bold text-sm uppercase tracking-widest">Follow us</span>
        <div class="flex gap-4">
            @include('partials.social_follow_links')
        </div>
    </div>
@elseif ($variant === 'contact')
    <div>
        <h3 class="mb-3 font-headline text-[10px] font-bold uppercase tracking-widest text-primary">Follow us</h3>
        <div class="flex gap-3">
            @include('partials.social_follow_links', ['linkClass' => 'flex h-10 w-10 items-center justify-center bg-primary text-on-primary transition-colors hover:bg-secondary'])
        </div>
    </div>
@else
    <div class="text-center">
        <h3 class="mb-4 font-headline text-sm font-bold uppercase tracking-widest text-primary">Follow us</h3>
        <div class="flex justify-center gap-3">
            @include('partials.social_follow_links', ['linkClass' => 'flex h-10 w-10 items-center justify-center rounded-full bg-primary text-on-primary transition-colors hover:bg-secondary hover:scale-110'])
        </div>
    </div>
@endif
