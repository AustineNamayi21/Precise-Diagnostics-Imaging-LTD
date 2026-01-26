<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Web\AppointmentController as PublicAppointmentController;
use App\Http\Controllers\DashboardController;

// Admin controllers (you will create these in the next step)
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Admin\ImagingServiceController;
use App\Http\Controllers\Admin\RadiologyReportController;
use App\Http\Controllers\Admin\ReportDeliveryController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\FinanceController;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// Public website pages
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services');
Route::view('/contact', 'contact')->name('contact');

// Auth routes
Auth::routes();

// Public appointment booking
Route::get('/appointments', [PublicAppointmentController::class, 'book'])->name('appointments');
Route::post('/appointments', [PublicAppointmentController::class, 'storeWeb'])->name('appointments.store');
Route::get('/appointments/success', [PublicAppointmentController::class, 'success'])->name('appointments.success');

// Static pages
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/terms-of-service', 'terms')->name('terms');
Route::view('/sitemap', 'sitemap')->name('sitemap');
Route::view('/careers', 'careers')->name('careers');


/*
|--------------------------------------------------------------------------
| Protected Routes (Authentication Required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // User dashboard & profile
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');

    // Logged-in user's appointments (optional - only if you built it)
    Route::get('/my-appointments', [PublicAppointmentController::class, 'myAppointments'])->name('appointments.my');


    /*
    |--------------------------------------------------------------------------
    | Admin Platform (Patient Management System)
    |--------------------------------------------------------------------------
    | Everything admin lives under /admin to avoid conflicts with public pages.
    | Later you can add role middleware: ->middleware(['auth','can:admin'])
    */

    Route::prefix('admin')->name('admin.')->group(function () {

        // Admin dashboard (you can point this to DashboardController or a dedicated AdminDashboardController)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Appointments (Read-Only Admin View)
        |--------------------------------------------------------------------------
        */
        Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');

        // OPTIONAL: Convert appointment -> visit (we can implement later)
        // Route::post('/appointments/{appointment}/convert-to-visit', [AdminAppointmentController::class, 'convertToVisit'])
        //     ->name('appointments.convert');

        /*
        |--------------------------------------------------------------------------
        | Services Catalog (Procedures)
        |--------------------------------------------------------------------------
        */
        Route::resource('/services', ServiceController::class)->except(['show']);

        /*
        |--------------------------------------------------------------------------
        | Patients
        |--------------------------------------------------------------------------
        */
        Route::resource('/patients', PatientController::class);
        Route::get('/patients/search/quick', [PatientController::class, 'search'])->name('patients.search.quick');

        /*
        |--------------------------------------------------------------------------
        | Visits (Encounter Header)
        |--------------------------------------------------------------------------
        */
        Route::resource('/visits', VisitController::class);

        // View all visits for a patient (nice shortcut)
        Route::get('/patients/{patient}/visits', [VisitController::class, 'byPatient'])->name('visits.by-patient');

        /*
        |--------------------------------------------------------------------------
        | Imaging Services (Performed Exams / Line Items)
        |--------------------------------------------------------------------------
        | Note: these are created *for a visit*
        */
        Route::post('/visits/{visit}/imaging-services', [ImagingServiceController::class, 'storeForVisit'])
            ->name('visits.imaging-services.store');

        Route::patch('/imaging-services/{imagingService}/status', [ImagingServiceController::class, 'updateStatus'])
            ->name('imaging-services.update-status');

        Route::resource('/imaging-services', ImagingServiceController::class)->except(['create', 'store']);

        /*
        |--------------------------------------------------------------------------
        | Radiology Reports (1 per Imaging Service)
        |--------------------------------------------------------------------------
        */
        // Create/edit report for a specific imaging service
        Route::get('/imaging-services/{imagingService}/report/create', [RadiologyReportController::class, 'createForImagingService'])
            ->name('reports.create.for-imaging-service');

        Route::post('/imaging-services/{imagingService}/report', [RadiologyReportController::class, 'storeForImagingService'])
            ->name('reports.store.for-imaging-service');

        Route::resource('/reports', RadiologyReportController::class)->except(['create', 'store']);

        // Report actions
        Route::post('/reports/{radiologyReport}/finalize', [RadiologyReportController::class, 'finalize'])
            ->name('reports.finalize');

        Route::get('/reports/{radiologyReport}/preview', [RadiologyReportController::class, 'preview'])
            ->name('reports.preview');

        Route::get('/reports/{radiologyReport}/download', [RadiologyReportController::class, 'download'])
            ->name('reports.download');

        /*
        |--------------------------------------------------------------------------
        | Report Delivery (Email Send + History)
        |--------------------------------------------------------------------------
        */
        Route::post('/reports/{radiologyReport}/send', [ReportDeliveryController::class, 'send'])
            ->name('reports.send');

        Route::get('/deliveries', [ReportDeliveryController::class, 'index'])
            ->name('deliveries.index');

        /*
        |--------------------------------------------------------------------------
        | Finance (Revenue Reports)
        |--------------------------------------------------------------------------
        */
        Route::get('/finance', [FinanceController::class, 'dashboard'])->name('finance.dashboard');

        Route::get('/finance/reports/daily', [FinanceController::class, 'daily'])->name('finance.reports.daily');
        Route::get('/finance/reports/weekly', [FinanceController::class, 'weekly'])->name('finance.reports.weekly');
        Route::get('/finance/reports/monthly', [FinanceController::class, 'monthly'])->name('finance.reports.monthly');
        Route::get('/finance/reports/yearly', [FinanceController::class, 'yearly'])->name('finance.reports.yearly');

        // OPTIONAL: invoices/payments CRUD later
        // Route::resource('/invoices', InvoiceController::class);
        // Route::resource('/payments', PaymentController::class)->only(['store', 'index', 'show']);
    });
});


/*
|--------------------------------------------------------------------------
| Development & Testing Routes
|--------------------------------------------------------------------------
*/
Route::view('/test', 'test')->name('test');

Route::get('/test-patient-system', function () {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }
    return 'Patient Management System is installed. Please login to access it.';
})->name('test.patient.system');
