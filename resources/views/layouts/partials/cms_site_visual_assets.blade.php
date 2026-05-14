<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;700;800&amp;family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        @if (! empty($tailwindImportant ?? null))
        important: @json($tailwindImportant),
        @endif
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
    </style>
