<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSectionItem extends Model
{
    protected $fillable = [
        'page_section_id',
        'sort_order',
        'item_type',
        'title',
        'subtitle',
        'body',
        'link_label',
        'link_url',
        'image_id',
        'image_filename',
        'extra',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'extra' => 'array',
        ];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class, 'image_id');
    }
}
