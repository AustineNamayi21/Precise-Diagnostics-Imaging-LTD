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

// Appointment Booking Page
Route::get('/appointments', function () {
    return view('appointments.book');
})->name('appointments');

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