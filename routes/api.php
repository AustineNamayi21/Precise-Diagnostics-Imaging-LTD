<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::prefix('appointments')->group(function () {
    // Public routes
    Route::get('/services', [AppointmentController::class, 'getServices']);
    Route::post('/check-availability', [AppointmentController::class, 'checkAvailability']);
    Route::post('/book', [AppointmentController::class, 'store']);
    Route::get('/{id}', [AppointmentController::class, 'show']);
});

// Protected routes (for logged-in users)
Route::middleware(['auth:sanctum'])->prefix('appointments')->group(function () {
    Route::get('/my-appointments', [AppointmentController::class, 'patientAppointments']);
    Route::post('/{id}/cancel', [AppointmentController::class, 'cancel']);
});