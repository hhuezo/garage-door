{{-- Panel offcanvas: testimonio Home --}}
@php
    $drawerId = 'offcanvas-home-testimonial-'.$testimonial->id;
    $testimonialId = (int) $testimonial->id;
    $iconChoices = \App\Support\MaterialIconOptions::serviceCardIcons();
    $selectedIcon = old('home_testimonials.'.$testimonialId.'.icon', $testimonial->icon ?? 'person_search');
    if (! is_string($selectedIcon) || ! array_key_exists($selectedIcon, $iconChoices)) {
        $selectedIcon = 'person_search';
    }
@endphp
<div class="offcanvas offcanvas-end cms-page-offcanvas home-testimonial-drawer d-flex flex-column" tabindex="-1" id="{{ $drawerId }}" aria-labelledby="{{ $drawerId }}-label" data-bs-scroll="true">
    <div class="offcanvas-header border-bottom flex-shrink-0 bg-light">
        <h5 class="offcanvas-title" id="{{ $drawerId }}-label">
            Home — Testimonio
            @isset($positionLabel)
                <span class="text-muted fw-normal">· {{ $positionLabel }}</span>
            @endisset
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body flex-grow-1 overflow-auto text-body">
        <div class="mb-2">
            <label class="form-label small" for="home-testimonial-{{ $testimonialId }}-quote">Cita</label>
            <textarea class="form-control form-control-sm" id="home-testimonial-{{ $testimonialId }}-quote" rows="6" form="{{ $formId }}"
                name="home_testimonials[{{ $testimonialId }}][quote]">{{ old('home_testimonials.'.$testimonialId.'.quote', $testimonial->quote) }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small d-block" for="home-testimonial-{{ $testimonialId }}-icon">Icono (avatar)</label>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="material-symbols-outlined text-primary border rounded p-2 bg-white" style="font-size: 2rem; line-height: 1;" id="home-testimonial-icon-preview-{{ $testimonialId }}">{{ $selectedIcon }}</span>
                <select name="home_testimonials[{{ $testimonialId }}][icon]" id="home-testimonial-{{ $testimonialId }}-icon" class="form-select form-select-sm flex-grow-1 js-cms-material-icon-select" style="min-width: 10rem;" form="{{ $formId }}"
                    data-icon-preview="home-testimonial-icon-preview-{{ $testimonialId }}">
                    @foreach ($iconChoices as $val => $lab)
                        <option value="{{ $val }}" @selected($selectedIcon === $val)>{{ $lab }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
    </div>
</div>
