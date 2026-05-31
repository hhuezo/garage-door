<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentBooking;
use App\Services\AppointmentAvailability;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentBookingController extends Controller
{
    public function __construct(
        private readonly AppointmentAvailability $availability,
    ) {}

    public function index(Request $request): View
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $query = AppointmentBooking::query()
            ->with('timeSlot')
            ->orderByDesc('appointment_date')
            ->orderByDesc('created_at');

        if ($from) {
            $query->whereDate('appointment_date', '>=', $from);
        }

        if ($to) {
            $query->whereDate('appointment_date', '<=', $to);
        }

        $bookings = $query->get();

        return view('admin.appointments.bookings.index', [
            'bookings' => $bookings,
            'from' => $from,
            'to' => $to,
        ]);
    }

    public function cancel(AppointmentBooking $booking): RedirectResponse
    {
        $this->availability->cancelBooking($booking);

        return redirect()
            ->route('appointments.bookings.index', request()->only(['from', 'to']))
            ->with('success', 'Appointment cancelled.');
    }
}
