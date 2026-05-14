<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicAboutUsController;
use App\Http\Controllers\PublicServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', PublicAboutUsController::class)->name('about');

Route::get('/services', PublicServicesController::class)->name('services');

Route::get('/our-work', function () {
    return view('our_work');
})->name('our_work');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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

    return redirect()
        ->route('contact')
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
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
