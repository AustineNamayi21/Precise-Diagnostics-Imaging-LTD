@extends('layouts.app')

@section('title', 'Book Appointment | Precise Diagnostics')

@section('content')
<!-- Hero Section with animation -->
<section class="medical-gradient text-white py-16" id="heroSection">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-6 animate-fade-in">Book Your Appointment</h1>
            <p class="text-xl opacity-90 animate-fade-in-delay">Easy and secure online booking</p>
            
            <!-- Progress Steps with animation -->
            <div class="flex justify-center mt-12 animate-slide-up">
                <div class="flex items-center">
                    <div class="step active">
                        <div class="step-number">1</div>
                        <div class="step-label">Service</div>
                    </div>
                    <div class="step-connector"></div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-label">Time</div>
                    </div>
                    <div class="step-connector"></div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-label">Details</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Booking Container -->
<section class="py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            
            <!-- Step 1: Service Selection -->
            <div id="step1" class="booking-step active">
                <div class="step-header">
                    <h2 class="text-2xl font-bold mb-2 animate-fade-in">Select Imaging Service</h2>
                    <p class="text-gray-600 animate-fade-in-delay">Choose the scan or service you need</p>
                </div>
                
                <!-- Service Grid with staggered animation -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8" id="serviceGrid">
                    @foreach(['MRI Scanning', 'MR Spectroscopy', 'CT Scanning', 'Ultrasound Scan', 'Fluoroscopy', 'ECG Scan', 'General X-Ray', 'Echocardiography (Echo)', 'EEG', 'Nerve Conduction Test'] as $index => $service)
                    <div class="service-option animate-stagger" data-service="{{ $service }}" data-index="{{ $index }}">
                        <div class="flex items-center">
                            <div class="service-icon">
                                @switch($service)
                                    @case('MRI Scanning') <i class="fas fa-mri"></i> @break
                                    @case('CT Scanning') <i class="fas fa-ct-scan"></i> @break
                                    @case('Ultrasound Scan') <i class="fas fa-ultrasound"></i> @break
                                    @case('ECG Scan') <i class="fas fa-heartbeat"></i> @break
                                    @case('General X-Ray') <i class="fas fa-x-ray"></i> @break
                                    @default <i class="fas fa-stethoscope"></i>
                                @endswitch
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold text-lg">{{ $service }}</h3>
                            </div>
                        </div>
                        <button class="select-service-btn" onclick="selectService('{{ $service }}', this)">
                            Select
                        </button>
                    </div>
                    @endforeach
                </div>
                
                <!-- Custom Service Option -->
                <div class="mt-8 animate-fade-in-delay">
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 hover-lift">
                        <h3 class="font-bold text-lg mb-3">Don't see your service?</h3>
                        <div class="flex">
                            <input type="text" id="customService" placeholder="Enter service name" class="flex-grow p-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition">
                            <button onclick="selectCustomService()" class="bg-blue-600 text-white px-6 rounded-r-lg font-medium hover:bg-blue-700 active:scale-95 transition-all duration-200">
                                Select Custom
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <button onclick="nextStep(2)" class="next-step-btn pulse-once" disabled id="nextStep1">
                        Next: Choose Time <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
            
            <!-- Step 2: Date & Time Selection -->
            <div id="step2" class="booking-step hidden">
                <div class="step-header">
                    <h2 class="text-2xl font-bold mb-2">Select Date & Time</h2>
                    <p class="text-gray-600">Choose your preferred appointment slot</p>
                </div>
                
                <!-- Selected Service Display -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 bounce-in">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-600">Selected Service:</span>
                            <span class="font-bold ml-2" id="displayService">Not selected</span>
                        </div>
                        <button onclick="prevStep(1)" class="text-blue-600 text-sm font-medium hover:text-blue-800 transition">
                            <i class="fas fa-edit mr-1"></i> Change
                        </button>
                    </div>
                </div>
                
                <!-- Date Selection -->
                <div class="mb-8">
                    <h3 class="font-bold text-lg mb-4">Select Date</h3>
                    <div class="grid grid-cols-7 gap-2 mb-4" id="calendarGrid">
                        <div class="calendar-header">Sun</div>
                        <div class="calendar-header">Mon</div>
                        <div class="calendar-header">Tue</div>
                        <div class="calendar-header">Wed</div>
                        <div class="calendar-header">Thu</div>
                        <div class="calendar-header">Fri</div>
                        <div class="calendar-header">Sat</div>
                        
                        <!-- Empty cells for day alignment -->
                        @for($i = 0; $i < date('w', strtotime('first day of this month')); $i++)
                            <div class="calendar-day empty"></div>
                        @endfor
                        
                        <!-- Days of the month -->
                        @for($day = 1; $day <= date('t'); $day++)
                            <div class="calendar-day animate-pop-in" data-date="{{ date('Y-m-') . sprintf('%02d', $day) }}" style="animation-delay: {{ $day * 0.03 }}s">
                                <div class="day-number">{{ $day }}</div>
                                @if($day == date('j'))
                                    <div class="day-label">Today</div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Time Selection -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Select Time</h3>
                    <p class="text-gray-600 mb-4">Morning Sessions (8:00 AM - 12:00 PM)</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6" id="morningSlots">
                        @foreach(['08:00', '09:00', '10:00', '11:00'] as $index => $time)
                        <div class="time-slot animate-slide-up" data-time="{{ $time }}" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="time">{{ $time }} AM</div>
                            <div class="slot-status">Available</div>
                        </div>
                        @endforeach
                    </div>
                    
                    <p class="text-gray-600 mb-4">Afternoon Sessions (2:00 PM - 6:00 PM)</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3" id="afternoonSlots">
                        @foreach(['14:00', '15:00', '16:00', '17:00'] as $index => $time)
                        <div class="time-slot animate-slide-up" data-time="{{ $time }}" style="animation-delay: {{ (4 + $index) * 0.1 }}s">
                            <div class="time">{{ str_replace(':00', '', $time) }} PM</div>
                            <div class="slot-status">Available</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- No availability message -->
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4 hidden" id="noAvailabilityMsg">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle text-yellow-600 mr-3 animate-pulse"></i>
                        <div>
                            <div class="font-bold">No real-time availability shown</div>
                            <div class="text-sm text-yellow-700">Availability will be confirmed after you submit your request</div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-between">
                    <button onclick="prevStep(1)" class="prev-step-btn hover-lift">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </button>
                    <button onclick="nextStep(3)" class="next-step-btn pulse-once" disabled id="nextStep2">
                        Next: Your Details <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
            
            <!-- Step 3: Patient Details -->
            <div id="step3" class="booking-step hidden">
                <div class="step-header">
                    <h2 class="text-2xl font-bold mb-2">Your Details</h2>
                    <p class="text-gray-600">Please provide your information</p>
                </div>
                
                <!-- Appointment Summary -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8 shake-on-appear">
                    <h3 class="font-bold text-lg mb-4">Appointment Request</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Service:</span>
                            <span class="font-bold" id="finalService">Not selected</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-bold" id="finalDate">Not selected</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Time:</span>
                            <span class="font-bold" id="finalTime">Not selected</span>
                        </div>
                    </div>
                </div>
                
                <!-- Patient Form -->
                <form id="appointmentForm" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" required class="form-input focus-scale" placeholder="John Doe">
                        </div>
                        
                        <div>
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" required class="form-input focus-scale" placeholder="+254 712 345 678">
                        </div>
                        
                        <div>
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-input focus-scale" placeholder="john@example.com">
                        </div>
                        
                        <div>
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-input focus-scale">
                        </div>
                    </div>
                    
                    <div>
                        <label class="form-label">Reason for Appointment</label>
                        <textarea name="reason" class="form-textarea focus-scale" placeholder="Briefly describe why you need this scan..." rows="3"></textarea>
                    </div>
                    
                    <div>
                        <label class="form-label">Insurance Provider (Optional)</label>
                        <select name="insurance" class="form-input focus-scale">
                            <option value="">Select insurance</option>
                            <option value="nhif">NHIF</option>
                            <option value="jubilee">Jubilee Insurance</option>
                            <option value="apa">APA Insurance</option>
                            <option value="aar">AAR Insurance</option>
                            <option value="other">Other</option>
                            <option value="none">No Insurance</option>
                        </select>
                    </div>
                    
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 hover-lift">
                        <h3 class="font-bold text-lg mb-4">How would you like to be contacted?</h3>
                        <div class="space-y-3">
                            <label class="flex items-center checkbox-animate">
                                <input type="checkbox" name="contact_whatsapp" class="form-checkbox" checked>
                                <span class="ml-2">WhatsApp</span>
                            </label>
                            <label class="flex items-center checkbox-animate">
                                <input type="checkbox" name="contact_sms" class="form-checkbox" checked>
                                <span class="ml-2">SMS</span>
                            </label>
                            <label class="flex items-center checkbox-animate">
                                <input type="checkbox" name="contact_email" class="form-checkbox">
                                <span class="ml-2">Email</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex items-start checkbox-animate">
                        <input type="checkbox" name="terms" required class="form-checkbox mt-1">
                        <span class="ml-2 text-gray-700">I agree to the terms and conditions and understand this is a booking request that will be confirmed by our staff</span>
                    </div>
                </form>
                
                <div class="mt-8 flex justify-between">
                    <button onclick="prevStep(2)" class="prev-step-btn hover-lift">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </button>
                    <button onclick="submitAppointmentBackend()" class="submit-btn pulse-once">
                        <i class="fas fa-paper-plane mr-2"></i> Submit Booking Request
                    </button>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Success Modal with confetti -->
