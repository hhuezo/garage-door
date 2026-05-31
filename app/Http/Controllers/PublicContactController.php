<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\AppointmentAvailability;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicContactController extends Controller
{
    public function __construct(
        private readonly AppointmentAvailability $availability,
    ) {}

    public function show(): View
    {
        $settings = $this->availability->settings();
        $minDate = Carbon::today()->toDateString();
        $maxDate = Carbon::today()->addDays($settings->booking_window_days)->toDateString();

        $homeContent = Page::query()
            ->where('slug', 'welcome')
            ->with('homeContent')
            ->first()?->homeContent;

        return view('contact', [
            'appointmentMinDate' => $minDate,
            'appointmentMaxDate' => $maxDate,
            'bookingWindowDays' => $settings->booking_window_days,
            'homeContent' => $homeContent,
        ]);
    }

    public function availableSlots(Request $request): JsonResponse
    {
        $request->validate([
            'date' => ['required', 'date', 'date_format:Y-m-d'],
        ]);

        $date = Carbon::parse($request->input('date'))->startOfDay();
        $slots = $this->availability->availableSlotsForDate($date);

        return response()->json([
            'date' => $date->toDateString(),
            'slots' => $slots->values()->all(),
        ]);
    }

    public function storeAppointment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'appointment_date' => ['required', 'date', 'date_format:Y-m-d'],
            'appointment_time_slot_id' => ['required', 'integer', 'exists:appointment_time_slots,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:40'],
            'customer_email' => ['required', 'email', 'max:255'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $this->availability->createBooking($validated);

        return redirect()
            ->route('contact')
            ->with('appointment_status', 'Your appointment request has been received. We will confirm your visit soon.');
    }
}
