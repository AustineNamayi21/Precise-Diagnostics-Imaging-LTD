<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function book()
    {
        return view('appointments.book');
    }

    public function storeWeb(StoreAppointmentRequest $request)
    {
        $appointmentController = new \App\Http\Controllers\AppointmentController();
        $response = $appointmentController->store($request);

        if ($response->getData()->success) {
            return redirect()->route('appointments.success')
                ->with('appointment', (object) $response->getData()->appointment);
        }

        return back()->withErrors(['error' => $response->getData()->message ?? 'Failed to book appointment']);
    }

    public function success(Request $request)
    {
        if (!$request->session()->has('appointment')) {
            return redirect()->route('appointments');
        }

        return view('appointments.success', [
            'appointment' => $request->session()->get('appointment'),
        ]);
    }

    public function myAppointments()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $appointments = \App\Models\Appointment::where('patient_id', auth()->id())
            ->with('service')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('appointments.my', compact('appointments'));
    }
}