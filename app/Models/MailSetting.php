<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    protected $fillable = [
        'username',
        'password',
        'from_address',
        'from_name',
        'admin_to',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(
            ['id' => 1],
            [
                'username' => config('mail.mailers.smtp.username'),
                'password' => config('mail.mailers.smtp.password'),
                'from_address' => config('mail.from.address'),
                'from_name' => config('mail.from.name'),
                'admin_to' => config('mail.admin_to'),
            ]
        );
    }
}
