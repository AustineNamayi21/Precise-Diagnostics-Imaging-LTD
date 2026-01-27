<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RadiologyReport;
use App\Models\Visit;
use App\Models\ImagingService;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // KPI counts
        $patientsCount = Patient::count();
        $visitsToday   = Visit::whereDate('visit_date', $today)->count();

        $imagingToday  = ImagingService::whereDate('created_at', $today)->count();

        $draftReports  = RadiologyReport::where('status', 'draft')->count();
        $finalReports  = RadiologyReport::where('status', 'final')->count();

        // Revenue today from payments table
        $revenueToday = (float) DB::table('payments')
            ->whereDate('paid_at', $today)
            ->sum('amount');

        // Recent public bookings (appointments table)
        $recentAppointments = DB::table('appointments')
            ->orderByDesc('appointment_date')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        // Recent reports with patient + service context
        $recentReports = RadiologyReport::query()
            ->with(['imagingService.visit.patient', 'imagingService.service'])
            ->orderByDesc('updated_at')
            ->limit(8)
            ->get();

        return view('admin.dashboard.index', compact(
            'patientsCount',
            'visitsToday',
            'imagingToday',
            'draftReports',
            'finalReports',
            'revenueToday',
            'recentAppointments',
            'recentReports'
        ));
    }
}
