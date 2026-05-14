<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageTextSnippet extends Model
{
    protected $fillable = [
        'page_id',
        'field_key',
        'value',
        'locale',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
