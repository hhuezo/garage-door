<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MediaFile extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'disk',
        'alt_text',
        'mime_type',
        'size_bytes',
    ];

    protected function casts(): array
    {
        return [
            'size_bytes' => 'integer',
        ];
    }

    public function sectionItems(): HasMany
    {
        return $this->hasMany(PageSectionItem::class, 'image_id');
    }
}
