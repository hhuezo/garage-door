<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;

/**
 * Repone filas de catálogo en `pages` (metadatos por slug) sin recrear el CMS eliminado.
 * No borra ni modifica about_us_contents / about_us_cards.
 */
return new class extends Migration
{
    public function up(): void
    {
        $pages = [
            [
                'slug' => 'welcome',
                'name' => 'Home',
                'meta_title' => 'Twins Garage Doors — DFW',
                'meta_description' => 'Garage door and gate installation, repair, and service in the Dallas–Fort Worth area.',
                'is_published' => true,
            ],
            [
                'slug' => 'about-us',
                'name' => 'About Us',
                'meta_title' => 'About Us — Twins Garage Doors',
                'meta_description' => 'Family-owned garage door and gate company serving DFW.',
                'is_published' => true,
            ],
            [
                'slug' => 'services',
                'name' => 'Services',
                'meta_title' => 'Services — Twins Garage Doors',
                'meta_description' => 'Installation, repair, gates, and openers.',
                'is_published' => true,
            ],
            [
                'slug' => 'our-work',
                'name' => 'Our Work',
                'meta_title' => 'Our Work — Twins Garage Doors',
                'meta_description' => 'Recent garage door projects in DFW.',
                'is_published' => true,
            ],
            [
                'slug' => 'contact',
                'name' => 'Contact',
                'meta_title' => 'Contact Us — Twins Garage Doors',
                'meta_description' => 'Call, email, or send a message — DFW garage doors and gates.',
                'is_published' => true,
            ],
            [
                'slug' => 'reviews',
                'name' => 'Reviews',
                'meta_title' => 'Reviews — Twins Garage Doors',
                'meta_description' => 'Customer testimonials for Twins Garage Doors.',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $row) {
            $slug = $row['slug'];
            if (Page::query()->where('slug', $slug)->exists()) {
                continue;
            }
            unset($row['slug']);
            Page::query()->create(array_merge(['slug' => $slug], $row));
        }
    }

    public function down(): void
    {
        // Sin reversa: las filas pueden seguir usándose en el proyecto.
    }
};
