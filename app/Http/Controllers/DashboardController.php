<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\RadiologyReport;
use App\Models\ServiceRecord;
use App\Models\ImagingService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'total_patients' => Patient::count(),
            'active_patients' => Patient::active()->count(),
            'today_visits' => PatientVisit::today()->count(),
            'upcoming_visits' => PatientVisit::whereDate('visit_date', '>=', today())
                ->where('status', 'scheduled')
                ->count(),
            'pending_reports' => RadiologyReport::where('status', 'draft')->count(),
            'reports_to_send' => RadiologyReport::where('status', 'finalized')
                ->where('sent_to_patient', false)
                ->count(),
            'recent_reports' => RadiologyReport::where('status', 'finalized')
                ->whereDate('created_at', '>=', now()->subDays(7))
                ->count(),
        ];

        $recentVisits = PatientVisit::with(['patient', 'radiographer'])
            ->latest()
            ->take(8)
            ->get();

        $pendingReports = RadiologyReport::with(['serviceRecord.visit.patient', 'radiologist'])
            ->where('status', 'draft')
            ->latest()
            ->take(6)
            ->get();

        $todaysAppointments = PatientVisit::with(['patient'])
            ->whereDate('visit_date', today())
            ->whereIn('status', ['scheduled', 'in_progress'])
            ->orderBy('visit_time')
            ->get();

        $modalityStats = ServiceRecord::with('service')
            ->selectRaw('count(*) as count, imaging_services.modality')
            ->join('imaging_services', 'service_records.imaging_service_id', '=', 'imaging_services.id')
            ->whereDate('service_records.created_at', '>=', now()->subDays(30))
            ->groupBy('imaging_services.modality')
            ->get();

        return view('dashboard', compact(
            'stats', 
            'recentVisits', 
            'pendingReports', 
            'todaysAppointments',
            'modalityStats'
        ));
    }
}