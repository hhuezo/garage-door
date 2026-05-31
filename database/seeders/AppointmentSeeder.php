<?php

namespace Database\Seeders;

use App\Models\AppointmentSetting;
use App\Models\AppointmentTimeSlot;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        AppointmentSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'daily_slots_limit' => 10,
                'booking_window_days' => 30,
            ]
        );

        $hours = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

        foreach ($hours as $index => $time) {
            $startTime = $time.':00';

            AppointmentTimeSlot::query()->updateOrCreate(
                ['start_time' => $startTime],
                [
                    'label_en' => AppointmentTimeSlot::labelFromStartTime($startTime),
                    'capacity' => 2,
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }
}
