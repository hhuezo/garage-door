@php
    $size = $size ?? 'md';
    $link = $link ?? true;
    $class = trim((string) ($class ?? ''));

    $heightClass = match ($size) {
        'sm' => 'h-8 sm:h-10',
        'lg' => 'h-12 sm:h-14',
        default => 'h-10 sm:h-12',
    };
@endphp

@if ($link)
    <a href="{{ url('/') }}" @class(['inline-flex shrink-0 items-center', $class])>
        <img
            src="{{ asset('assets/images/logo.png') }}"
            alt="Twins Garage Doors LLC"
            class="{{ $heightClass }} w-auto object-contain"
            width="180"
            height="48"
        />
    </a>
@else
    <div @class(['inline-flex shrink-0 items-center', $class])>
        <img
            src="{{ asset('assets/images/logo.png') }}"
            alt="Twins Garage Doors LLC"
            class="{{ $heightClass }} w-auto object-contain"
            width="180"
            height="48"
        />
    </div>
@endif
