<?php

use App\Http\Controllers\Admin\AppointmentBookingController;
use App\Http\Controllers\Admin\AppointmentSettingsController;
use App\Http\Controllers\Admin\AppointmentSlotController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicAboutUsController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PublicOurWorkController;
use App\Http\Controllers\PublicServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Route::get('/about-us', PublicAboutUsController::class)->name('about');

Route::get('/services', PublicServicesController::class)->name('services');

Route::get('/our-work', PublicOurWorkController::class)->name('our_work');

Route::get('/contact', [PublicContactController::class, 'show'])->name('contact');
Route::get('/contact/available-slots', [PublicContactController::class, 'availableSlots'])->name('contact.available-slots');
Route::post('/contact/appointment', [PublicContactController::class, 'storeAppointment'])->name('contact.appointment.store');

Route::get('/reviews', function () {
    return view('reviews');
})->name('reviews');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'phone' => ['nullable', 'string', 'max:40'],
        'email' => ['required', 'email', 'max:255'],
        'subject' => ['nullable', 'string', 'max:255'],
        'message' => ['required', 'string', 'max:5000'],
    ]);

    $previous = url()->previous();
    $redirectTo = ($previous === url('/') || str_ends_with($previous, '/#contacto'))
        ? url('/#contacto')
        : route('contact');

    return redirect($redirectTo)
        ->with('status', 'Thank you — we received your message and will get back to you soon.');
})->name('contact.submit');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::post('/profile/change-password', function () {
        return back()->with('password-error', 'La actualización de contraseña desde el panel aún no está configurada.');
    })->name('profile.change-password');

    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}/about-us', [PageController::class, 'updateAboutUs'])->name('pages.about-us.update');
    Route::put('/pages/{id}/services', [PageController::class, 'updateServices'])->name('pages.services.update');
    Route::put('/pages/{id}/our-work', [PageController::class, 'updateOurWork'])->name('pages.our-work.update');
    Route::put('/pages/{id}/welcome', [PageController::class, 'updateWelcome'])->name('pages.welcome.update');

    Route::get('/appointments/settings', [AppointmentSettingsController::class, 'index'])->name('appointments.settings');
    Route::post('/appointments/settings', [AppointmentSettingsController::class, 'updateSettings'])->name('appointments.settings.update');
    Route::post('/appointments/slots', [AppointmentSlotController::class, 'store'])->name('appointments.slots.store');
    Route::put('/appointments/slots/{slot}', [AppointmentSlotController::class, 'update'])->name('appointments.slots.update');
    Route::delete('/appointments/slots/{slot}', [AppointmentSlotController::class, 'destroy'])->name('appointments.slots.destroy');
    Route::get('/appointments/bookings', [AppointmentBookingController::class, 'index'])->name('appointments.bookings.index');
    Route::patch('/appointments/bookings/{booking}/cancel', [AppointmentBookingController::class, 'cancel'])->name('appointments.bookings.cancel');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
