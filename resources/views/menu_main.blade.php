<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@yield('page_title', 'Twins Garage Doors')</title>
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo2.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/images/logo2.png') }}">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;700;800&amp;family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#d0e1fb",
                    "surface-bright": "#f7f9fb",
                    "secondary": "#505f76",
                    "on-primary-fixed-variant": "#2e476f",
                    "on-surface-variant": "#44474e",
                    "on-background": "#191c1e",
                    "on-tertiary-container": "#969eb7",
                    "inverse-surface": "#2d3133",
                    "inverse-on-surface": "#eff1f3",
                    "secondary-fixed": "#d3e4fe",
                    "on-error": "#ffffff",
                    "on-tertiary-fixed-variant": "#3f465c",
                    "surface-container-low": "#f2f4f6",
                    "error-container": "#ffdad6",
                    "primary": "#002046",
                    "tertiary-fixed": "#dae2fd",
                    "inverse-primary": "#aec7f7",
                    "on-surface": "#191c1e",
                    "surface-container-high": "#e6e8ea",
                    "on-secondary-fixed-variant": "#38485d",
                    "error": "#ba1a1a",
                    "tertiary-fixed-dim": "#bec6e0",
                    "primary-fixed-dim": "#aec7f7",
                    "surface-container-highest": "#e0e3e5",
                    "surface-dim": "#d8dadc",
                    "secondary-fixed-dim": "#b7c8e1",
                    "surface-container-lowest": "#ffffff",
                    "surface-container": "#eceef0",
                    "surface": "#f7f9fb",
                    "on-primary": "#ffffff",
                    "tertiary": "#182033",
                    "on-error-container": "#93000a",
                    "on-tertiary": "#ffffff",
                    "primary-fixed": "#d6e3ff",
                    "on-secondary-container": "#54647a",
                    "on-primary-container": "#87a0cd",
                    "on-secondary-fixed": "#0b1c30",
                    "surface-variant": "#e0e3e5",
                    "background": "#f7f9fb",
                    "on-primary-fixed": "#001b3d",
                    "primary-container": "#1b365d",
                    "tertiary-container": "#2d354a",
                    "on-secondary": "#ffffff",
                    "surface-tint": "#465f88",
                    "outline": "#74777f",
                    "outline-variant": "#c4c6cf",
                    "on-tertiary-fixed": "#131b2e"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "fontFamily": {
                    "headline": ["Manrope"],
                    "body": ["Inter"],
                    "label": ["Inter"]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hero-overlay {
            background: linear-gradient(rgba(0, 32, 70, 0.7), rgba(0, 32, 70, 0.7));
        }
        .house-outline-bg {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.05;
            z-index: 0;
            width: 50%;
            pointer-events: none;
        }
        .grid-container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        @media (min-width: 576px) { .grid-container { max-width: 540px; } }
        @media (min-width: 768px) { .grid-container { max-width: 720px; } }
        @media (min-width: 992px) { .grid-container { max-width: 960px; } }
        @media (min-width: 1200px) { .grid-container { max-width: 1140px; } }

        /* Nav overlay specific styling */
        .nav-background {
            background-image: linear-gradient(rgba(0, 32, 70, 0.85), rgba(0, 32, 70, 0.85)), url('https://lh3.googleusercontent.com/aida-public/AB6AXuBqdfwUqi8SqjPSf2uKRLb8oX6xUMd0IUAAjiI2sgXZliqo7Xd6m--M8zTRbJYUEcITU6ohY9DVyTkKOICVsRwiMNhI-SzyS0jGNL0GomlWeLUhaZlhibFdlucGywhXj5Puy_gSVNMEzpXt_eP0DD1Kkld2S1IPPNIc2KVVT2KWKeEKL1906hMa26Si3P6CzquA3xuLSC_9rksxiY09zKVhyYtNm7a58NfZMNYxR_BTUfifAnc1WgtlLjMadmHrQhPWk_1LvFyMcP-r');
            background-size: cover;
            background-position: center;
        }
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }
        body.site-nav-open {
            overflow: hidden;
        }
        #site-mobile-menu[hidden] {
            display: none !important;
        }
        #site-mobile-menu:not([hidden]) {
            display: block;
        }
        @media (min-width: 768px) {
            #site-mobile-menu {
                display: none !important;
            }
        }
    </style>
