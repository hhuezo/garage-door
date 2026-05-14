<?php

namespace App\Support;

/**
 * Iconos Material Symbols (nombre en snake_case) ofrecidos en el CMS.
 *
 * @see https://fonts.google.com/icons
 */
final class MaterialIconOptions
{
    /**
     * Iconos Material para las tarjetas de la sección «Valores» en About Us.
     *
     * @return array<string, string>
     */
    public static function aboutValueCardIcons(): array
    {
        return self::aboutIntroIcons();
    }

    /**
     * Iconos para tarjetas de la página Servicios (CMS).
     *
     * @return array<string, string>
     */
    public static function serviceCardIcons(): array
    {
        return array_merge(self::aboutIntroIcons(), [
            'settings_input_component' => 'Componentes / automatización',
            'security' => 'Seguridad',
        ]);
    }

    /**
     * Iconos sugeridos para el bloque intro de About Us.
     *
     * @return array<string, string> clave del icono => etiqueta en español
     */
    public static function aboutIntroIcons(): array
    {
        return [
            'engineering' => 'Ingeniería',
            'garage' => 'Garage / cochera',
            'garage_home' => 'Garage con vivienda',
            'door_front' => 'Puerta frontal',
            'door_open' => 'Puerta abierta',
            'window' => 'Ventana',
            'roller_shades' => 'Persiana enrollable',
            'blinds' => 'Persianas',
            'fence' => 'Cerca / cerramiento',
            'home_repair_service' => 'Reparación del hogar',
            'home' => 'Hogar',
            'apartment' => 'Edificio / apartamentos',
            'villa' => 'Vivienda unifamiliar',
            'cottage' => 'Chalet / cabaña',
            'construction' => 'Construcción',
            'handyman' => 'Mantenimiento',
            'build' => 'Obra / construir',
            'foundation' => 'Cimientos',
            'architecture' => 'Arquitectura',
            'design_services' => 'Diseño / proyectos',
            'draw' => 'Planos / dibujo',
            'precision_manufacturing' => 'Manufactura',
            'factory' => 'Fábrica / taller',
            'warehouse' => 'Almacén',
            'inventory_2' => 'Inventario',
            'local_shipping' => 'Envío / logística',
            'storefront' => 'Negocio / tienda',
            'groups' => 'Equipo',
            'handshake' => 'Acuerdo / confianza',
            'volunteer_activism' => 'Compromiso social',
            'award_star' => 'Calidad',
            'workspace_premium' => 'Servicio premium',
            'verified' => 'Verificado',
            'shield' => 'Protección / seguro',
            'health_and_safety' => 'Salud y seguridad',
            'policy' => 'Normativa / póliza',
            'gavel' => 'Legal / contratos',
            'key' => 'Llave / acceso',
            'lock' => 'Candado',
            'lock_open' => 'Acceso / apertura',
            'schedule' => 'Horario',
            'calendar_month' => 'Calendario',
            'timer' => 'Tiempo / rapidez',
            'bolt' => 'Eléctrico / energía',
            'electrical_services' => 'Electricidad',
            'plumbing' => 'Fontanería',
            'roofing' => 'Techos / cubiertas',
            'cleaning_services' => 'Limpieza / acabados',
            'solar_power' => 'Energía solar',
            'eco' => 'Ecológico',
            'local_fire_department' => 'Emergencias / seguridad',
            'call' => 'Teléfono',
            'mail' => 'Correo',
            'chat' => 'Chat / mensajes',
            'support_agent' => 'Atención al cliente',
            'headset_mic' => 'Soporte telefónico',
            'tools' => 'Herramientas',
            'hardware' => 'Herrajes / ferretería',
            'tune' => 'Ajuste fino / calibración',
            'build_circle' => 'Montaje / instalación',
            'check_circle' => 'Completado / OK',
            'task_alt' => 'Tareas / checklist',
            'star' => 'Destacado',
            'favorite' => 'Favorito / preferencia',
            'trending_up' => 'Mejora / crecimiento',
            'savings' => 'Ahorro / valor',
            'payments' => 'Pagos',
            'credit_card' => 'Tarjeta / cobro',
            'account_balance' => 'Finanzas / cuenta',
            'map' => 'Mapa / zona',
            'location_on' => 'Ubicación',
            'navigation' => 'Navegación / rutas',
            'directions_car' => 'Vehículo / acceso',
            'local_parking' => 'Estacionamiento',
            'car_crash' => 'Siniestro / daños',
            'auto_awesome' => 'Destacado visual',
            'emoji_objects' => 'Ideas / soluciones',
            'lightbulb' => 'Ideas / innovación',
            'psychology' => 'Asesoría / experiencia',
            'school' => 'Formación / capacitación',
            'menu_book' => 'Documentación / guías',
            'description' => 'Texto / detalle',
            'article' => 'Artículo / contenido',
            'campaign' => 'Campaña / comunicación',
            'public' => 'Público / comunidad',
            'diversity_3' => 'Diversidad / personas',
            'family_restroom' => 'Familia',
            'child_care' => 'Niños / hogar',
            'pets' => 'Mascotas',
            'yard' => 'Patio / exterior',
            'grass' => 'Jardín / exterior',
            'deck' => 'Terraza / deck',
            'balcony' => 'Balcón',
            'elevator' => 'Elevador',
            'stairs' => 'Escaleras',
            'sensor_door' => 'Sensor de puerta',
            'smart_toy' => 'Domótica / inteligente',
            'router' => 'Red / conectividad',
            'wifi' => 'Wi‑Fi',
            'smartphone' => 'Móvil / app',
            'laptop' => 'Ordenador / oficina',
            'monitor' => 'Pantalla / control',
        ];
    }
}
