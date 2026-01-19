<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AppointmentController;

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// About Page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Services Page
Route::get('/services', function () {
    return view('services');
})->name('services');

// Contact Page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ==================== APPOINTMENT SYSTEM ====================

// Appointment Booking Page
Route::get('/appointments', [AppointmentController::class, 'book'])->name('appointments');

// Handle Appointment Booking
Route::post('/appointments', [AppointmentController::class, 'storeWeb'])->name('appointments.store');

// Appointment Success Page
Route::get('/appointments/success', [AppointmentController::class, 'success'])->name('appointments.success');

// My Appointments (for logged-in users)
Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.my');

// ==================== STATIC PAGES ====================

// Privacy Policy Page
Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');

// Terms of Service Page
Route::get('/terms-of-service', function () {
    return view('terms');
})->name('terms');

// Sitemap Page
Route::get('/sitemap', function () {
    return view('sitemap');
})->name('sitemap');

// Careers Page
Route::get('/careers', function () {
    return view('careers');
})->name('careers');

// Test route for development
Route::get('/test', function () {
    return view('test');
});