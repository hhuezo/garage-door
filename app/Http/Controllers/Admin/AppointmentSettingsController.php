<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentBooking;
use App\Models\AppointmentSetting;
use App\Models\AppointmentTimeSlot;
use App\Services\AppointmentAvailability;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentSettingsController extends Controller
{
    public function index(): View
    {
        $settings = AppointmentSetting::current();
        $slots = AppointmentTimeSlot::query()
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->get();

        return view('admin.appointments.settings', [
            'settings' => $settings,
            'slots' => $slots,
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'daily_slots_limit' => ['required', 'integer', 'min:1', 'max:500'],
            'booking_window_days' => ['required', 'integer', 'min:1', 'max:365'],
        ]);

        $settings = AppointmentSetting::current();
        $settings->update($validated);

        return redirect()
            ->route('appointments.settings')
            ->with('success', 'Appointment settings saved.');
    }
}
