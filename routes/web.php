<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// Public (website) controllers
use App\Http\Controllers\Web\AppointmentController as PublicAppointmentController;

// Admin controllers
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Admin\ImagingServiceController;
use App\Http\Controllers\Admin\RadiologyReportController;
use App\Http\Controllers\Admin\ReportDeliveryController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE ROUTES (NO AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::view('/', 'web.home')->name('home');
Route::view('/about', 'web.about')->name('about');
Route::view('/services', 'web.services')->name('services');
Route::view('/contact', 'web.contact')->name('contact');

// Optional static pages
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::view('/sitemap', 'sitemap')->name('sitemap');
Route::view('/careers', 'careers')->name('careers');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| ✅ AUTH REDIRECT TARGETS (PREVENT 404 AFTER LOGIN)
|--------------------------------------------------------------------------
| Laravel auth commonly redirects to /home or /dashboard after login.
| Your real admin dashboard is /admin/dashboard.
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('home.redirect');

/*
|--------------------------------------------------------------------------
| PUBLIC APPOINTMENT BOOKING (PATIENT SIDE)
|--------------------------------------------------------------------------
*/
Route::get('/appointments', [PublicAppointmentController::class, 'book'])
    ->name('appointments');

Route::post('/appointments', [PublicAppointmentController::class, 'storeWeb'])
    ->name('appointments.store');

Route::get('/appointments/success', [PublicAppointmentController::class, 'success'])
    ->name('appointments.success');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (AUTH PROTECTED)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth'])
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('home');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('patients', PatientController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('visits', VisitController::class);

        /*
        |--------------------------------------------------------------------------
        | ✅ NESTED: Attach imaging services to a visit
        |--------------------------------------------------------------------------
        */
        Route::prefix('visits/{visit}')->group(function () {
            Route::post('imaging-services', [ImagingServiceController::class, 'storeForVisit'])
                ->name('visits.imaging-services.store');

            Route::delete('imaging-services/{imaging_service}', [ImagingServiceController::class, 'destroyForVisit'])
                ->name('visits.imaging-services.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Imaging Services (resource)
        |--------------------------------------------------------------------------
        */
        Route::resource('imaging-services', ImagingServiceController::class);

        /*
        |--------------------------------------------------------------------------
        | ✅ FIX: Missing route used by imaging-services/show.blade.php
        |--------------------------------------------------------------------------
        */
        Route::patch('imaging-services/{imaging_service}/status', [ImagingServiceController::class, 'updateStatus'])
            ->name('imaging-services.update-status');

        /*
        |--------------------------------------------------------------------------
        | Radiology Reports
        |--------------------------------------------------------------------------
        */
        Route::resource('radiology-reports', RadiologyReportController::class);

        /*
        |--------------------------------------------------------------------------
        | ✅ SEND FINAL REPORT TO PATIENT (EMAIL)
        |--------------------------------------------------------------------------
        */
        Route::post('radiology-reports/{radiologyReport}/send', [ReportDeliveryController::class, 'send'])
            ->name('radiology-reports.send');

        /*
        |--------------------------------------------------------------------------
        | ✅ Report Deliveries (ONLY PAGES YOU SUPPORT)
        |--------------------------------------------------------------------------
        */
        Route::resource('report-deliveries', ReportDeliveryController::class)->only(['index', 'show']);

        /*
        |--------------------------------------------------------------------------
        | Appointments (admin side)
        |--------------------------------------------------------------------------
        */
        Route::resource('appointments', AdminAppointmentController::class);

        /*
        |--------------------------------------------------------------------------
        | ✅ Finance (FIXED TO MATCH YOUR FinanceController)
        |--------------------------------------------------------------------------
        */
        // /admin/finance -> FinanceController@dashboard
        Route::get('/finance', [FinanceController::class, 'dashboard'])
            ->name('finance.index');

        // Optional: Daily/Weekly/Monthly/Yearly Reports (you already have these methods)
        Route::get('/finance/reports/daily', [FinanceController::class, 'daily'])
            ->name('finance.reports.daily');

        Route::get('/finance/reports/weekly', [FinanceController::class, 'weekly'])
            ->name('finance.reports.weekly');

        Route::get('/finance/reports/monthly', [FinanceController::class, 'monthly'])
            ->name('finance.reports.monthly');

        Route::get('/finance/reports/yearly', [FinanceController::class, 'yearly'])
            ->name('finance.reports.yearly');
    });

/*
|--------------------------------------------------------------------------
| OPTIONAL CUSTOM 404
|--------------------------------------------------------------------------
*/
// Route::fallback(function () {
//     return response()->view('errors.404', [], 404);
// });
