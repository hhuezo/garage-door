{{-- Panel offcanvas: stat Home --}}
@php
    $drawerId = 'offcanvas-home-stat-'.$stat->id;
    $statId = (int) $stat->id;
@endphp
<div class="offcanvas offcanvas-end cms-page-offcanvas home-stat-drawer d-flex flex-column" tabindex="-1" id="{{ $drawerId }}" aria-labelledby="{{ $drawerId }}-label" data-bs-scroll="true">
    <div class="offcanvas-header border-bottom flex-shrink-0 bg-light">
        <h5 class="offcanvas-title" id="{{ $drawerId }}-label">
            Home — Stat
            @isset($positionLabel)
                <span class="text-muted fw-normal">· {{ $positionLabel }}</span>
            @endisset
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body flex-grow-1 overflow-auto text-body">
        <div class="mb-2">
            <label class="form-label small" for="home-stat-{{ $statId }}-value">Cifra</label>
            <input type="text" class="form-control form-control-sm" id="home-stat-{{ $statId }}-value" form="{{ $formId }}"
                name="home_stats[{{ $statId }}][stat_value]"
                value="{{ old('home_stats.'.$statId.'.stat_value', $stat->stat_value) }}" maxlength="64" placeholder="10+">
        </div>
        <div class="mb-2">
            <label class="form-label small" for="home-stat-{{ $statId }}-caption">Texto descriptivo</label>
            <input type="text" class="form-control form-control-sm" id="home-stat-{{ $statId }}-caption" form="{{ $formId }}"
                name="home_stats[{{ $statId }}][stat_caption]"
                value="{{ old('home_stats.'.$statId.'.stat_caption', $stat->stat_caption) }}" maxlength="255" placeholder="Years of experience">
        </div>
    </div>
    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
    </div>
</div>
