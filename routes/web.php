<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return 'About page - coming soon!';
})->name('about');

Route::get('/services', function () {
    return 'Services page - coming soon!';
})->name('services');

Route::get('/contact', function () {
    return 'Contact page - coming soon!';
})->name('contact');

Route::get('/appointments', function () {
    return 'Appointment booking - coming soon!';
})->name('appointments');