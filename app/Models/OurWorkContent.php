<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OurWorkContent extends Model
{
    protected $fillable = [
        'page_id',
        'hero_title_primary',
        'hero_title_accent',
        'hero_icon',
        'hero_intro',
        'hero_cta_label',
        'hero_cta_url',
        'hero_main_image_filename',
        'hero_inset_image_filename',
        'stat_value',
        'stat_caption',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(OurWorkProject::class)->orderBy('sort_order');
    }
}
