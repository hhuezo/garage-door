<?php

namespace App\Support;

class CmsPage
{
    public static function materialIconFromStored(?string $icon, int $index): string
    {
        if (is_string($icon) && preg_match('/^[a-z0-9_]+$/', $icon)) {
            return $icon;
        }

        return match ($index % 3) {
            0 => 'garage',
            1 => 'construction',
            2 => 'handyman',
            default => 'garage',
        };
    }

    /**
     * Icono Material Symbols con valor por defecto (p. ej. bloque intro de About).
     */
    public static function materialIconOrDefault(?string $icon, string $default = 'engineering'): string
    {
        if (is_string($icon) && preg_match('/^[a-z0-9_]+$/', $icon)) {
            return $icon;
        }

        return $default;
    }

    public static function imageUrlFromFilename(?string $imageFilename): string
    {
        if (! empty($imageFilename)) {
            return asset('images/'.$imageFilename);
        }

        return asset('images/service1.jpg');
    }

    /**
     * Imagen de tarjeta u hero: URL absoluta, o ruta bajo public/images/.
     */
    public static function publicImageOrUrl(?string $stored): string
    {
        if ($stored === null || $stored === '') {
            return asset('images/service1.jpg');
        }
        $trim = trim($stored);
        if (str_starts_with($trim, 'http://') || str_starts_with($trim, 'https://')) {
            return $trim;
        }

        return asset('images/'.$trim);
    }

    /**
     * URL del icono del intro (archivo subido en public/images).
     */
    public static function introIconFileUrl(?string $introIconFilename): ?string
    {
        if (! empty($introIconFilename)) {
            return asset('images/'.$introIconFilename);
        }

        return null;
    }
}
