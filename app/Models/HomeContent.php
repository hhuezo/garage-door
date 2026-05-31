<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeContent extends Model
{
    protected $fillable = [
        'page_id',
        'hero_bg_image_filename',
        'hero_title_line1',
        'hero_title_line2',
        'hero_title_accent',
        'hero_lead',
        'hero_cta_primary_label',
        'hero_cta_secondary_label',
        'hero_inset_image_filename',
        'about_heading',
        'about_subheading',
        'about_link_label',
        'about_paragraph_1',
        'about_paragraph_2',
        'services_heading_primary',
        'services_heading_accent',
        'work_heading_primary',
        'work_heading_accent',
        'work_intro',
        'work_cta_label',
        'work_main_image_filename',
        'reviews_heading_primary',
        'reviews_heading_accent',
        'reviews_cta_label',
        'contact_heading',
        'contact_phone',
        'contact_email',
        'map_embed_url',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function stats(): HasMany
    {
        return $this->hasMany(HomeStat::class)->orderBy('sort_order');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(HomeTestimonial::class)->orderBy('sort_order');
    }
}
