<?php

namespace App\Http\Controllers;

    use App\Mail\AppointmentRequested;
use App\Mail\ContactFormSubmitted;
use App\Models\Page;
use App\Services\AppointmentAvailability;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

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

    public function storeMessage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        if (! $this->sendAdminMail(new ContactFormSubmitted(
            $validated['name'],
            $validated['phone'] ?? null,
            $validated['email'],
            $validated['subject'] ?? null,
            $validated['message'],
        ))) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'mail' => 'We could not send your message. Please try again or contact us by phone.',
                ]);
        }

        $previous = url()->previous();
        $redirectTo = ($previous === url('/') || str_ends_with($previous, '/#contacto'))
            ? url('/#contacto')
            : route('contact');

        return redirect($redirectTo)
            ->with('status', 'Thank you — we received your message and will get back to you soon.');
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

        $booking = $this->availability->createBooking($validated);
        $booking->load('timeSlot');

        if (! $this->sendAdminMail(new AppointmentRequested($booking))) {
            return redirect()
                ->route('contact')
                ->withInput()
                ->withErrors([
                    'mail' => 'Your appointment was saved, but we could not send the notification email. We will still review your request.',
                ]);
        }

        return redirect()
            ->route('contact')
            ->with('appointment_status', 'Your appointment request has been received. We will confirm your visit soon.');
    }

    private function sendAdminMail(Mailable $mailable): bool
    {
        $adminTo = config('mail.admin_to');

        if (empty($adminTo)) {
            Log::error('MAIL_ADMIN_TO is not configured; unable to send notification email.');

            return false;
        }

        try {
            Mail::to($adminTo)->send($mailable);
        } catch (Throwable $exception) {
            Log::error('Failed to send notification email.', [
                'exception' => $exception->getMessage(),
            ]);

            return false;
        }

        return true;
    }
}
