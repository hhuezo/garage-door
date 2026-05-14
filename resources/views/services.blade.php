@extends('menu')

@section('page_title', 'Servicios — Twins Garage Doors')

@push('styles')
<style data-purpose="services-page">
    .services-diagonal-cut {
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 40px), calc(100% - 40px) 100%, 0 100%);
    }
    .services-image-mask {
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 60px), calc(100% - 60px) 100%, 0 100%);
    }
</style>
@endpush

@php
    $serviceCards = [
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAPsMND5TfzJg_UoQPP3ZK7rc08Cfk3R59L94Mq1uDcuBKPFR3LhkkKl_shA72lxIKLqjGGlHjsLUAXy3-l5WZZpOVd3iTqmfrcC-NPEqkSEgtvM9F1PIhwyEkBG9E_hnEl9ZK4B3IwQ7_i0cej4DynVajdFEDMVf2eKSkJce9qqs0yGMikMHfSpKTQ5E0fYse7__Z9vyHhUmqM7BZsnCIxMudY09eIlHufJDZdcaqoal_mschPjqneTNadoDrTEZNUZk85Fnzjo4U',
            'icon' => 'garage',
            'title' => 'Instalación Residencial',
            'body' => 'Instalación experta de puertas de garaje modernas y duraderas, adaptadas al estilo arquitectónico de su hogar.',
            'theme' => 'light',
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB9LfncKCKW7IqnwCjqYD09WzgpfQwBWPfvDhQPFKhgTwNapUUsDWXYMFV2EgRAWx8keE2f5SZfql0s3Dp5cegf5D7v6n2vQ96ZT9Qpa1W8_KWaQPuKYGCK7NvfuUMTK7MbmRSGfdbDXUbBf-QUaH833sJlD8zIlL9-lCeg-rgSTy2DFTUVBDdue59Nl_lvtBbXbPZHQZSvcv54u9baA-plmqhrMbbTP6M7jrk7cRZ64QfA-UmGjEqld3dOVwG_4pH4qnJ51JVN8tA',
            'icon' => 'engineering',
            'title' => 'Servicio Técnico',
            'body' => 'Mantenimiento preventivo y diagnóstico preciso para asegurar el funcionamiento óptimo de sus sistemas.',
            'theme' => 'light',
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD5_C4K0eh7Fx3ON9QKWdUcSdZys-TwrxA9IMpuUZcQmziy0EVM01pglR8zGFHciqHbj7ymdnLpR-t_xcWap0GNctyEIyC_54o9_lsIOIDpjtcUpGltviryxQPFxfb7TqTB4T3um_SmL81peWxVvJmaQnLjISUdL5VaeBMrZWxxJGg3yk3MNZTZ6td7ZuOXDdFnVAiAcBUPGvXC_v5kDFbnII2LuCAImOnpjo2BPUtwSQ1pDtfMOTImQCI3PxnTxZixf5NZZoAlGD8',
            'icon' => 'build',
            'title' => 'Reparaciones 24/7',
            'body' => 'Atención inmediata para emergencias, resortes rotos, cables sueltos o motores averiados en cualquier momento.',
            'theme' => 'accent',
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCLaNaQUDN2l3zGf7ok8jD6TsyXAJIdqYliF2KKQ8otmMt6gou17wxPMBQZff5myv67tXNDOEMvdYbZVEpgGcvB4DMuSL7WyeiVYRFHKYRBgebFRZUtAIZQ2953eWyMVs8qHbqfgckjSxD0hM6zno5GElDQO9y-TaJIEgOyr2C-ipYxVqTrl3fAYBSeWTUfeCahbtH4cBrkFgDJsQDPT8MInNzlzUvEaht6ySVBOkptlr-dXo-yuW9a_6n-sthMGNzCWEdfJ9pi-Ss',
            'icon' => 'settings_input_component',
            'title' => 'Automatización',
            'body' => 'Sistemas inteligentes de apertura remota y control desde smartphone para máxima comodidad y seguridad.',
            'theme' => 'light',
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBz1dKy709rD8JWCD5Dcz0jEaierqq4SDi_rf1TchVLXosVHlNIcDJ3dqBl5hk5nRaJ7raBkrqtM4GAgR2Ad3tb_wbeVh6wPkij8W3iXqG5xAcQkgM_2kKqXSxjFGMGwcrSILyUA4FgKcDtNMKBZ0zuDsACbvS3Wmv_dY-wds1YExBNEtlNRLsYBahSkjrUYimfxciboqs5PXUIU3lnD4wCBT5jBofxbpFV7vV9Dm5VSXTUuShU0b0IR0xOVm4WRpgCxEy9khSWMvQ',
            'icon' => 'security',
            'title' => 'Seguridad y Control',
            'body' => 'Refuerzos de seguridad y sensores de movimiento para proteger lo que más importa en su propiedad.',
            'theme' => 'light',
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAZrIBEJyp05UqtOX5v_fTr40xE8NxuDEUf_hCDl2b53J6Kyijty8nOTwGeykVfZyZztbslKnfAojKlcy9s9nJQyEUSOuPzVY5-TdMFtuNBns8YpJR2kwDiPFLUG9xQJnPIcgK2KG9JEQKd1zvztZoGOUOSF1p1hSWst4s0ZD0vw6f52MRPUyFkL4N1M_YHjZdQZiuXqXzFdqzhUvGu9xJQeh5IzyrqAmkVjQzsIylbf_MgQWLlpIkr5umDYPF8aTlip_wnILelyrk',
            'icon' => 'factory',
            'title' => 'Soluciones Comerciales',
            'body' => 'Puertas de alto tráfico y gran escala para almacenes, naves industriales y centros comerciales.',
            'theme' => 'light',
        ],
    ];
