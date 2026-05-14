{{-- Panel offcanvas: renderizar fuera de .cms-editor-preview-shell (ver admin/pages/edit.blade.php) para z-index y overflow correctos. --}}
@php
    $drawerId = 'offcanvas-about-value-card-'.$card->id;
    $cardId = (int) $card->id;
    $iconChoices = \App\Support\MaterialIconOptions::aboutValueCardIcons();
    $selectedCardIcon = old('about_cards.'.$cardId.'.icon', $card->icon ?? 'garage');
    if (! is_string($selectedCardIcon) || ! array_key_exists($selectedCardIcon, $iconChoices)) {
        $selectedCardIcon = 'garage';
    }
@endphp
<div class="offcanvas offcanvas-end cms-page-offcanvas about-us-value-card-drawer d-flex flex-column" tabindex="-1" id="{{ $drawerId }}" aria-labelledby="{{ $drawerId }}-label" data-bs-scroll="true">
    <div class="offcanvas-header border-bottom flex-shrink-0 bg-light">
        <h5 class="offcanvas-title" id="{{ $drawerId }}-label">
            Valores
            @isset($positionLabel)
                <span class="text-muted fw-normal">· Tarjeta {{ $positionLabel }}</span>
            @endisset
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body flex-grow-1 overflow-auto text-body">
        <div class="mb-2">
            <label class="form-label small" for="about-value-card-{{ $cardId }}-title">Título</label>
            <input type="text" class="form-control form-control-sm" id="about-value-card-{{ $cardId }}-title" form="{{ $formId }}"
                name="about_cards[{{ $cardId }}][title]"
                value="{{ old('about_cards.'.$cardId.'.title', $card->title) }}" maxlength="255">
        </div>
        <div class="mb-2">
            <label class="form-label small" for="about-value-card-{{ $cardId }}-body">Cuerpo</label>
            <textarea class="form-control form-control-sm" id="about-value-card-{{ $cardId }}-body" rows="6" form="{{ $formId }}"
                name="about_cards[{{ $cardId }}][body]">{{ old('about_cards.'.$cardId.'.body', $card->body) }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small d-block" for="about-value-card-{{ $cardId }}-icon">Icono Material</label>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="material-symbols-outlined text-primary border rounded p-2 bg-white" style="font-size: 2rem; line-height: 1;" id="about-value-card-icon-preview-{{ $cardId }}">{{ $selectedCardIcon }}</span>
                <select name="about_cards[{{ $cardId }}][icon]" id="about-value-card-{{ $cardId }}-icon" class="form-select form-select-sm flex-grow-1 js-cms-material-icon-select" style="min-width: 10rem;" form="{{ $formId }}"
                    data-icon-preview="about-value-card-icon-preview-{{ $cardId }}">
                    @foreach ($iconChoices as $val => $lab)
                        <option value="{{ $val }}" @selected($selectedCardIcon === $val)>{{ $lab }}</option>
                    @endforeach
                </select>
            </div>
            <span class="form-text text-muted small">Misma fuente de iconos que el sitio público.</span>
        </div>
    </div>
    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0">
        <button type="submit" class="btn btn-primary w-100" form="{{ $formId }}">Guardar cambios</button>
    </div>
</div>