@stack('styles')
</head>
<body class="bg-surface text-on-surface font-body antialiased">
<header class="sticky top-0 w-full z-50 nav-background shadow-lg border-b border-white/10">
<nav class="mx-auto w-full max-w-screen-2xl px-4 py-3 sm:px-6 md:px-8 lg:px-12 xl:px-14" aria-label="Main navigation">
<div class="flex items-center justify-between gap-3">
<!-- Left Links -->
<div class="hidden md:flex flex-1 justify-end items-center space-x-8 mr-10">
<a class="text-white hover:text-on-primary-container transition-colors font-headline font-bold text-xs uppercase tracking-widest" href="{{ url('/') }}">Home</a>
<a class="text-white hover:text-on-primary-container transition-colors font-headline font-bold text-xs uppercase tracking-widest" href="{{ route('services') }}">Services</a>
<a class="text-white hover:text-on-primary-container transition-colors font-headline font-bold text-xs uppercase tracking-widest" href="{{ route('about') }}">About Us</a>
</div>
<!-- Centered Logo -->
<div class="flex flex-col items-center justify-center shrink-0 min-w-0">
<a href="{{ url('/') }}" class="flex items-center gap-1.5 sm:gap-2">
<span class="material-symbols-outlined text-white text-2xl sm:text-3xl font-black shrink-0">garage</span>
<div class="flex flex-col leading-none">
<span class="text-white font-headline font-black text-xs sm:text-sm md:text-base uppercase tracking-tight">Twins Garage</span>
<span class="text-white font-headline font-black text-xs sm:text-sm md:text-base uppercase tracking-tight">Doors LLC</span>
</div>
</a>
</div>
<!-- Right Links -->
<div class="hidden md:flex flex-1 justify-start items-center space-x-8 ml-10">
<a class="text-white hover:text-on-primary-container transition-colors font-headline font-bold text-xs uppercase tracking-widest" href="{{ route('our_work') }}">Our Work</a>
<a class="text-white hover:text-on-primary-container transition-colors font-headline font-bold text-xs uppercase tracking-widest" href="{{ route('contact') }}">Contact Us</a>
<a class="{{ request()->routeIs('reviews') ? 'border-b-2 border-white pb-0.5 ' : '' }}text-white hover:text-on-primary-container transition-colors font-headline font-bold text-xs uppercase tracking-widest" href="{{ route('reviews') }}">Reviews</a>
</div>
<!-- Mobile Emergency Button (Visible on mobile instead of links) -->
<div class="flex items-center gap-2 md:hidden shrink-0">
<a href="tel:+14692888881" class="bg-on-primary-container text-primary px-2.5 py-1.5 sm:px-3 sm:py-2 rounded font-headline font-bold text-[10px] uppercase tracking-tighter whitespace-nowrap">Emergency</a>
<button type="button" id="site-nav-toggle" class="inline-flex h-10 w-10 items-center justify-center rounded border border-white/30 text-white hover:bg-white/10 transition-colors" aria-expanded="false" aria-controls="site-mobile-menu" aria-label="Open menu">
<span class="material-symbols-outlined text-2xl" id="site-nav-toggle-icon">menu</span>
</button>
</div>
</div>
<div id="site-mobile-menu" class="md:hidden border-t border-white/10 mt-3 pt-3" hidden>
<ul class="flex flex-col gap-1">
<li><a class="block rounded px-3 py-2.5 text-white font-headline font-bold text-sm uppercase tracking-widest hover:bg-white/10 {{ request()->is('/') ? 'bg-white/10' : '' }}" href="{{ url('/') }}">Home</a></li>
<li><a class="block rounded px-3 py-2.5 text-white font-headline font-bold text-sm uppercase tracking-widest hover:bg-white/10 {{ request()->routeIs('services') ? 'bg-white/10' : '' }}" href="{{ route('services') }}">Services</a></li>
<li><a class="block rounded px-3 py-2.5 text-white font-headline font-bold text-sm uppercase tracking-widest hover:bg-white/10 {{ request()->routeIs('about') ? 'bg-white/10' : '' }}" href="{{ route('about') }}">About Us</a></li>
<li><a class="block rounded px-3 py-2.5 text-white font-headline font-bold text-sm uppercase tracking-widest hover:bg-white/10 {{ request()->routeIs('our_work') ? 'bg-white/10' : '' }}" href="{{ route('our_work') }}">Our Work</a></li>
<li><a class="block rounded px-3 py-2.5 text-white font-headline font-bold text-sm uppercase tracking-widest hover:bg-white/10 {{ request()->routeIs('contact') ? 'bg-white/10' : '' }}" href="{{ route('contact') }}">Contact Us</a></li>
<li><a class="block rounded px-3 py-2.5 text-white font-headline font-bold text-sm uppercase tracking-widest hover:bg-white/10 {{ request()->routeIs('reviews') ? 'bg-white/10' : '' }}" href="{{ route('reviews') }}">Reviews</a></li>
</ul>
</div>
</nav>
</header>
@yield('content')
<footer class="w-full bg-slate-950 py-8 sm:py-12">
<div class="mx-auto flex max-w-screen-2xl flex-col items-center justify-between gap-6 px-4 sm:px-6 md:flex-row lg:px-12 xl:px-14">
<div class="font-headline font-black text-white uppercase tracking-widest">
                Twins Garage Doors
            </div>
<div class="flex flex-wrap justify-center gap-8 font-body text-sm font-light tracking-wide text-slate-400">
<a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-white transition-colors" href="#">Terms of Service</a>
<a class="hover:text-white transition-colors" href="#">Licensing</a>
</div>
<div class="text-slate-400 font-body text-sm font-light text-center md:text-right">
                © {{ date('Y') }} Twins Garage Doors LLC. Protecting What Matters Most.
            </div>
</div>
</footer>
<script>
(function () {
    var toggle = document.getElementById('site-nav-toggle');
    var panel = document.getElementById('site-mobile-menu');
    var icon = document.getElementById('site-nav-toggle-icon');
    if (!toggle || !panel) return;
    function setOpen(open) {
        panel.hidden = !open;
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        document.body.classList.toggle('site-nav-open', open);
        if (icon) icon.textContent = open ? 'close' : 'menu';
    }
    toggle.addEventListener('click', function () {
        setOpen(panel.hidden);
    });
    panel.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () { setOpen(false); });
    });
    window.addEventListener('resize', function () {
        if (window.matchMedia('(min-width: 768px)').matches) setOpen(false);
    });
})();
</script>
@stack('scripts')
</body></html>
