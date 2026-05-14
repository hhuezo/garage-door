<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', function () {
    return view('about_us');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
