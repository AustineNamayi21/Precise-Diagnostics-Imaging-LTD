<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientVisitController;
use App\Http\Controllers\ImagingServiceController;
use App\Http\Controllers\RadiologyReportController;
use App\Http\Controllers\ReportDeliveryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC WEBSITE PAGES ====================

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

// ==================== AUTHENTICATION ROUTES ====================

// Use Laravel's built-in authentication routes
Auth::routes();

// ==================== APPOINTMENT SYSTEM ====================

// Appointment Booking Page
Route::get('/appointments', [AppointmentController::class, 'book'])->name('appointments');

// Handle Appointment Booking
Route::post('/appointments', [AppointmentController::class, 'storeWeb'])
    ->name('appointments.store');

// Appointment Success Page
Route::get('/appointments/success', [AppointmentController::class, 'success'])
    ->name('appointments.success');

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

/*
|--------------------------------------------------------------------------
| Protected Routes (Authentication Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // ==================== DASHBOARD & PROFILE ====================
    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    // My Appointments (for logged-in users)
    Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])
        ->name('appointments.my');
    
    // ==================== PATIENT MANAGEMENT SYSTEM ====================
    
    // Patient Management
    Route::resource('patients', PatientController::class);
    Route::get('patients/search/quick', [PatientController::class, 'search'])
        ->name('patients.search.quick');
    
    // Patient Visits
    Route::resource('patient-visits', PatientVisitController::class);
    Route::get('patients/{patient}/visits', [PatientVisitController::class, 'patientVisits'])
        ->name('patient-visits.by-patient');
    
    // Visit Services Management
    Route::post('visits/{visit}/services', [PatientVisitController::class, 'addService'])
        ->name('visits.add-service');
    Route::delete('service-records/{record}', [PatientVisitController::class, 'removeService'])
        ->name('visits.remove-service');
    Route::patch('service-records/{record}/status', [PatientVisitController::class, 'updateServiceStatus'])
        ->name('service-records.update-status');
    
    // Imaging Services
    Route::resource('imaging-services', ImagingServiceController::class)->except(['show']);
    
    // Radiology Reports
    Route::resource('radiology-reports', RadiologyReportController::class);
    Route::post('reports/{report}/finalize', [RadiologyReportController::class, 'finalize'])
        ->name('reports.finalize');
    Route::get('reports/{report}/preview', [RadiologyReportController::class, 'preview'])
        ->name('reports.preview');
    Route::get('reports/{report}/download', [RadiologyReportController::class, 'downloadPDF'])
        ->name('reports.download');
    Route::get('reports/create/for-service/{serviceRecord}', [RadiologyReportController::class, 'create'])
        ->name('reports.create.for-service');
    
    // Report Delivery
    Route::post('reports/{report}/send', [ReportDeliveryController::class, 'sendReport'])
        ->name('reports.send');
    Route::post('reports/bulk-send', [ReportDeliveryController::class, 'sendBulkReports'])
        ->name('reports.bulk-send');
    Route::get('report-delivery/history', [ReportDeliveryController::class, 'deliveryHistory'])
        ->name('report-delivery.history');
});

/*
|--------------------------------------------------------------------------
| Development & Testing Routes
|--------------------------------------------------------------------------
*/

// Test route for development
Route::get('/test', function () {
    return view('test');
})->name('test');

// Route to check if patient management system is accessible (for testing)
Route::get('/test-patient-system', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return 'Patient Management System is installed. Please login to access it.';
})->name('test.patient.system');