@endphp

@section('content')
<div class="bg-surface">
    <div class="mx-auto w-full max-w-screen-2xl px-6 py-12 sm:px-8 md:py-16 lg:px-12 xl:px-14">
        <main class="font-body text-on-surface">
            {{-- Hero --}}
            <section class="relative mb-12 overflow-hidden bg-primary-container p-8 md:p-12 lg:mb-16">
                <div class="flex flex-col items-center gap-10 lg:flex-row lg:gap-12">
                    <div class="w-full lg:w-1/2">
                        <img
                            class="services-image-mask h-[320px] w-full object-cover md:h-[400px]"
                            alt="Técnicos profesionales trabajando en instalación de garaje"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4iyd8cadXWtPTt22UZnGFARqaiaNH_ZJa7iOt1TjgeixYwln5VKHsliTaEACBbdPCOf-nh5RcLZZEYJvZYZUWXcbe_r8lFkClvVYX1gbmoQt6V2KrxO14wYrj0PYY8fAEhKh8tE_SmCL6XN-eTeSJjVio9kPF3thLob_Xx0XtgkKaGpLneWaLG2cbzUC0hYLrT4xgOzGHic_-_dmhFRlCGaHZ7twrOIYJ66mycXarWw8MVjdWBjlB3JpahC_MXsY4JF5ddud91lI"
                        />
                    </div>
                    <div class="w-full space-y-6 lg:w-1/2">
                        <h1 class="font-headline text-4xl font-black text-on-primary md:text-5xl">Servicios</h1>
                        <p class="text-lg leading-relaxed text-on-primary-container md:text-xl">
                            Ofrecemos soluciones integrales para todas sus necesidades de puertas de garaje. Desde instalaciones expertas hasta reparaciones de emergencia, nuestro equipo técnico altamente capacitado garantiza durabilidad y seguridad en cada proyecto. Con años de experiencia y un enfoque en la calidad arquitectónica, Twins Garage Doors es su socio de confianza para el mantenimiento residencial y comercial.
                        </p>
                    </div>
                </div>
            </section>

            {{-- Grid de servicios --}}
            <section class="grid grid-cols-1 gap-10 md:grid-cols-2 md:gap-12 lg:grid-cols-3">
                @foreach ($serviceCards as $card)
                    @php
                        $isAccent = ($card['theme'] ?? 'light') === 'accent';
                    @endphp
                    <div class="services-diagonal-cut group relative flex flex-col overflow-hidden transition-transform duration-300 hover:-translate-y-2 {{ $isAccent ? 'bg-secondary text-on-secondary' : 'bg-surface-container-lowest' }}">
                        <div class="relative">
                            <img class="h-56 w-full object-cover" alt="{{ $card['title'] }}" src="{{ $card['image'] }}"/>
                            <div class="absolute -bottom-6 right-6 flex h-12 w-12 items-center justify-center rounded-full border-4 {{ $isAccent ? 'border-secondary bg-primary-container' : 'border-surface-container-lowest bg-secondary-container' }}">
                                <span class="material-symbols-outlined {{ $isAccent ? 'text-on-primary' : 'text-primary' }}">{{ $card['icon'] }}</span>
                            </div>
                        </div>
                        <div class="space-y-4 p-8">
                            <h3 class="font-headline text-xl font-bold {{ $isAccent ? 'text-on-primary' : 'text-primary' }} md:text-2xl">{{ $card['title'] }}</h3>
                            <p class="text-base leading-relaxed {{ $isAccent ? 'text-secondary-fixed' : 'text-on-surface-variant' }}">{{ $card['body'] }}</p>
                            <div class="flex items-end justify-between pt-4">
                                <a href="{{ url('/#contacto') }}" class="flex items-center gap-2 font-headline text-sm font-bold uppercase tracking-wide transition-all hover:gap-4 {{ $isAccent ? 'text-on-primary' : 'text-secondary' }}">
                                    Leer más
                                    <span class="material-symbols-outlined text-sm">double_arrow</span>
                                </a>
                                <span class="font-headline text-[10px] font-black uppercase opacity-20 {{ $isAccent ? 'text-on-primary' : 'text-primary' }}">TGD</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

            {{-- Barra contacto --}}
            <div class="mt-16 flex flex-wrap items-center justify-center gap-8 md:mt-24 lg:justify-start">
                <a href="{{ url('/#contacto') }}" class="rounded-full border-2 border-primary bg-surface-container-lowest px-8 py-3 font-headline text-sm font-bold uppercase tracking-wide text-primary transition-colors hover:bg-secondary-container">
                    Contáctanos
                </a>
                <a href="tel:+14692888881" class="font-headline text-2xl font-bold text-primary md:text-3xl">469-288-8881</a>
            </div>
        </main>
    </div>
</div>
@endsection
