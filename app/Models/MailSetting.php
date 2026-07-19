<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    protected $fillable = [
        'mailer',
        'host',
        'port',
        'scheme',
        'username',
        'password',
        'from_address',
        'from_name',
        'admin_to',
    ];

    protected function casts(): array
    {
        return [
            'port' => 'integer',
        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate(
            ['id' => 1],
            [
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'scheme' => config('mail.mailers.smtp.scheme'),
                'username' => config('mail.mailers.smtp.username'),
                'password' => config('mail.mailers.smtp.password'),
                'from_address' => config('mail.from.address'),
                'from_name' => config('mail.from.name'),
                'admin_to' => config('mail.admin_to'),
            ]
        );
    }
}
