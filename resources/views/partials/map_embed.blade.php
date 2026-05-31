@php
    $embedUrl = trim((string) ($mapEmbedUrl ?? ''));
    if ($embedUrl === '') {
        $embedUrl = 'https://maps.google.com/maps?q=Dallas-Fort%20Worth%2C%20TX&t=&z=9&ie=UTF8&iwloc=&output=embed';
    }
    $wrapperClass = trim((string) ($wrapperClass ?? 'h-full w-full min-h-[280px] sm:min-h-[360px] rounded-2xl sm:rounded-[2.5rem] overflow-hidden shadow-2xl border-4 sm:border-8 border-white/20'));
@endphp
<div class="{{ $wrapperClass }}">
    <iframe allowfullscreen="" height="100%" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        src="{{ $embedUrl }}"
        style="border:0;" width="100%" title="Map">
    </iframe>
</div>
