<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// About Page (Coming Soon)
Route::get('/about', function () {
    return 'About page - coming soon!';
})->name('about');

// Services Page
Route::get('/services', function () {
    return view('services');
})->name('services');

// Contact Page (Coming Soon)
Route::get('/contact', function () {
    return 'Contact page - coming soon!';
})->name('contact');

// Appointment Booking Page
Route::get('/appointments', function () {
    return view('appointments.book');
})->name('appointments');

// Test route for development
Route::get('/test', function () {
    return view('test');
});