<div id="successModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8">
        <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
                <i class="fas fa-check text-green-600 text-2xl"></i>
            </div>
            
            <h3 class="text-2xl font-bold mb-4">Request Submitted!</h3>
            
            <div class="space-y-4 mb-6">
                <p class="text-gray-600">
                    Your appointment request has been received. Our team will contact you within 2 hours to confirm availability and finalize your booking.
                </p>
                
                <div class="bg-gray-50 rounded-xl p-4 text-left">
                    <div class="font-bold text-sm text-gray-600 mb-2">Request Reference:</div>
                    <div class="font-mono font-bold animate-typewriter" id="referenceDisplay">PDI-{{ date('Ymd') }}-0000</div>
                </div>
            </div>
            
            <div class="space-y-3">
                <button onclick="closeSuccessModal()" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 active:scale-95 transition-all duration-200">
                    Done
                </button>
                <button onclick="window.location.href='/'" class="w-full border border-gray-300 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-50 active:scale-95 transition-all duration-200">
                    Back to Homepage
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Confetti container -->
<div id="confetti-container"></div>

<style>
    /* Animation Classes */
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out;
    }
    
    .animate-fade-in-delay {
        animation: fadeIn 0.8s ease-out 0.3s both;
    }
    
    .animate-slide-up {
        animation: slideUp 0.6s ease-out;
    }
    
    .animate-pop-in {
        animation: popIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    .animate-stagger {
        opacity: 0;
        transform: translateY(20px);
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    .shake-on-appear {
        animation: gentleShake 0.5s ease-out 0.3s;
    }
    
    /* Button Animations */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    
    .pulse-once {
        animation: pulseOnce 2s infinite;
    }
    
    /* Focus effects */
    .focus-scale:focus {
        transform: scale(1.01);
        transition: transform 0.2s ease;
    }
    
    .checkbox-animate {
        transition: transform 0.2s ease;
    }
    
    .checkbox-animate:hover {
        transform: translateX(5px);
    }
    
    /* Ripple effect for buttons */
    .ripple {
        position: relative;
        overflow: hidden;
    }
    
    .ripple:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }
    
    .ripple:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }
    
    /* Keyframe Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        70% {
            transform: scale(1.05);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
        }
    }
    
    @keyframes pulseOnce {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
        }
    }
    
    @keyframes gentleShake {
        0%, 100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-2px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(2px);
        }
    }
    
    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(40, 40);
            opacity: 0;
        }
    }
    
    @keyframes typewriter {
        from {
            width: 0;
        }
        to {
            width: 100%;
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
    /* Confetti */
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        opacity: 0;
        animation: confettiFall 3s linear forwards;
    }
    
    @keyframes confettiFall {
        0% {
            transform: translateY(-100px) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(1000px) rotate(720deg);
            opacity: 0;
        }
    }
    
    /* Progress Steps */
    .step {
        @apply flex flex-col items-center;
    }
    
    .step-number {
        @apply w-10 h-10 rounded-full bg-white/20 text-white font-bold flex items-center justify-center text-lg mb-2 transition-all duration-500;
    }
    
    .step.active .step-number {
        @apply bg-white text-blue-600 scale-110;
    }
    
    .step-label {
        @apply text-sm font-medium text-white transition-all duration-300;
    }
    
    .step-connector {
        @apply w-12 h-1 bg-white/20 mx-2 mt-5 transition-all duration-500;
    }
    
    .step.active + .step-connector {
        @apply bg-white/40;
    }
    
    /* Booking Steps */
    .booking-step {
        @apply hidden;
    }
    
    .booking-step.active {
        @apply block;
    }
    
    .step-header {
        @apply mb-8;
    }
    
    /* Service Options */
    .service-option {
        @apply bg-white border border-gray-200 rounded-xl p-6 flex justify-between items-center transition-all duration-300;
    }
    
    .service-option:hover {
        @apply border-blue-400 shadow-md transform -translate-y-1;
    }
    
    .service-option.selected {
        @apply border-2 border-blue-500 bg-blue-50 shadow-lg transform scale-[1.02];
        animation: selectedPulse 2s infinite;
    }
    
    @keyframes selectedPulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }
    }
    
    .service-icon {
        @apply w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl text-blue-600 transition-all duration-300;
    }
    
    .service-option.selected .service-icon {
        @apply bg-blue-500 text-white scale-110;
        animation: rotate 1s ease;
    }
    
    .select-service-btn {
        @apply bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 relative overflow-hidden ripple;
    }
    
    .select-service-btn:hover {
        @apply bg-blue-700 transform scale-105;
    }
    
    .select-service-btn:active {
        @apply transform scale-95;
    }
    
    /* Calendar */
    .calendar-header {
        @apply text-center text-gray-600 font-medium py-2 text-sm;
    }
    
    .calendar-day {
        @apply aspect-square border border-gray-200 rounded-lg p-2 flex flex-col items-center justify-center cursor-pointer transition-all duration-200;
    }
    
    .calendar-day.empty {
        @apply border-none;
    }
    
    .calendar-day:hover:not(.empty) {
        @apply border-blue-400 bg-blue-50 transform scale-105;
    }
    
    .calendar-day.selected {
        @apply border-2 border-blue-500 bg-blue-50 shadow-inner;
        animation: bounceIn 0.5s;
    }
    
    .day-number {
        @apply font-bold;
    }
    
    .day-label {
        @apply text-xs text-gray-500 mt-1;
    }
    
    /* Time Slots */
    .time-slot {
        @apply border border-gray-300 rounded-lg p-4 text-center cursor-pointer transition-all duration-200;
    }
    
    .time-slot:hover {
        @apply border-blue-400 bg-blue-50 transform scale-105;
    }
    
    .time-slot.selected {
        @apply border-2 border-blue-500 bg-blue-50 shadow-inner;
        animation: popIn 0.3s;
    }
    
    .time {
        @apply font-bold text-lg;
    }
    
    .slot-status {
        @apply text-sm text-gray-600 mt-1;
    }
    
    /* Form Elements */
    .form-label {
        @apply block text-gray-700 mb-2 font-medium;
    }
    
    .form-input {
        @apply w-full p-3 border border-gray-300 rounded-lg transition-all duration-200;
    }
    
    .form-input:focus {
        @apply border-blue-500 ring-2 ring-blue-200;
    }
    
    .form-textarea {
        @apply w-full p-3 border border-gray-300 rounded-lg transition-all duration-200;
    }
    
    .form-textarea:focus {
        @apply border-blue-500 ring-2 ring-blue-200;
    }
    
    .form-checkbox {
        @apply rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all duration-200;
    }
    
    .form-checkbox:checked {
        @apply bg-blue-600;
        animation: popIn 0.2s;
    }
    
    /* Buttons */
    .next-step-btn {
        @apply bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 relative overflow-hidden ripple;
    }
    
    .next-step-btn:hover:not(:disabled) {
        @apply bg-blue-700 transform scale-105;
    }
    
    .next-step-btn:active:not(:disabled) {
        @apply transform scale-95;
    }
    
    .next-step-btn:disabled {
        @apply bg-gray-300 cursor-not-allowed;
    }
    
    .prev-step-btn {
        @apply border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition-all duration-200 relative overflow-hidden ripple;
    }
    
    .prev-step-btn:hover {
        @apply bg-gray-50 transform scale-105;
    }
    
    .prev-step-btn:active {
        @apply transform scale-95;
    }
    
    .submit-btn {
        @apply bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 relative overflow-hidden ripple;
    }
    
    .submit-btn:hover {
        @apply bg-green-700 transform scale-105;
    }
    
    .submit-btn:active {
        @apply transform scale-95;
    }
