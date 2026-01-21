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
            ->get([
                'id', 'name', 'code', 'description', 'price',
                'discounted_price', 'duration_minutes', 'icon_class',
                'requires_fasting', 'preparation_instructions'
            ]);

        $services->each(fn ($service) =>
            $service->formatted_price = $service->getFormattedPrice()
        );

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

        if ($date->gt(now()->addDays($service->advance_booking_days))) {
            return response()->json([
                'success' => false,
                'message' => "Bookings are only available up to {$service->advance_booking_days} days in advance."
            ]);
        }

        return response()->json([
            'success' => true,
            'service' => $service->only(['id', 'name', 'duration_minutes']),
            'date' => $date->format('Y-m-d'),
            'available_slots' => $this->getAvailableSlots($service, $date),
            'requires_fasting' => $service->requires_fasting,
        ]);
    }

    protected function getAvailableSlots(Service $service, Carbon $date)
    {
        $workingHours = [
            ['start' => '08:00', 'end' => '12:00'],
            ['start' => '14:00', 'end' => '18:00'],
        ];

        $slots = [];
        $duration = $service->duration_minutes + $service->slot_buffer_minutes;

        foreach ($workingHours as $session) {
            $start = Carbon::parse($session['start']);
            $end = Carbon::parse($session['end']);

            while ($start->copy()->addMinutes($duration)->lte($end)) {
                $time = $start->format('H:i');

                if ($this->isSlotAvailable($service, $date, $time)) {
                    $slots[] = [
                        'time' => $time,
                        'display' => Carbon::parse($time)->format('g:i A'),
                        'is_peak' => $this->isPeakHour($time),
                    ];
                }

                $start->addMinutes($duration);
            }
        }

        return $slots;
    }

    protected function isSlotAvailable(Service $service, Carbon $date, string $time): bool
    {
        return Appointment::where('service_id', $service->id)
            ->whereDate('appointment_date', $date)
            ->whereTime('appointment_time', $time)
            ->whereNotIn('status', ['cancelled'])
            ->count() === 0;
    }

    protected function isPeakHour(string $time): bool
    {
        $hour = (int) explode(':', $time)[0];
        return ($hour >= 9 && $hour <= 11) || ($hour >= 15 && $hour <= 17);
    }

    public function store(StoreAppointmentRequest $request)
    {
        DB::beginTransaction();

        try {
            $service = Service::firstOrCreate(
                ['name' => $request->service],
                [
                    'code' => 'CUST-' . strtoupper(substr($request->service, 0, 3)) . '-' . time(),
                    'category' => 'custom',
                    'price' => 0,
                    'is_active' => false,
                ]
            );

            $date = Carbon::parse($request->appointment_date);

            if (!$this->isSlotAvailable($service, $date, $request->appointment_time)) {
                return response()->json([
                    'success' => false,
                    'message' => 'The selected time slot is no longer available.'
                ], 409);
            }

            $appointment = new Appointment();
            $appointment->appointment_number = $appointment->generateAppointmentNumber();
            $appointment->service_id = $service->id;
            $appointment->service_name = $service->name;
            $appointment->appointment_date = $date;
            $appointment->appointment_time = $request->appointment_time;
            $appointment->patient_name = $request->name;
            $appointment->patient_phone = $request->phone;
            $appointment->patient_email = $request->email;
            $appointment->patient_dob = $request->dob;
            $appointment->reason = $request->reason;
            $appointment->insurance_provider = $request->insurance;
            $appointment->contact_preferences = $request->contact_preferences;
            $appointment->duration_minutes = $service->duration_minutes;

            if (auth()->check() && auth()->user()->user_type === 'patient') {
                $appointment->patient_id = auth()->id();
            }

            $appointment->calculateEstimatedCost();
            $appointment->save();

            DB::commit();

            return response()->json([
                'success' => true,
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
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Appointment creation failed', ['error' => $e]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create appointment.'
            ], 500);
        }
    }
}
