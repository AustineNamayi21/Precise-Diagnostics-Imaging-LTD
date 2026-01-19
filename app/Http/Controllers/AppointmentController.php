<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function getServices()
    {
        $services = Service::active()
            ->orderBy('display_order')
            ->get(['id', 'name', 'code', 'description', 'price', 
                  'discounted_price', 'duration_minutes', 'icon_class', 
                  'requires_fasting', 'preparation_instructions']);

        $services->each(function ($service) {
            $service->formatted_price = $service->getFormattedPrice();
        });

        return response()->json([
            'success' => true,
            'services' => $services
        ]);
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $service = Service::findOrFail($request->service_id);
        $date = Carbon::parse($request->date);

        $maxAdvanceDate = now()->addDays($service->advance_booking_days);
        if ($date->gt($maxAdvanceDate)) {
            return response()->json([
                'success' => false,
                'message' => "Bookings for this service are only available up to {$service->advance_booking_days} days in advance."
            ]);
        }

        $availableSlots = $this->getAvailableSlots($service, $date);

        return response()->json([
            'success' => true,
            'service' => $service->only(['id', 'name', 'duration_minutes']),
            'date' => $date->format('Y-m-d'),
            'available_slots' => $availableSlots,
            'max_advance_days' => $service->advance_booking_days,
            'requires_fasting' => $service->requires_fasting,
        ]);
    }

    protected function getAvailableSlots(Service $service, Carbon $date)
    {
        $workingHours = [
            ['start' => '08:00', 'end' => '12:00'],
            ['start' => '14:00', 'end' => '18:00'],
        ];

        $availableSlots = [];
        $duration = $service->duration_minutes + $service->slot_buffer_minutes;

        foreach ($workingHours as $session) {
            $start = Carbon::parse($session['start']);
            $end = Carbon::parse($session['end']);

            while ($start->addMinutes($duration)->lte($end)) {
                $slotTime = $start->format('H:i');
                
                if ($this->isSlotAvailable($service, $date, $slotTime)) {
                    $availableSlots[] = [
                        'time' => $slotTime,
                        'display' => Carbon::parse($slotTime)->format('g:i A'),
                        'is_peak' => $this->isPeakHour($slotTime),
                    ];
                }
            }
        }

        return $availableSlots;
    }

    protected function isSlotAvailable(Service $service, Carbon $date, $time)
    {
        $existingAppointments = Appointment::where('service_id', $service->id)
            ->whereDate('appointment_date', $date)
            ->whereTime('appointment_time', $time)
            ->whereNotIn('status', ['cancelled'])
            ->count();

        return $existingAppointments === 0;
    }

    protected function isPeakHour($time)
    {
        $hour = (int) explode(':', $time)[0];
        return ($hour >= 9 && $hour <= 11) || ($hour >= 15 && $hour <= 17);
    }

    public function store(StoreAppointmentRequest $request)
    {
        DB::beginTransaction();

        try {
            $service = Service::where('name', $request->service)->first();
            
            if (!$service) {
                $service = Service::create([
                    'name' => $request->service,
                    'code' => 'CUST-' . strtoupper(substr($request->service, 0, 3)) . '-' . time(),
                    'category' => 'custom',
                    'price' => 0,
                    'is_active' => false,
                ]);
            }

            if (!$this->isSlotAvailable($service, $request->appointment_date, $request->appointment_time)) {
                return response()->json([
                    'success' => false,
                    'message' => 'The selected time slot is no longer available. Please choose another time.'
                ], 409);
            }

            $appointment = new Appointment();
            $appointment->appointment_number = $appointment->generateAppointmentNumber();
            $appointment->service_id = $service->id;
            $appointment->service_name = $service->name;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->appointment_time = $request->appointment_time;
            $appointment->patient_name = $request->name;
            $appointment->patient_phone = $request->phone;
            $appointment->patient_email = $request->email;
            $appointment->patient_dob = $request->dob;
            $appointment->reason = $request->reason;
            $appointment->insurance_provider = $request->insurance;
            $appointment->contact_preferences = $request->contact_preferences;
            $appointment->duration_minutes = $service->duration_minutes;
            $appointment->calculateEstimatedCost();
            
            if (auth()->check() && auth()->user()->user_type === 'patient') {
                $appointment->patient_id = auth()->id();
            }

            $appointment->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Appointment request submitted successfully',
                'appointment' => [
                    'id' => $appointment->id,
                    'appointment_number' => $appointment->appointment_number,
                    'service' => $appointment->service_name,
                    'date' => $appointment->appointment_date->format('F j, Y'),
                    'time' => Carbon::parse($appointment->appointment_time)->format('g:i A'),
                    'status' => $appointment->status,
                    'estimated_cost' => $appointment->estimated_cost,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Appointment creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to create appointment. Please try again or contact support.'
            ], 500);
        }
    }

    public function show($id)
    {
        $appointment = Appointment::with(['service', 'radiologist'])
            ->findOrFail($id);

        if (auth()->check()) {
            if (auth()->user()->user_type === 'patient' && $appointment->patient_id !== auth()->id()) {
                abort(403);
            }
        }

        return response()->json([
            'success' => true,
            'appointment' => $appointment
        ]);
    }

    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancellation_reason' => 'required|string|max:500'
        ]);

        $appointment = Appointment::findOrFail($id);

        if (auth()->check()) {
            if (auth()->user()->user_type === 'patient' && $appointment->patient_id !== auth()->id()) {
                abort(403);
            }
        }

        $appointment->status = 'cancelled';
        $appointment->cancellation_reason = $request->cancellation_reason;
        $appointment->cancelled_at = now();
        $appointment->save();

        return response()->json([
            'success' => true,
            'message' => 'Appointment cancelled successfully'
        ]);
    }

    public function patientAppointments()
    {
        if (!auth()->check() || auth()->user()->user_type !== 'patient') {
            abort(403);
        }

        $appointments = Appointment::where('patient_id', auth()->id())
            ->with('service')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'appointments' => $appointments
        ]);
    }
}