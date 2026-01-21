<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function book()
    {
        return view('appointments.book');
    }

    public function storeWeb(StoreAppointmentRequest $request)
    {
        DB::beginTransaction();

        try {
            Log::info('=== APPOINTMENT REQUEST START ===', $request->all());

            // 1. Create or find service
            $serviceName = $request->service;
            
            // Check if service exists (case-insensitive)
            $service = Service::whereRaw('LOWER(name) = ?', [strtolower($serviceName)])->first();
            
            if (!$service) {
                // Create a custom service with ALL required fields
                $service = Service::create([
                    'name' => $serviceName,
                    'code' => 'CUST-' . strtoupper(substr($serviceName, 0, 3)) . '-' . time(),
                    'category' => 'custom',
                    'description' => 'Custom service created via booking form',
                    'duration_minutes' => 30,
                    'price' => 0,
                    'discounted_price' => 0,
                    'is_active' => true,
                    'preparation_instructions' => [],
                    'post_procedure_care' => [],
                    'insurance_coverage' => [],
                    'contraindications' => [],
                    'icon_class' => 'fas fa-stethoscope',
                    'display_order' => 999,
                    'slot_buffer_minutes' => 0,
                    'requires_radiologist' => false,
                    'requires_fasting' => false,
                    'advance_booking_days' => 30,
                    'cancellation_hours' => 24
                ]);
                
                Log::info('Created new custom service', ['id' => $service->id]);
            }

            Log::info('Service ready', [
                'id' => $service->id,
                'name' => $service->name,
                'price' => $service->price
            ]);

            // 2. Parse date and time
            $date = Carbon::parse($request->appointment_date);
            $time = $request->appointment_time;

            // 3. Create appointment
            $appointment = new Appointment();
            
            // Generate appointment number
            $appointment->appointment_number = $this->generateAppointmentNumber();
            
            // Set basic fields
            $appointment->service_id = $service->id;
            $appointment->service_name = $service->name;
            $appointment->appointment_date = $date;
            $appointment->appointment_time = $time;
            $appointment->patient_name = $request->name;
            $appointment->patient_phone = $request->phone;
            $appointment->patient_email = $request->email;
            
            // Handle optional DOB
            if ($request->filled('dob')) {
                $appointment->patient_dob = Carbon::parse($request->dob);
            }
            
            $appointment->reason = $request->reason;
            $appointment->insurance_provider = $request->insurance;
            
            // Handle contact preferences - fix boolean conversion
            $contactPreferences = [];
            
            // Debug contact preferences
            Log::info('Contact preferences raw:', [
                'whatsapp' => $request->contact_whatsapp,
                'sms' => $request->contact_sms,
                'email' => $request->contact_email,
                'whatsapp_type' => gettype($request->contact_whatsapp)
            ]);
            
            // Convert string "true"/"false" to boolean
            $whatsapp = filter_var($request->contact_whatsapp, FILTER_VALIDATE_BOOLEAN);
            $sms = filter_var($request->contact_sms, FILTER_VALIDATE_BOOLEAN);
            $email = filter_var($request->contact_email, FILTER_VALIDATE_BOOLEAN);
            
            Log::info('Contact preferences converted:', [
                'whatsapp' => $whatsapp,
                'sms' => $sms,
                'email' => $email
            ]);
            
            if ($whatsapp) $contactPreferences['whatsapp'] = true;
            if ($sms) $contactPreferences['sms'] = true;
            if ($email) $contactPreferences['email'] = true;
            
            $appointment->contact_preferences = $contactPreferences;
            
            // Set duration from service or default
            $appointment->duration_minutes = $service->duration_minutes ?? 30;
            
            // Set status and priority
            $appointment->status = 'pending';
            $appointment->priority = 'routine';
            
            // Calculate estimated cost - FIXED: Ensure service relationship exists
            $appointment->service()->associate($service);
            
            // Temporarily disable cost calculation or handle it safely
            try {
                if (method_exists($appointment, 'calculateEstimatedCost')) {
                    $appointment->calculateEstimatedCost();
                } else {
                    $appointment->estimated_cost = 0;
                }
            } catch (\Exception $e) {
                Log::warning('Cost calculation failed, setting to 0', ['error' => $e->getMessage()]);
                $appointment->estimated_cost = 0;
            }
            
            // Set patient ID if user is logged in
            if (auth()->check()) {
                $appointment->patient_id = auth()->id();
            }

            // Save the appointment
            $appointment->save();
            
            Log::info('Appointment saved', [
                'id' => $appointment->id,
                'number' => $appointment->appointment_number
            ]);

            DB::commit();

            // Prepare response
            $responseData = [
                'success' => true,
                'appointment' => [
                    'id' => $appointment->id,
                    'appointment_number' => $appointment->appointment_number,
                    'service' => $appointment->service_name,
                    'date' => $appointment->appointment_date->format('F j, Y'),
                    'time' => Carbon::parse($appointment->appointment_time)->format('g:i A'),
                    'status' => $appointment->status,
                    'estimated_cost' => $appointment->estimated_cost ?? 0,
                ]
            ];

            Log::info('=== APPOINTMENT CREATED SUCCESSFULLY ===', $responseData);

            // Return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
                return response()->json($responseData);
            }

            // Redirect for non-AJAX requests
            return redirect()
                ->route('appointments.success')
                ->with('appointment', (object) $responseData['appointment']);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('=== APPOINTMENT CREATION FAILED ===');
            Log::error('Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Prepare error response
            $errorMessage = 'Failed to create appointment. Please try again.';
            
            // Show detailed error in development
            if (config('app.debug')) {
                $errorMessage = "Error: " . $e->getMessage();
            }

            // Return JSON error for AJAX
            if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 500);
            }

            // Redirect with error for non-AJAX
            return back()->withErrors(['error' => $errorMessage]);
        }
    }

    /**
     * Generate unique appointment number
     */
    private function generateAppointmentNumber()
    {
        $prefix = 'PDI'; // Changed from APT to PDI to match your frontend
        $date = date('Ymd');
        
        // Get today's count
        $count = Appointment::whereDate('created_at', today())->count() + 1;
        
        // Format with leading zeros
        $sequential = str_pad($count, 4, '0', STR_PAD_LEFT);
        
        return "{$prefix}-{$date}-{$sequential}";
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

        $appointments = Appointment::where('patient_id', auth()->id())
            ->with('service')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('appointments.my', compact('appointments'));
    }
}