</style>

<script>
    // ================ FRONTEND BOOKING LOGIC ================
    
    // Booking state
    let bookingState = {
        service: null,
        date: null,
        time: null,
        step: 1
    };

    // Initialize with animations
    document.addEventListener('DOMContentLoaded', function() {
        // Initial animations
        animateHeroSection();
        animateServiceGrid();
        showStep(1);
        
        // Initialize calendar
        initCalendar();
        
        // Show no availability message with animation
        setTimeout(() => {
            document.getElementById('noAvailabilityMsg').classList.remove('hidden');
        }, 1000);
        
        // Add ripple effects to all buttons
        addRippleEffects();
        
        // Add floating animation to hero
        startFloatingAnimation();
        
        // Debug: Log available routes
        console.log('Appointment routes available:');
        console.log('POST /appointments (with X-Requested-With: XMLHttpRequest header)');
    });

    // Animate hero section
    function animateHeroSection() {
        const hero = document.getElementById('heroSection');
        hero.style.opacity = '0';
        hero.style.transform = 'translateY(-20px)';
        
        setTimeout(() => {
            hero.style.transition = 'all 0.8s ease-out';
            hero.style.opacity = '1';
            hero.style.transform = 'translateY(0)';
        }, 300);
    }

    // Animate service grid with staggered effect
    function animateServiceGrid() {
        const serviceOptions = document.querySelectorAll('.service-option.animate-stagger');
        serviceOptions.forEach((option, index) => {
            setTimeout(() => {
                option.style.opacity = '1';
                option.style.transform = 'translateY(0)';
                option.style.transition = 'all 0.5s ease-out';
            }, index * 100);
        });
    }

    // Add ripple effect to buttons
    function addRippleEffects() {
        document.querySelectorAll('.ripple').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.7);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    top: ${y}px;
                    left: ${x}px;
                    pointer-events: none;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }

    // Add CSS for ripple animation
    const rippleStyle = document.createElement('style');
    rippleStyle.textContent = `
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(rippleStyle);

    // Floating animation for hero elements
    function startFloatingAnimation() {
        const elements = document.querySelectorAll('.step-number');
        elements.forEach((el, index) => {
            el.style.animation = `float 3s ease-in-out ${index * 0.5}s infinite`;
        });
    }

    // Step Navigation with animations
    function showStep(stepNumber) {
        // Hide current step with animation
        const currentStep = document.getElementById('step' + bookingState.step);
        if (currentStep) {
            currentStep.style.opacity = '0';
            currentStep.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                currentStep.classList.remove('active');
                currentStep.classList.add('hidden');
                currentStep.style.opacity = '';
                currentStep.style.transform = '';
                
                // Show new step with animation
                const nextStep = document.getElementById('step' + stepNumber);
                nextStep.classList.remove('hidden');
                nextStep.classList.add('active');
                nextStep.style.opacity = '0';
                nextStep.style.transform = 'translateX(20px)';
                
                setTimeout(() => {
                    nextStep.style.transition = 'all 0.5s ease-out';
                    nextStep.style.opacity = '1';
                    nextStep.style.transform = 'translateX(0)';
                    
                    // Animate elements in new step
                    if (stepNumber === 2) {
                        animateCalendar();
                        animateTimeSlots();
                    } else if (stepNumber === 3) {
                        animateFormElements();
                    }
                }, 50);
            }, 300);
        }
        
        // Update progress steps with animation
        document.querySelectorAll('.step').forEach((step, index) => {
            if (index + 1 <= stepNumber) {
                setTimeout(() => {
                    step.classList.add('active');
                }, index * 200);
            } else {
                step.classList.remove('active');
            }
        });
        
        bookingState.step = stepNumber;
        updateStepButtons();
    }

    function nextStep(step) {
        if (validateStep(bookingState.step)) {
            showStep(step);
        }
    }

    function prevStep(step) {
        showStep(step);
    }

    // Animate calendar days
    function animateCalendar() {
        const days = document.querySelectorAll('.calendar-day:not(.empty)');
        days.forEach((day, index) => {
            setTimeout(() => {
                day.style.animation = 'popIn 0.3s ease-out';
                setTimeout(() => {
                    day.style.animation = '';
                }, 300);
            }, index * 30);
        });
    }

    // Animate time slots
    function animateTimeSlots() {
        const slots = document.querySelectorAll('.time-slot');
        slots.forEach((slot, index) => {
            setTimeout(() => {
                slot.style.animation = 'slideUp 0.4s ease-out';
                setTimeout(() => {
                    slot.style.animation = '';
                }, 400);
            }, index * 100);
        });
    }

    // Animate form elements
    function animateFormElements() {
        const inputs = document.querySelectorAll('.form-input, .form-textarea, .form-checkbox');
        inputs.forEach((input, index) => {
            setTimeout(() => {
                input.style.animation = 'fadeIn 0.5s ease-out';
                setTimeout(() => {
                    input.style.animation = '';
                }, 500);
            }, index * 50);
        });
    }

    // Step validation
    function validateStep(step) {
        switch(step) {
            case 1:
                if (!bookingState.service) {
                    shakeElement(document.getElementById('serviceGrid'));
                    return false;
                }
                return true;
                
            case 2:
                if (!bookingState.date || !bookingState.time) {
                    if (!bookingState.date) shakeElement(document.getElementById('calendarGrid'));
                    if (!bookingState.time) shakeElement(document.querySelector('#morningSlots, #afternoonSlots'));
                    return false;
                }
                return true;
                
            default:
                return true;
        }
    }

    // Shake animation for validation errors
    function shakeElement(element) {
        element.style.animation = 'gentleShake 0.5s ease-out';
        setTimeout(() => {
            element.style.animation = '';
        }, 500);
    }

    // Update step buttons state with animation
    function updateStepButtons() {
        const nextStep1 = document.getElementById('nextStep1');
        const nextStep2 = document.getElementById('nextStep2');
        
        if (bookingState.step === 1) {
            nextStep1.disabled = !bookingState.service;
            if (!nextStep1.disabled) {
                nextStep1.classList.add('pulse-once');
            } else {
                nextStep1.classList.remove('pulse-once');
            }
        } else if (bookingState.step === 2) {
            nextStep2.disabled = !(bookingState.date && bookingState.time);
            if (!nextStep2.disabled) {
                nextStep2.classList.add('pulse-once');
            } else {
                nextStep2.classList.remove('pulse-once');
            }
        }
    }

    // Service Selection with animation
    function selectService(serviceName, button) {
        // Remove selection from all services
        document.querySelectorAll('.service-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        // Add selection to clicked service with animation
        const selectedOption = button.closest('.service-option');
        selectedOption.classList.add('selected');
        
        // Add click animation to button
        button.style.transform = 'scale(0.9)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 150);
        
        // Update state
        bookingState.service = serviceName;
        
        // Update displays
        document.getElementById('displayService').textContent = serviceName;
        document.getElementById('finalService').textContent = serviceName;
        
        // Animate the update
        animateTextUpdate(document.getElementById('displayService'));
        
        updateStepButtons();
    }

    function selectCustomService() {
        const customService = document.getElementById('customService').value.trim();
        if (!customService) {
            shakeElement(document.getElementById('customService'));
            return;
        }
        
        // Animate custom service button
        const button = event.target;
        button.style.transform = 'scale(0.9)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 150);
        
        bookingState.service = customService;
        document.getElementById('displayService').textContent = customService + ' (Custom)';
        document.getElementById('finalService').textContent = customService + ' (Custom)';
        
        animateTextUpdate(document.getElementById('displayService'));
        updateStepButtons();
        
        // Show success animation
        const customDiv = document.querySelector('.bg-gray-50');
        customDiv.style.animation = 'gentleShake 0.5s ease-out';
        setTimeout(() => {
            customDiv.style.animation = '';
        }, 500);
    }

    // Animate text updates
    function animateTextUpdate(element) {
        element.style.transform = 'scale(1.1)';
        element.style.color = '#2563eb';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
            element.style.color = '';
        }, 300);
    }

    // Calendar initialization
    function initCalendar() {
        const today = new Date();
        const currentDate = today.toISOString().split('T')[0];
        
        // Select today by default
        selectDate(currentDate);
        
        // Add click handlers to calendar days with animation
        document.querySelectorAll('.calendar-day:not(.empty)').forEach(day => {
            day.addEventListener('click', function() {
                // Add click animation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
                
                selectDate(this.dataset.date);
            });
        });
    }

    function selectDate(dateString) {
        // Remove selection from all days
        document.querySelectorAll('.calendar-day').forEach(day => {
            day.classList.remove('selected');
        });
        
        // Add selection to clicked day
        const selectedDay = document.querySelector(`[data-date="${dateString}"]`);
        selectedDay.classList.add('selected');
        
        // Update state
        bookingState.date = formatDate(dateString);
        
        // Update displays
        document.getElementById('finalDate').textContent = bookingState.date;
        
        animateTextUpdate(document.getElementById('finalDate'));
        updateStepButtons();
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    }

    // Time selection with animation
    document.querySelectorAll('.time-slot').forEach(slot => {
        slot.addEventListener('click', function() {
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            // Remove selection from all slots
            document.querySelectorAll('.time-slot').forEach(s => {
                s.classList.remove('selected');
            });
            
            // Add selection to clicked slot
            this.classList.add('selected');
            
            // Update state
            const time = this.dataset.time;
            bookingState.time = formatTime(time);
            
            // Update displays
            document.getElementById('finalTime').textContent = bookingState.time;
            
            animateTextUpdate(document.getElementById('finalTime'));
            updateStepButtons();
        });
    });

    function formatTime(timeString) {
        const [hours, minutes] = timeString.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour % 12 || 12;
        return `${displayHour}:${minutes} ${ampm}`;
    }

    // Confetti animation
    function launchConfetti() {
        const container = document.getElementById('confetti-container');
        const colors = ['#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EF4444'];
        
        for (let i = 0; i < 150; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.width = Math.random() * 10 + 5 + 'px';
            confetti.style.height = Math.random() * 10 + 5 + 'px';
            confetti.style.animationDelay = Math.random() * 2 + 's';
            container.appendChild(confetti);
            
            // Remove after animation
            setTimeout(() => {
                confetti.remove();
            }, 3000);
        }
    }

    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.style.opacity = '1';
        modal.style.transform = 'scale(1)';
        
        setTimeout(() => {
            modal.style.transition = 'all 0.3s ease-out';
            modal.style.opacity = '0';
            modal.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.opacity = '';
                modal.style.transform = '';
                
                // Reset form for new booking
                resetBooking();
            }, 300);
        }, 100);
    }

    function resetBooking() {
        bookingState = {
            service: null,
            date: null,
            time: null,
            step: 1
        };
        
        // Reset UI with animation
        document.querySelectorAll('.service-option, .calendar-day, .time-slot').forEach(el => {
            el.classList.remove('selected');
        });
        
        document.getElementById('appointmentForm').reset();
        document.getElementById('customService').value = '';
        
        document.getElementById('displayService').textContent = 'Not selected';
        document.getElementById('finalService').textContent = 'Not selected';
        document.getElementById('finalDate').textContent = 'Not selected';
        document.getElementById('finalTime').textContent = 'Not selected';
        
        showStep(1);
    }

    // ================ BACKEND INTEGRATION (FIXED VERSION) ================

    /**
     * Submit appointment to the backend - FINAL FIXED VERSION
     */
    async function submitAppointmentBackend() {
        // Validate form
        const form = document.getElementById('appointmentForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            shakeElement(form);
            return;
        }

        // Get selected date from calendar
        const selectedDay = document.querySelector('.calendar-day.selected');
        if (!selectedDay) {
            showError('Please select a date');
            return;
        }

        // Get selected time slot
        const selectedTimeSlot = document.querySelector('.time-slot.selected');
        if (!selectedTimeSlot) {
            showError('Please select a time slot');
            return;
        }

        // Prepare data for API
        const formData = new FormData(form);
        const appointmentData = {
            service: bookingState.service,
            appointment_date: selectedDay.dataset.date,
            appointment_time: selectedTimeSlot.dataset.time,
            name: formData.get('name'),
            phone: formData.get('phone'),
            email: formData.get('email'),
            dob: formData.get('dob'),
            reason: formData.get('reason'),
            insurance: formData.get('insurance'),
            contact_whatsapp: formData.get('contact_whatsapp') === 'on',
            contact_sms: formData.get('contact_sms') === 'on',
            contact_email: formData.get('contact_email') === 'on',
            terms: true
        };

        console.log('Submitting appointment:', appointmentData);

        // Show loading state
        const submitBtn = event.target;
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        submitBtn.disabled = true;

        try {
            // FIXED: Use the web route with AJAX headers
            const response = await fetch('/appointments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest' // CRITICAL: Tells Laravel this is an AJAX request
                },
                body: JSON.stringify(appointmentData)
            });

            console.log('Response status:', response.status, response.statusText);

            // Check if response is JSON before parsing
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text();
                console.error('Server returned non-JSON response:', text.substring(0, 200));
                
                if (response.status === 422) {
                    // Validation error
                    showError('Please check your form data and try again.');
                } else if (response.status === 500) {
                    showError('Server error. Please try again later or contact support.');
                } else {
                    showError('Unexpected response from server. Please try again.');
                }
                return;
            }

            const data = await response.json();
            console.log('API Response:', data);

            if (data.success) {
                // Update success modal with real data from backend
                document.getElementById('referenceDisplay').textContent = data.appointment.appointment_number;
                
                // Show the modal with animation
                const modal = document.getElementById('successModal');
                modal.classList.remove('hidden');
                modal.style.opacity = '0';
                modal.style.transform = 'scale(0.9)';
                
                setTimeout(() => {
                    modal.style.transition = 'all 0.3s ease-out';
                    modal.style.opacity = '1';
                    modal.style.transform = 'scale(1)';
                }, 10);
                
                // Launch confetti
                launchConfetti();
                
                // Reset form after successful submission
                setTimeout(() => {
                    resetBooking();
                }, 3000);
                
            } else {
                showError(data.message || 'Failed to book appointment. Please try again.');
            }
        } catch (error) {
            console.error('Appointment submission failed:', error);
            
            if (error.message.includes('Failed to fetch')) {
                showError('Network error. Please check your internet connection and try again.');
            } else {
                showError('An unexpected error occurred. Please try again or contact support.');
            }
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    /**
     * Show error message with animation
     */
    function showError(message) {
        // Create error toast
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50 animate-slide-in-right';
        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                <span class="font-medium">${message}</span>
                <button class="ml-4 text-red-700 hover:text-red-900" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        // Remove existing toasts
        document.querySelectorAll('.animate-slide-in-right').forEach(el => el.remove());
        
        document.body.appendChild(toast);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.3s ease-out';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }
        }, 5000);
    }

    // Add CSS for slide-in animation if not present
    if (!document.querySelector('#toast-animations')) {
        const toastStyle = document.createElement('style');
        toastStyle.id = 'toast-animations';
        toastStyle.textContent = `
            .animate-slide-in-right {
                animation: slideInRight 0.3s ease-out forwards;
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(toastStyle);
    }

    // Override the old submitAppointment function
    window.submitAppointment = function() {
        console.warn('submitAppointment() is deprecated. Using submitAppointmentBackend() instead.');
        submitAppointmentBackend();
    };
    
    /**
     * Debug helper to check API connectivity
     */
    function checkApiConnectivity() {
        console.log('Checking API connectivity...');
        
        // Test the web route
        fetch('/appointments', {
            method: 'HEAD',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => console.log('Web route (/appointments) status:', response.status))
        .catch(error => console.error('Web route error:', error));
        
        // Test API routes if they exist
        fetch('/api/appointments/book', { method: 'HEAD' })
            .then(response => console.log('API route (/api/appointments/book) status:', response.status))
            .catch(() => console.log('API route not available (this is normal if using web route)'));
    }
    
    // Run connectivity check on load (optional)
    // setTimeout(checkApiConnectivity, 1000);
</script>
@endsection