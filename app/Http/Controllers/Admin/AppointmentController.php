<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('appointments')->orderByDesc('appointment_date')->orderByDesc('id');

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('appointment_date', '>=', $request->string('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('appointment_date', '<=', $request->string('date_to'));
        }

        if ($request->filled('q')) {
            $q = '%' . $request->string('q') . '%';
            $query->where(function ($w) use ($q) {
                $w->where('appointment_number', 'like', $q)
                    ->orWhere('patient_name', 'like', $q)
                    ->orWhere('patient_phone', 'like', $q)
                    ->orWhere('patient_email', 'like', $q)
                    ->orWhere('service_name', 'like', $q);
            });
        }

        $appointments = $query->paginate(20)->withQueryString();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(int $appointment)
    {
        $appointment = DB::table('appointments')->where('id', $appointment)->first();
        abort_if(!$appointment, 404, 'Appointment not found');

        return view('admin.appointments.show', compact('appointment'));
    }
}
