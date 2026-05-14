@extends('menu')

@section('page_title', 'Contenido: '.$page->name.' — Admin')

@php
    $isAbout = $page->slug === 'about-us';
    $isServices = $page->slug === 'services';
@endphp

@push('styles')
    <link href="{{ asset('assets/libs/toast/toastr.min.css') }}" rel="stylesheet">
    @include('layouts.partials.cms_site_visual_assets', ['tailwindImportant' => '.cms-editor-preview-shell'])
    @if ($isAbout || $isServices)
        <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
    @endif
    <style>
        .cms-editor-preview-shell {
            background: #f8f9fa;
            border-radius: 0.375rem;
            overflow: auto;
            padding-bottom: 1rem;
        }
        body .offcanvas.cms-page-offcanvas.offcanvas-end,
        body .offcanvas.cms-page-offcanvas.offcanvas-start {
            --bs-offcanvas-width: 50vw;
        }
        body .offcanvas.cms-page-offcanvas {
            z-index: 10050 !important;
        }
        body .offcanvas-backdrop {
            z-index: 10045 !important;
        }
        body .offcanvas.cms-page-offcanvas .form-control,
        body .offcanvas.cms-page-offcanvas textarea {
            pointer-events: auto;
        }
        body .offcanvas.cms-page-offcanvas input[type="file"] {
            pointer-events: auto;
        }
        body .offcanvas.cms-page-offcanvas input[type="file"].cms-offcanvas-file-input,
        body .offcanvas.cms-page-offcanvas .cms-offcanvas-file-input {
            border: 2px dashed #0d6efd;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            min-height: 3.25rem;
            background-color: rgba(13, 110, 253, 0.08);
            cursor: pointer;
        }
        body .offcanvas.cms-page-offcanvas input[type="file"].cms-offcanvas-file-input:hover,
        body .offcanvas.cms-page-offcanvas .cms-offcanvas-file-input:hover {
            background-color: rgba(13, 110, 253, 0.14);
            border-color: #0a58ca;
        }
        body .offcanvas.cms-page-offcanvas input[type="file"].cms-offcanvas-file-input:focus,
        body .offcanvas.cms-page-offcanvas .cms-offcanvas-file-input:focus {
            border-style: solid;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            background-color: #fff;
            outline: 0;
        }
        body .offcanvas.cms-page-offcanvas input[type="file"].cms-offcanvas-file-input::file-selector-button {
            margin-right: 1rem;
            padding: 0.45rem 1rem;
            border: 0;
            border-radius: 0.25rem;
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }
        body .offcanvas.cms-page-offcanvas input[type="file"].cms-offcanvas-file-input:hover::file-selector-button {
            background-color: #0b5ed7;
        }
        body .offcanvas.cms-page-offcanvas .form-group {
            margin-bottom: 1rem;
        }
        @if ($isAbout || $isServices)
        .select2-container--open,
        .select2-dropdown {
            z-index: 10060 !important;
        }
        @endif
    </style>
@endpush

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">{{ $page->name }}</h1>
        </div>
        <div class="btn-list">
            <a href="{{ route('pages.index') }}" class="btn btn-white btn-wave waves-effect waves-light">
                <i class="ri-list-check align-middle me-1 lh-1"></i> Listado
            </a>
            <a href="{{ url($page->previewPath()) }}" target="_blank" rel="noopener" class="btn btn-primary btn-wave me-0 waves-effect waves-light">
                <i class="ri-external-link-line me-1"></i> Sitio público
            </a>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof toastr !== 'undefined') {
                    toastr.success(@json(session('success')));
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof toastr !== 'undefined') {
                    toastr.error(@json(session('error')));
                }
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($isAbout && ! $page->aboutUsContent)
        <div class="alert alert-warning">No hay registro en <code>about_us_contents</code> para About Us. Ejecuta migraciones y seed o crea el contenido en la base de datos.</div>
    @endif

    @if ($isServices && ! $page->servicesContent)
        <div class="alert alert-warning">No hay registro en <code>services_contents</code> para Servicios. Ejecuta migraciones y <code>php artisan db:seed --class=SiteContentSeeder</code>.</div>
    @endif

    @if ($isAbout)
        <form method="post" action="{{ route('pages.about-us.update', $page) }}" id="form-about-us" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        </form>
    @elseif ($isServices)
        <form method="post" action="{{ route('pages.services.update', $page) }}" id="form-services" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        </form>
    @endif

    <div class="cms-editor-preview-shell p-2 p-md-3 mb-5" style="min-height: 70vh;">
        @if ($isAbout)
            @include('admin.pages.editor.about_us_edit', [
                'page' => $page,
            ])
        @elseif ($isServices)
            @include('admin.pages.editor.services_edit', [
                'page' => $page,
            ])
        @endif
    </div>

    @if ($isAbout && $page->aboutUsContent && $page->aboutUsContent->cards->isNotEmpty())
        @foreach ($page->aboutUsContent->cards as $card)
            @include('admin.pages.editor.drawers.about_us_value_card_drawer_offcanvas', [
                'card' => $card,
                'formId' => 'form-about-us',
                'positionLabel' => $loop->iteration,
            ])
        @endforeach
    @endif

    @if ($isServices && $page->servicesContent && $page->servicesContent->cards->isNotEmpty())
        @foreach ($page->servicesContent->cards as $card)
            @include('admin.pages.editor.drawers.services_card_drawer_offcanvas', [
                'card' => $card,
                'formId' => 'form-services',
                'positionLabel' => $loop->iteration,
            ])
        @endforeach
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toast/toastr.min.js') }}"></script>
    @if ($isAbout || $isServices)
        <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof expandMenuAndHighlightOption === 'function') {
                expandMenuAndHighlightOption('sitioWebMenu', 'adminPaginasListado');
            }
            @if ($isAbout || $isServices)
            (function() {
                if (typeof jQuery === 'undefined' || !jQuery.fn.select2) {
                    return;
                }
                function initMaterialIconSelect2(root) {
                    var $root = jQuery(root);
                    $root.find('select.js-cms-material-icon-select').each(function() {
                        var $s = jQuery(this);
                        if ($s.hasClass('select2-hidden-accessible')) {
                            try {
                                $s.select2('destroy');
                            } catch (e) {}
                        }
                        var dropdownParent = jQuery(document.body);
                        $s.select2({
                            width: '100%',
                            dropdownParent: dropdownParent,
                            minimumResultsForSearch: 0,
                        });
                        var previewId = $s.attr('data-icon-preview');
                        if (previewId) {
                            $s.off('change.cmsMatIcon').on('change.cmsMatIcon', function() {
                                var el = document.getElementById(previewId);
                                if (el) {
                                    el.textContent = String(jQuery(this).val() || '');
                                }
                            });
                        }
                    });
                }
                document.addEventListener('shown.bs.offcanvas', function(ev) {
                    var root = ev.target;
                    if (!(root instanceof HTMLElement) || !root.classList.contains('offcanvas')) {
                        return;
                    }
                    if (!root.querySelector('select.js-cms-material-icon-select')) {
                        return;
                    }
                    initMaterialIconSelect2(root);
                });
                document.querySelectorAll('.offcanvas.show').forEach(function(el) {
                    if (el.querySelector('select.js-cms-material-icon-select')) {
                        initMaterialIconSelect2(el);
                    }
                });
            })();
            @endif
        });
    </script>
@endpush
