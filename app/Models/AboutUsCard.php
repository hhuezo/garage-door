<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutUsCard extends Model
{
    protected $fillable = [
        'about_us_content_id',
        'sort_order',
        'title',
        'body',
        'link_label',
        'link_url',
        'image_filename',
        'icon',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(AboutUsContent::class, 'about_us_content_id');
    }
}
