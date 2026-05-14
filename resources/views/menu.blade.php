<!DOCTYPE html>
<html lang="es" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page_title', 'Twins Garage Doors — Admin')</title>
    <meta name="Description" content="Panel de administración del sitio Twins Garage Doors">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo2.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo2.png') }}">

    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    <style>
        .has-sub.is-expanded .slide-menu { display: block; }
        .side-menu__item.active {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .switch { position: relative; display: inline-block; width: 40px; height: 20px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ccc; transition: .4s;
        }
        .slider:before {
            position: absolute; content: ""; height: 16px; width: 16px; left: 2px; bottom: 2px;
            background-color: white; transition: .4s;
        }
        input:checked + .slider { background-color: #0056B3; }
        input:checked + .slider:before { transform: translateX(20px); }
        .slider.round { border-radius: 20px; }
        .slider.round:before { border-radius: 50%; }
        .card-header { border-bottom: 1px solid #f1f1f1 !important; }
        .table-responsive::-webkit-scrollbar,
        .dataTables_wrapper .dataTables_scrollBody::-webkit-scrollbar { height: 14px; }
        .table-responsive::-webkit-scrollbar-track,
        .dataTables_wrapper .dataTables_scrollBody::-webkit-scrollbar-track {
            background: #e9ecef; border-radius: 6px;
        }
        .table-responsive::-webkit-scrollbar-thumb,
        .dataTables_wrapper .dataTables_scrollBody::-webkit-scrollbar-thumb {
            background: #0056B3; border-radius: 6px; border: 2px solid #e9ecef;
        }
        .table-responsive, .dataTables_wrapper .dataTables_scrollBody {
            scrollbar-color: #0056B3 #e9ecef;
            scrollbar-width: auto;
        }
        .main-sidebar-header {
            display: flex; justify-content: center; align-items: center;
            height: 80px; text-align: center;
        }
        .main-sidebar-header img { max-width: 100px; height: auto; }
    </style>
    @stack('styles')
</head>
<body>
    <div id="loader">
        <img src="{{ asset('assets/images/media/loader.svg') }}" alt="">
    </div>

    <div class="page">
        <header class="app-header sticky" id="header">
            <div class="main-header-container container-fluid">
                <div class="header-content-left">
                    <div class="header-element"></div>
                    <div class="header-element mx-lg-0 mx-2">
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);" onclick="toggleSidebar();">
                            <span></span>
                        </a>
                    </div>
                </div>
                <ul class="header-content-right">
                    <li class="header-element d-md-none d-block">
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                            data-bs-target="#header-responsive-search">
                            <i class="bi bi-search header-link-icon"></i>
                        </a>
                    </li>
                    @auth
                    <li class="header-element dropdown">
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ asset('assets/images/logo.png') }}" alt=""
                                        class="avatar avatar-sm rounded-circle bg-light p-1">
                                </div>
                                <div class="ms-2 text-start">
                                    <p class="mb-0 fw-bold">{{ Auth::user()->name }}</p>
                                    <p class="mb-0 small text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </a>
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"
                                    data-bs-toggle="modal" data-bs-target="#modal-change-password">
                                    <i class="fe fe-key p-1 rounded-circle bg-primary-transparent me-2 fs-16"></i>
                                    Cambiar contraseña
                                </a>
                            </li>
                            <li class="border-top">
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fe fe-lock p-1 rounded-circle bg-primary-transparent me-2 fs-16"></i>
                                    Cerrar sesión
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </header>

        <aside class="app-sidebar sticky" id="sidebar">
            <div class="main-sidebar-header" id="sidebarHeader">
                <a href="{{ url('/') }}" target="_blank" rel="noopener" class="d-flex flex-column align-items-center text-decoration-none">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Twins Garage Doors" class="desktop-logo mb-1" width="90" height="90">

                </a>
            </div>
            <div class="main-sidebar" id="sidebar-scroll">
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    <ul class="main-menu">
                        <li class="slide has-sub" id="sitioWebMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .857-.11 1.688-.314 2.473M6.157 6.157A8.959 8.959 0 003 12c0 .857.11 1.688.314 2.473" />
                                </svg>
                                <span class="side-menu__label">Contenido del sitio</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0);">Páginas y bloques</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('pages.index') }}" id="adminPaginasListado" class="side-menu__item">Listado de páginas</a>
                                    <a href="javascript:void(0);" id="adminPaginasSecciones" class="side-menu__item">Secciones</a>
                                    <a href="javascript:void(0);" id="adminPaginasItems" class="side-menu__item">Tarjetas e ítems</a>
                                    <a href="javascript:void(0);" id="adminPaginasMedios" class="side-menu__item">Archivos multimedia</a>
                                    <a href="javascript:void(0);" id="adminPaginasSnippets" class="side-menu__item">Textos (snippets)</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="side-menu__item">
                                <i class="ri-external-link-line side-menu__icon align-middle"></i>
                                <span class="side-menu__label">Ver sitio público</span>
                            </a>
                        </li>
                    </ul>
                    <div class="slide-right" id="slide-right">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg>
                    </div>
                </nav>
            </div>
        </aside>

        <div class="main-content app-content">
            <div class="container-fluid">
                <div class="page-header-breadcrumb flex-wrap gap-2"></div>
                @yield('content')
            </div>
        </div>

        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted small">Twins Garage Doors — Panel de administración</span>
            </div>
        </footer>

        <div class="modal fade" id="header-responsive-search" tabindex="-1"
            aria-labelledby="header-responsive-search" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Buscar…"
                                aria-label="Buscar" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none"></ul>

    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <div class="modal fade" id="modal-change-password" tabindex="-1" aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalChangePasswordLabel">Cambiar contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-change-password" method="POST" action="{{ route('profile.change-password') }}">
                    @csrf
                    <div class="modal-body">
                        @if (session('password-success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('password-success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('password-error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('password-error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña actual <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password" required autocomplete="current-password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva contraseña <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                id="new_password" name="new_password" required autocomplete="new-password" minlength="8">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Mínimo 8 caracteres.</small>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                id="new_password_confirmation" name="new_password_confirmation" required autocomplete="new-password">
                            @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btn-change-password" class="btn btn-primary">
                            <span class="btn-text">Guardar</span>
                            <span class="btn-loading d-none">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Guardando…
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/sticky.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        let sidebarExpanded = true;
        function toggleSidebar() {
            sidebarExpanded = !sidebarExpanded;
            updateSidebarUI();
            resetMenuSelection();
        }
        function updateSidebarUI() {
            const sidebarHeader = document.getElementById('sidebarHeader');
            if (!sidebarHeader) return;
            sidebarHeader.style.display = sidebarExpanded ? 'flex' : 'none';
        }
        function resetMenuSelection() {
            document.querySelectorAll('.is-expanded').forEach(el => el.classList.remove('is-expanded'));
            document.querySelectorAll('.side-menu__item.active').forEach(el => el.classList.remove('active'));
        }
        function expandMenuAndHighlightOption(menuId, optionId) {
            resetMenuSelection();
            const menuElement = document.getElementById(menuId);
            const optionElement = document.getElementById(optionId);
            if (menuElement) menuElement.classList.add('is-expanded');
            if (optionElement) optionElement.classList.add('active');
        }
        @auth
        setInterval(() => {
            fetch("{{ route('home') }}", { credentials: 'same-origin' })
                .then(response => {
                    if (response.redirected && response.url.includes('/login')) {
                        alert('Tu sesión ha expirado');
                        window.location.href = "{{ route('login') }}";
                    }
                })
                .catch(() => {});
        }, 60000);
        @endauth
    </script>
    <script>
        const formPwd = document.getElementById('form-change-password');
        if (formPwd) {
            formPwd.addEventListener('submit', function () {
                const btn = document.getElementById('btn-change-password');
                if (!btn) return;
                const btnText = btn.querySelector('.btn-text');
                const btnLoading = btn.querySelector('.btn-loading');
                btn.disabled = true;
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
            });
        }
        const modalPwd = document.getElementById('modal-change-password');
        if (modalPwd) {
            modalPwd.addEventListener('hidden.bs.modal', function () {
                const f = document.getElementById('form-change-password');
                if (f) f.reset();
                const btn = document.getElementById('btn-change-password');
                if (btn) {
                    btn.disabled = false;
                    const btnText = btn.querySelector('.btn-text');
                    const btnLoading = btn.querySelector('.btn-loading');
                    if (btnText) btnText.classList.remove('d-none');
                    if (btnLoading) btnLoading.classList.add('d-none');
                }
                this.querySelectorAll('.alert').forEach(alert => alert.remove());
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
