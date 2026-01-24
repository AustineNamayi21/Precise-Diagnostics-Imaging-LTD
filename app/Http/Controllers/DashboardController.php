<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\RadiologyReport;
use App\Models\ServiceRecord;
use App\Models\ImagingService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Initialize stats with defaults
        $stats = [
            'total_patients' => 0,
            'active_patients' => 0,
            'today_visits' => 0,
            'upcoming_visits' => 0,
            'pending_reports' => 0,
            'reports_to_send' => 0,
            'recent_reports' => 0,
        ];

        // Get stats if models exist
        try {
            if (class_exists(Patient::class)) {
                $stats['total_patients'] = Patient::count();
                $stats['active_patients'] = Patient::where('status', 'active')->count();
            }
            
            if (class_exists(PatientVisit::class)) {
                $stats['today_visits'] = PatientVisit::whereDate('visit_date', Carbon::today())->count();
                $stats['upcoming_visits'] = PatientVisit::whereDate('visit_date', '>', Carbon::today())->count();
            }
            
            if (class_exists(RadiologyReport::class)) {
                $stats['pending_reports'] = RadiologyReport::where('status', 'draft')->count();
                $stats['reports_to_send'] = RadiologyReport::where('sent_to_patient', false)->count();
                $stats['recent_reports'] = RadiologyReport::where('created_at', '>=', Carbon::now()->subDays(7))->count();
            }
        } catch (\Exception $e) {
            // Models or tables might not exist yet, use defaults
        }

        // Initialize empty collections
        $recentVisits = collect([]);
        $todaysAppointments = collect([]);
        $pendingReports = collect([]);
        $modalityStats = collect([]);

        // Get data if models exist
        try {
            if (class_exists(PatientVisit::class)) {
                $recentVisits = PatientVisit::with('patient')
                    ->latest()
                    ->take(5)
                    ->get();
                    
                $todaysAppointments = PatientVisit::with('patient')
                    ->whereDate('visit_date', Carbon::today())
                    ->orderBy('visit_time')
                    ->get();
            }
            
            if (class_exists(RadiologyReport::class)) {
                $pendingReports = RadiologyReport::with(['serviceRecord.visit.patient', 'radiologist'])
                    ->where('status', 'draft')
                    ->latest()
                    ->take(10)
                    ->get();
            }
            
            if (class_exists(ServiceRecord::class) && class_exists(ImagingService::class)) {
                $modalityStats = ServiceRecord::with('service')
                    ->selectRaw('count(*) as count, imaging_services.category as modality')
                    ->join('imaging_services', 'service_records.imaging_service_id', '=', 'imaging_services.id')
                    ->whereDate('service_records.created_at', '>=', Carbon::now()->subDays(30))
                    ->groupBy('imaging_services.category')
                    ->get();
            }
        } catch (\Exception $e) {
            // Skip if there are errors (tables might not exist yet)
        }

        return view('dashboard', compact(
            'stats', 
            'recentVisits', 
            'todaysAppointments',
            'pendingReports',
            'modalityStats'
        ));
    }
}