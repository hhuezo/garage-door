<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OurWorkProject extends Model
{
    protected $fillable = [
        'our_work_content_id',
        'sort_order',
        'title',
        'body',
        'icon',
        'image_path',
        'link_label',
        'link_url',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(OurWorkContent::class, 'our_work_content_id');
    }
}
