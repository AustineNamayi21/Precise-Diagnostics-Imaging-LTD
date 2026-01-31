<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Finance/Billing controllers
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\InvoicePaymentController;

// Notices
use App\Http\Controllers\Admin\NoticeController;

use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------|
| PUBLIC WEBSITE ROUTES (NO AUTH REQUIRED)
|--------------------------------------------------------------------------|
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
|--------------------------------------------------------------------------|
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------|
*/
Auth::routes();

/*
|--------------------------------------------------------------------------|
| AUTH REDIRECT TARGETS
|--------------------------------------------------------------------------|
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('home.redirect');

/*
|--------------------------------------------------------------------------|
| PUBLIC APPOINTMENT BOOKING
|--------------------------------------------------------------------------|
*/
Route::get('/appointments', [PublicAppointmentController::class, 'book'])->name('appointments');
Route::post('/appointments', [PublicAppointmentController::class, 'storeWeb'])->name('appointments.store');
Route::get('/appointments/success', [PublicAppointmentController::class, 'success'])->name('appointments.success');

/*
|--------------------------------------------------------------------------|
| ADMIN ROUTES (AUTH PROTECTED)
|--------------------------------------------------------------------------|
*/
Route::prefix('admin')
    ->middleware(['auth'])
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('home');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Editable Notices
        Route::resource('notices', NoticeController::class)->only(['index','store','update','destroy']);

        Route::resource('patients', PatientController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('visits', VisitController::class);

        // Billing
        Route::post('visits/{visit}/billing/sync', [BillingController::class, 'sync'])->name('billing.sync');
        Route::post('invoices/{invoice}/payments', [InvoicePaymentController::class, 'store'])->name('invoices.payments.store');

        // Attach imaging services to visit
        Route::prefix('visits/{visit}')->group(function () {
            Route::post('imaging-services', [ImagingServiceController::class, 'storeForVisit'])
                ->name('visits.imaging-services.store');

            Route::delete('imaging-services/{imaging_service}', [ImagingServiceController::class, 'destroyForVisit'])
                ->name('visits.imaging-services.destroy');
        });

        Route::resource('imaging-services', ImagingServiceController::class);

        Route::patch('imaging-services/{imaging_service}/status', [ImagingServiceController::class, 'updateStatus'])
            ->name('imaging-services.update-status');

        Route::resource('radiology-reports', RadiologyReportController::class);

        Route::post('radiology-reports/{radiologyReport}/send', [ReportDeliveryController::class, 'send'])
            ->name('radiology-reports.send');

        Route::resource('report-deliveries', ReportDeliveryController::class)->only(['index', 'show']);

        Route::resource('appointments', AdminAppointmentController::class);

        // Finance
        Route::get('/finance', [FinanceController::class, 'dashboard'])->name('finance.index');
        Route::get('/finance/reports/daily', [FinanceController::class, 'daily'])->name('finance.reports.daily');
        Route::get('/finance/reports/weekly', [FinanceController::class, 'weekly'])->name('finance.reports.weekly');
        Route::get('/finance/reports/monthly', [FinanceController::class, 'monthly'])->name('finance.reports.monthly');
        Route::get('/finance/reports/yearly', [FinanceController::class, 'yearly'])->name('finance.reports.yearly');
    });
