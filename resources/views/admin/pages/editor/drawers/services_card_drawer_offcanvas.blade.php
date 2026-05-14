{{-- Panel offcanvas: renderizar fuera de .cms-editor-preview-shell (ver admin/pages/edit.blade.php) para z-index y overflow correctos. --}}
@php
    $drawerId = 'offcanvas-services-card-'.$card->id;
    $cardId = (int) $card->id;
    $iconChoices = \App\Support\MaterialIconOptions::serviceCardIcons();
    $selectedCardIcon = old('services_cards.'.$cardId.'.icon', $card->icon ?? 'garage');
    if (! is_string($selectedCardIcon) || ! array_key_exists($selectedCardIcon, $iconChoices)) {
        $selectedCardIcon = 'garage';
    }
    $selectedTheme = old('services_cards.'.$cardId.'.theme', $card->theme ?? 'light');
    if (! in_array($selectedTheme, ['light', 'accent'], true)) {
        $selectedTheme = 'light';
    }
@endphp
<div class="offcanvas offcanvas-end cms-page-offcanvas services-value-card-drawer d-flex flex-column" tabindex="-1" id="{{ $drawerId }}" aria-labelledby="{{ $drawerId }}-label" data-bs-scroll="true">
    <div class="offcanvas-header border-bottom flex-shrink-0 bg-light">
        <h5 class="offcanvas-title" id="{{ $drawerId }}-label">
            Servicios
            @isset($positionLabel)
                <span class="text-muted fw-normal">· Tarjeta {{ $positionLabel }}</span>
            @endisset
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body flex-grow-1 overflow-auto text-body">
        <div class="mb-2">
            <label class="form-label small" for="services-value-card-{{ $cardId }}-title">Título</label>
            <input type="text" class="form-control form-control-sm" id="services-value-card-{{ $cardId }}-title" form="{{ $formId }}"
                name="services_cards[{{ $cardId }}][title]"
                value="{{ old('services_cards.'.$cardId.'.title', $card->title) }}" maxlength="255">
        </div>
        <div class="mb-2">
            <label class="form-label small" for="services-value-card-{{ $cardId }}-body">Cuerpo</label>
            <textarea class="form-control form-control-sm" id="services-value-card-{{ $cardId }}-body" rows="6" form="{{ $formId }}"
                name="services_cards[{{ $cardId }}][body]">{{ old('services_cards.'.$cardId.'.body', $card->body) }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small d-block" for="services-value-card-{{ $cardId }}-icon">Icono Material</label>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="material-symbols-outlined text-primary border rounded p-2 bg-white" style="font-size: 2rem; line-height: 1;" id="services-value-card-icon-preview-{{ $cardId }}">{{ $selectedCardIcon }}</span>
                <select name="services_cards[{{ $cardId }}][icon]" id="services-value-card-{{ $cardId }}-icon" class="form-select form-select-sm flex-grow-1 js-cms-material-icon-select" style="min-width: 10rem;" form="{{ $formId }}"
                    data-icon-preview="services-value-card-icon-preview-{{ $cardId }}">
                    @foreach ($iconChoices as $val => $lab)
                        <option value="{{ $val }}" @selected($selectedCardIcon === $val)>{{ $lab }}</option>
                    @endforeach
                </select>
            </div>
            <span class="form-text text-muted small">Misma fuente de iconos que el sitio público.</span>
        </div>
        <div class="mb-2">
            <label class="form-label small" for="services-value-card-{{ $cardId }}-image">Imagen de la tarjeta</label>
            @php
                $cardImagePreview = \App\Support\CmsPage::publicImageOrUrl($card->image_path);
            @endphp
            <div class="mb-2 rounded border bg-light p-2 text-center">
                <img src="{{ $cardImagePreview }}" alt="" class="img-fluid rounded" style="max-height: 10rem; object-fit: contain;">
            </div>
            <input type="file" class="form-control form-control-sm cms-offcanvas-file-input" id="services-value-card-{{ $cardId }}-image" form="{{ $formId }}"
                name="services_card_images[{{ $cardId }}]" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="services-remove-card-image-{{ $cardId }}" name="services_card_remove[{{ $cardId }}]"
                    @checked(old('services_card_remove.'.$cardId))>
                <label class="form-check-label small" for="services-remove-card-image-{{ $cardId }}">Quitar imagen (vuelve al predeterminado del sitio; solo se borra del disco el archivo subido por el CMS)</label>
            </div>
            <span class="form-text text-muted small">JPG, PNG, GIF o WebP; máx. 8&nbsp;MB. Se guarda en <code>public/images/services/</code>.</span>
        </div>
        <div class="mb-2">
            <label class="form-label small" for="services-value-card-{{ $cardId }}-theme">Estilo de tarjeta</label>
            <select class="form-select form-select-sm" id="services-value-card-{{ $cardId }}-theme" form="{{ $formId }}" name="services_cards[{{ $cardId }}][theme]">
                <option value="light" @selected($selectedTheme === 'light')>Claro</option>
                <option value="accent" @selected($selectedTheme === 'accent')>Acento (oscuro)</option>
            </select>
            <span class="form-text text-muted small">«Acento» usa el fondo secundario como en la vista previa.</span>
        </div>
    </div>
    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
    </div>
</div>
