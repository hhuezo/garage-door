<?php

namespace App\Services;

use App\Models\AppointmentBooking;
use App\Models\AppointmentSetting;
use App\Models\AppointmentTimeSlot;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentAvailability
{
    public function settings(): AppointmentSetting
    {
        return AppointmentSetting::current();
    }

    public function isBookableDate(Carbon $date): bool
    {
        $settings = $this->settings();
        $today = Carbon::today();

        if ($date->lt($today)) {
            return false;
        }

        if ($date->isSunday()) {
            return false;
        }

        $maxDate = $today->copy()->addDays($settings->booking_window_days);

        return $date->lte($maxDate);
    }

    /**
     * @return Collection<int, array{id: int, label_en: string, start_time: string, capacity: int, booked: int, remaining: int}>
     */
    public function availableSlotsForDate(Carbon $date): Collection
    {
        if (! $this->isBookableDate($date)) {
            return collect();
        }

        $settings = $this->settings();
        $dateString = $date->toDateString();

        $dailyBooked = AppointmentBooking::query()
            ->where('appointment_date', $dateString)
            ->where('status', AppointmentBooking::STATUS_PENDING)
            ->count();

        if ($dailyBooked >= $settings->daily_slots_limit) {
            return collect();
        }

        $dailyRemaining = $settings->daily_slots_limit - $dailyBooked;

        $slots = AppointmentTimeSlot::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        $bookedBySlot = AppointmentBooking::query()
            ->where('appointment_date', $dateString)
            ->where('status', AppointmentBooking::STATUS_PENDING)
            ->selectRaw('appointment_time_slot_id, COUNT(*) as total')
            ->groupBy('appointment_time_slot_id')
            ->pluck('total', 'appointment_time_slot_id');

        $available = collect();

        foreach ($slots as $slot) {
            $booked = (int) ($bookedBySlot[$slot->id] ?? 0);
            $slotRemaining = max(0, $slot->capacity - $booked);
            $remaining = min($slotRemaining, $dailyRemaining);

            if ($remaining <= 0) {
                continue;
            }

            $available->push([
                'id' => $slot->id,
                'label_en' => $slot->label_en,
                'start_time' => $slot->start_time,
                'capacity' => $slot->capacity,
                'booked' => $booked,
                'remaining' => $remaining,
            ]);
        }

        return $available;
    }

    /**
     * @param  array{appointment_date: string, appointment_time_slot_id: int, customer_name: string, customer_phone?: ?string, customer_email: string, notes?: ?string}  $data
     */
    public function createBooking(array $data): AppointmentBooking
    {
        return DB::transaction(function () use ($data) {
            $date = Carbon::parse($data['appointment_date'])->startOfDay();

            if (! $this->isBookableDate($date)) {
                throw ValidationException::withMessages([
                    'appointment_date' => ['The selected date is not available for booking.'],
                ]);
            }

            $slot = AppointmentTimeSlot::query()
                ->where('id', $data['appointment_time_slot_id'])
                ->where('is_active', true)
                ->lockForUpdate()
                ->first();

            if (! $slot) {
                throw ValidationException::withMessages([
                    'appointment_time_slot_id' => ['The selected time slot is not available.'],
                ]);
            }

            $settings = AppointmentSetting::current();
            $dateString = $date->toDateString();

            $dailyBooked = AppointmentBooking::query()
                ->where('appointment_date', $dateString)
                ->where('status', AppointmentBooking::STATUS_PENDING)
                ->lockForUpdate()
                ->count();

            if ($dailyBooked >= $settings->daily_slots_limit) {
                throw ValidationException::withMessages([
                    'appointment_date' => ['No appointment slots remain for this date.'],
                ]);
            }

            $slotBooked = AppointmentBooking::query()
                ->where('appointment_date', $dateString)
                ->where('appointment_time_slot_id', $slot->id)
                ->where('status', AppointmentBooking::STATUS_PENDING)
                ->lockForUpdate()
                ->count();

            if ($slotBooked >= $slot->capacity) {
                throw ValidationException::withMessages([
                    'appointment_time_slot_id' => ['This time slot is fully booked.'],
                ]);
            }

            return AppointmentBooking::query()->create([
                'appointment_date' => $dateString,
                'appointment_time_slot_id' => $slot->id,
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'customer_email' => $data['customer_email'],
                'notes' => $data['notes'] ?? null,
                'status' => AppointmentBooking::STATUS_PENDING,
            ]);
        });
    }

    public function cancelBooking(AppointmentBooking $booking): void
    {
        if ($booking->status === AppointmentBooking::STATUS_CANCELLED) {
            return;
        }

        $booking->update(['status' => AppointmentBooking::STATUS_CANCELLED]);
    }
}
