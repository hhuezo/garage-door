<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'meta_title',
        'meta_description',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function aboutUsContent(): HasOne
    {
        return $this->hasOne(AboutUsContent::class);
    }

    public function servicesContent(): HasOne
    {
        return $this->hasOne(ServicesContent::class);
    }

    /**
     * Ruta pública del sitio (path) para enlaces desde el admin.
     */
    public function previewPath(): string
    {
        return match ($this->slug) {
            'welcome' => '/',
            'about-us' => '/about-us',
            'services' => '/services',
            'our-work' => '/our-work',
            'contact' => '/contact',
            'reviews' => '/reviews',
            default => '/',
        };
    }
}
