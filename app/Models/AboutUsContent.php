<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutUsContent extends Model
{
    protected $fillable = [
        'page_id',
        'hero_eyebrow',
        'hero_title',
        'intro',
        'hero_image_filename',
        'intro_icon',
        'intro_icon_filename',
        'values_section_heading',
        'values_section_logo_filename',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(AboutUsCard::class)->orderBy('sort_order');
    }
}
