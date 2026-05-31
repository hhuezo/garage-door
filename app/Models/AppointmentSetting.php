<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentSetting extends Model
{
    protected $fillable = [
        'daily_slots_limit',
        'booking_window_days',
    ];

    protected function casts(): array
    {
        return [
            'daily_slots_limit' => 'integer',
            'booking_window_days' => 'integer',
        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate(
            ['id' => 1],
            [
                'daily_slots_limit' => 10,
                'booking_window_days' => 30,
            ]
        );
    }
}
