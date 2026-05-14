<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServicesContent extends Model
{
    protected $fillable = [
        'page_id',
        'hero_title',
        'hero_lead',
        'hero_image_filename',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(ServicesCard::class)->orderBy('sort_order');
    }
}
