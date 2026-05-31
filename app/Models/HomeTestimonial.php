<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeTestimonial extends Model
{
    protected $fillable = [
        'home_content_id',
        'sort_order',
        'quote',
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
        return $this->belongsTo(HomeContent::class, 'home_content_id');
    }
}
