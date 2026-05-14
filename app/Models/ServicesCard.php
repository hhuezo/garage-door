<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicesCard extends Model
{
    protected $fillable = [
        'services_content_id',
        'sort_order',
        'title',
        'body',
        'icon',
        'image_path',
        'theme',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(ServicesContent::class, 'services_content_id');
    }
}
