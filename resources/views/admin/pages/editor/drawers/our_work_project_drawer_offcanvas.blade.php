{{-- Panel offcanvas: proyecto Our Work --}}
@php
    $drawerId = 'offcanvas-our-work-project-'.$project->id;
    $projectId = (int) $project->id;
    $iconChoices = \App\Support\MaterialIconOptions::serviceCardIcons();
    $selectedIcon = old('our_work_projects.'.$projectId.'.icon', $project->icon ?? 'home');
    if (! is_string($selectedIcon) || ! array_key_exists($selectedIcon, $iconChoices)) {
        $selectedIcon = 'home';
    }
@endphp
<div class="offcanvas offcanvas-end cms-page-offcanvas our-work-project-drawer d-flex flex-column" tabindex="-1" id="{{ $drawerId }}" aria-labelledby="{{ $drawerId }}-label" data-bs-scroll="true">
    <div class="offcanvas-header border-bottom flex-shrink-0 bg-light">
        <h5 class="offcanvas-title" id="{{ $drawerId }}-label">
            Our Work
            @isset($positionLabel)
                <span class="text-muted fw-normal">· Proyecto {{ $positionLabel }}</span>
            @endisset
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body flex-grow-1 overflow-auto text-body">
        <div class="mb-2">
            <label class="form-label small" for="our-work-project-{{ $projectId }}-title">Título</label>
            <input type="text" class="form-control form-control-sm" id="our-work-project-{{ $projectId }}-title" form="{{ $formId }}"
                name="our_work_projects[{{ $projectId }}][title]"
                value="{{ old('our_work_projects.'.$projectId.'.title', $project->title) }}" maxlength="255">
        </div>
        <div class="mb-2">
            <label class="form-label small" for="our-work-project-{{ $projectId }}-body">Descripción</label>
            <textarea class="form-control form-control-sm" id="our-work-project-{{ $projectId }}-body" rows="6" form="{{ $formId }}"
                name="our_work_projects[{{ $projectId }}][body]">{{ old('our_work_projects.'.$projectId.'.body', $project->body) }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small d-block" for="our-work-project-{{ $projectId }}-icon">Icono (esquina de la foto)</label>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="material-symbols-outlined text-primary border rounded p-2 bg-white" style="font-size: 2rem; line-height: 1;" id="our-work-project-icon-preview-{{ $projectId }}">{{ $selectedIcon }}</span>
                <select name="our_work_projects[{{ $projectId }}][icon]" id="our-work-project-{{ $projectId }}-icon" class="form-select form-select-sm flex-grow-1 js-cms-material-icon-select" style="min-width: 10rem;" form="{{ $formId }}"
                    data-icon-preview="our-work-project-icon-preview-{{ $projectId }}">
                    @foreach ($iconChoices as $val => $lab)
                        <option value="{{ $val }}" @selected($selectedIcon === $val)>{{ $lab }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-2">
            <label class="form-label small" for="our-work-project-{{ $projectId }}-image">Imagen del proyecto</label>
            @php
                $projectImagePreview = \App\Support\CmsPage::publicImageOrUrl($project->image_path);
            @endphp
            <div class="mb-2 rounded border bg-light p-2 text-center">
                <img src="{{ $projectImagePreview }}" alt="" class="img-fluid rounded" style="max-height: 10rem; object-fit: contain;">
            </div>
            <input type="file" class="form-control form-control-sm cms-offcanvas-file-input" id="our-work-project-{{ $projectId }}-image" form="{{ $formId }}"
                name="our_work_project_images[{{ $projectId }}]" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="1" form="{{ $formId }}" id="our-work-remove-project-image-{{ $projectId }}" name="our_work_project_remove[{{ $projectId }}]"
                    @checked(old('our_work_project_remove.'.$projectId))>
                <label class="form-check-label small" for="our-work-remove-project-image-{{ $projectId }}">Quitar imagen (vuelve al predeterminado)</label>
            </div>
            <span class="form-text text-muted small">JPG, PNG, GIF o WebP; máx. 8&nbsp;MB. <code>public/images/our_work/</code></span>
        </div>
        <div class="mb-2">
            <label class="form-label small" for="our-work-project-{{ $projectId }}-link-label">Texto del enlace</label>
            <input type="text" class="form-control form-control-sm" id="our-work-project-{{ $projectId }}-link-label" form="{{ $formId }}"
                name="our_work_projects[{{ $projectId }}][link_label]"
                value="{{ old('our_work_projects.'.$projectId.'.link_label', $project->link_label) }}" maxlength="255" placeholder="Leer más">
        </div>
        <div class="mb-2">
            <label class="form-label small" for="our-work-project-{{ $projectId }}-link-url">URL del enlace</label>
            <input type="text" class="form-control form-control-sm" id="our-work-project-{{ $projectId }}-link-url" form="{{ $formId }}"
                name="our_work_projects[{{ $projectId }}][link_url]"
                value="{{ old('our_work_projects.'.$projectId.'.link_url', $project->link_url) }}" maxlength="512" placeholder="/#contacto">
        </div>
    </div>
    <div class="offcanvas-footer border-top bg-light p-3 flex-shrink-0 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" form="{{ $formId }}">Guardar cambios</button>
    </div>
</div>
