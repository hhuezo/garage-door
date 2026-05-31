<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentTimeSlot extends Model
{
    protected $fillable = [
        'label_en',
        'start_time',
        'capacity',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(AppointmentBooking::class);
    }

    public static function labelFromStartTime(string $startTime): string
    {
        return Carbon::parse($startTime)->format('g:i A');
    }
}
