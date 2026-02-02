{{-- resources/views/web/contact.blade.php --}}
@extends('layouts.web')

@section('title', 'Contact Us | Precise Diagnostics Imaging')

@push('styles')
<style>
    /* =========================
       Animations
    ========================== */
    @keyframes pulse-contact {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.9; }
    }

    @keyframes float-contact {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(2deg); }
    }

    @keyframes shimmer-contact {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }

    @keyframes wave-contact {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    @keyframes ripple-contact {
        0% { transform: scale(0); opacity: .8; }
        100% { transform: scale(3.5); opacity: 0; }
    }

    @keyframes typing-contact {
        from { width: 0; }
        to { width: 100%; }
    }

    @keyframes blink-cursor {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }

    @keyframes pulse-ring {
        0% { transform: scale(.85); opacity: .55; }
        70% { transform: scale(1.15); opacity: 0; }
        100% { transform: scale(1.15); opacity: 0; }
    }

    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes gridMove {
        0% { background-position: 0 0, 0 0; }
        100% { background-position: 200px 200px, 200px 200px; }
    }

    @keyframes success-check {
        0% { transform: scale(0); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    /* =========================
       Hero
    ========================== */
    .contact-hero-gradient {
        background: linear-gradient(135deg, #0c4a6e 0%, #1e40af 50%, #0369a1 100%);
        position: relative;
        overflow: hidden;
    }

    .contact-particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        animation: float-contact 20s linear infinite;
        will-change: transform;
    }

    .contact-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 200%;
        height: 120px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%23ffffff"/></svg>');
        background-repeat: repeat-x;
        animation: wave-contact 25s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
    }

    .typing-effect {
        overflow: hidden;
        border-right: 3px solid #22d3ee;
        white-space: nowrap;
        margin: 0 auto;
        letter-spacing: 1px;
        animation: typing-contact 3.4s steps(40, end), blink-cursor 0.75s step-end infinite;
    }

    /* =========================
       Reveal
    ========================== */
    .reveal-contact {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .reveal-contact.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* =========================
       Cards
    ========================== */
    .contact-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .contact-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(30, 64, 175, 0.25);
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
        transition: left 0.6s;
    }

    .contact-card:hover::before { left: 100%; }

    .contact-icon-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
    }

    .contact-icon-pulse {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        animation: pulse-ring 2.2s infinite;
        filter: blur(.2px);
    }

    .contact-icon {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.25);
    }

    .whatsapp-card .contact-icon-pulse,
    .whatsapp-card .contact-icon { background: linear-gradient(135deg, #25d366, #128c7e); }

    .phone-card .contact-icon-pulse,
    .phone-card .contact-icon { background: linear-gradient(135deg, #3b82f6, #0ea5e9); }

    .email-card .contact-icon-pulse,
    .email-card .contact-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }

    /* =========================
       Form
    ========================== */
    .contact-form-container {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 2rem;
        position: relative;
        overflow: hidden;
    }

    .contact-form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #0ea5e9, #22d3ee);
        animation: shimmer-contact 3s infinite linear;
        background-size: 200% 100%;
    }

    .form-input {
        transition: all 0.25s ease;
        background: white;
        border: 2px solid #e2e8f0;
    }

    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
        transform: translateY(-2px);
    }

    .form-label {
        transition: all 0.25s ease;
        transform-origin: left top;
    }

    /* float label for inputs/textarea using peer */
    .peer:focus + .form-label,
    .peer:not(:placeholder-shown) + .form-label {
        transform: translateY(-30px) scale(0.9);
        color: #3b82f6;
    }

    /* select doesn't support :placeholder-shown nicely, we'll toggle .has-value in JS */
    .has-value + .form-label {
        transform: translateY(-30px) scale(0.9);
        color: #3b82f6;
    }

    .submit-button {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #3b82f6, #0ea5e9);
        transition: all 0.25s ease;
    }

    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px -15px rgba(59, 130, 246, 0.35);
    }

    /* Status */
    .status-message {
        opacity: 0;
        transform: translateY(16px);
        transition: all 0.45s ease;
    }
    .status-message.show {
        opacity: 1;
        transform: translateY(0);
    }

    .success-check { animation: success-check 0.5s ease-out; }

    /* Map container */
    .map-container {
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.10);
        transition: all 0.3s ease;
        position: relative;
    }
    .map-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.18);
    }

    /* Working hours ticks */
    .working-hours li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: .9rem;
    }
    .working-hours li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #10b981;
        font-weight: 800;
    }

    /* Gradient text */
    .gradient-text-contact {
        background: linear-gradient(135deg, #3b82f6, #0ea5e9, #22d3ee);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        background-size: 200% 200%;
        animation: gradientFlow 3s ease infinite;
    }

    /* Floating helper */
    .floating-element { animation: float-contact 6s ease-in-out infinite; }
    .floating-element-delay-1 { animation-delay: -2s; }
    .floating-element-delay-2 { animation-delay: -4s; }

    /* Location pin bounce */
    .location-pin { animation: bounce 2s infinite; }
    @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

    /* Button ripple support */
    .ripple-host { position: relative; overflow: hidden; }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-hero-gradient { padding-top: 6rem; padding-bottom: 6rem; }
        .typing-effect { white-space: normal; border-right: none; animation: none; }
    }
</style>
@endpush

@section('content')

@php
    // Keep your contact info in ONE place (easy to update later)
    $phoneMain = '+254207856359';
    $whatsapp   = '254791903552';
    $email      = 'info@precisediagnostic.co.ke';
@endphp

<!-- HERO -->
<section class="contact-hero-gradient relative min-h-[60vh] flex items-center overflow-hidden">
    <!-- Animated Particles (server-rendered) -->
    <div class="absolute inset-0">
        @for($i = 0; $i < 15; $i++)
            <div class="contact-particle" style="
                width: {{ rand(2, 6) }}px;
                height: {{ rand(2, 6) }}px;
                left: {{ rand(0, 100) }}%;
                top: {{ rand(0, 100) }}%;
                animation-delay: {{ $i * 1.5 }}s;
                opacity: {{ rand(1, 8) / 10 }};
            "></div>
        @endfor
    </div>

    <!-- Floating Icons -->
    <div class="absolute top-1/4 left-10 text-white/10 text-6xl floating-element">
        <i class="fas fa-comments-medical"></i>
    </div>
    <div class="absolute bottom-1/4 right-10 text-white/10 text-6xl floating-element floating-element-delay-1">
        <i class="fas fa-headset"></i>
    </div>
    <div class="absolute top-1/2 left-1/4 text-white/10 text-4xl floating-element floating-element-delay-2">
        <i class="fas fa-map-marker-alt"></i>
    </div>

    <!-- Wave -->
    <div class="contact-wave opacity-10"></div>

    <div class="relative z-10 w-full">
        <div class="container mx-auto px-6 py-20">
            <div class="max-w-4xl mx-auto text-center reveal-contact">
                <!-- Badge (no emergency wording) -->
                <div class="inline-flex items-center space-x-3 bg-white/10 backdrop-blur-sm px-6 py-3 rounded-full mb-8 border border-white/20">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-white/90 font-semibold">Fast, confidential support</span>
                </div>

                <h1 class="font-heading text-5xl md:text-7xl lg:text-6xl font-black mb-6 leading-tight">
                    <span class="text-white drop-shadow-2xl">Connect With</span>
                    <span class="block gradient-text-contact mt-2">Precision Care</span>
                </h1>

                <div class="max-w-2xl mx-auto mb-10">
                    <p class="text-xl md:text-2xl text-white/90 leading-relaxed typing-effect reveal-contact reveal-delay-1">
                        Reach our medical imaging team quickly, securely, and with clear guidance.
                    </p>
                </div>

                <!-- Quick stats -->
                <div class="flex flex-wrap justify-center gap-8 mb-12 reveal-contact reveal-delay-2">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-cyan-300 mb-1">Same-day</div>
                        <div class="text-white/70 text-sm">Support available</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-300 mb-1">&lt; 5min</div>
                        <div class="text-white/70 text-sm">Typical WhatsApp reply</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-300 mb-1">100%</div>
                        <div class="text-white/70 text-sm">Confidential handling</div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:{{ $phoneMain }}" class="ripple-host bg-white text-blue-900 px-8 py-4 rounded-2xl font-extrabold hover:bg-gray-100 transition-all inline-flex items-center justify-center">
                        <i class="fas fa-phone-alt mr-2"></i> Call Us
                    </a>
                    <a href="https://wa.me/{{ $whatsapp }}?text=Hello%2C%20I%20need%20assistance%20with%20medical%20imaging"
                       target="_blank" rel="noopener"
                       class="ripple-host bg-transparent border-2 border-white text-white px-8 py-4 rounded-2xl font-extrabold hover:bg-white/10 transition-all inline-flex items-center justify-center">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTACT METHODS -->
<section class="relative py-20 bg-gradient-to-b from-white to-gray-50 overflow-hidden">
    <!-- Subtle pattern (fixed quote escaping) -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0"
             style="background-image: url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%239C92AC%22%20fill-opacity%3D%220.35%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>

    <div class="relative z-10">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 reveal-contact">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    <span class="gradient-text-contact">Multiple Ways to Connect</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Choose your preferred method to reach our medical imaging team.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- WhatsApp -->
                <div class="contact-card whatsapp-card bg-white rounded-3xl p-8 shadow-lg border border-gray-100 reveal-contact">
                    <div class="contact-icon-wrapper">
                        <div class="contact-icon-pulse"></div>
                        <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>

                    <h3 class="text-2xl font-bold text-center mb-4 text-gray-900">WhatsApp Chat</h3>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Quick messaging with our team. Share images and get guidance fast.
                    </p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span class="text-sm">Fast replies</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span class="text-sm">Image sharing enabled</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span class="text-sm">Confidential support</span>
                        </div>
                    </div>

                    <a href="https://wa.me/{{ $whatsapp }}?text=Hello%2C%20I%20need%20assistance%20with%20medical%20imaging"
                       target="_blank" rel="noopener"
                       class="ripple-host block text-center bg-gradient-to-r from-green-500 to-emerald-400 text-white py-4 rounded-xl font-bold transition-all hover:shadow-lg hover:shadow-green-200">
                        <i class="fab fa-whatsapp mr-2"></i> Start Chat
                    </a>
                </div>

                <!-- Phone -->
                <div class="contact-card phone-card bg-white rounded-3xl p-8 shadow-lg border border-gray-100 reveal-contact reveal-delay-1">
                    <div class="contact-icon-wrapper">
                        <div class="contact-icon-pulse"></div>
                        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    </div>

                    <h3 class="text-2xl font-bold text-center mb-4 text-gray-900">Direct Call</h3>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Speak with our team for appointments, preparation guidance, and pricing questions.
                    </p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                            <span class="text-sm">Immediate connection</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                            <span class="text-sm">Clear preparation guidance</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                            <span class="text-sm">Friendly support</span>
                        </div>
                    </div>

                    <a href="tel:{{ $phoneMain }}"
                       class="ripple-host block text-center bg-gradient-to-r from-blue-500 to-cyan-400 text-white py-4 rounded-xl font-bold transition-all hover:shadow-lg hover:shadow-blue-200">
                        <i class="fas fa-phone-alt mr-2"></i> Call Now
                    </a>

                    <div class="mt-4 text-center text-sm text-gray-500">
                        Prefer online? <a class="text-blue-600 font-bold hover:text-blue-700" href="{{ route('appointments') }}">Book →</a>
                    </div>
                </div>

                <!-- Email -->
                <div class="contact-card email-card bg-white rounded-3xl p-8 shadow-lg border border-gray-100 reveal-contact reveal-delay-2">
                    <div class="contact-icon-wrapper">
                        <div class="contact-icon-pulse"></div>
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    </div>

                    <h3 class="text-2xl font-bold text-center mb-4 text-gray-900">Email</h3>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Send detailed inquiries or documents. We respond during working hours.
                    </p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-amber-500 mr-3"></i>
                            <span class="text-sm">Confidential handling</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-amber-500 mr-3"></i>
                            <span class="text-sm">Attachments supported</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-amber-500 mr-3"></i>
                            <span class="text-sm">Clear written responses</span>
                        </div>
                    </div>

                    <a href="mailto:{{ $email }}?subject=Medical%20Imaging%20Inquiry"
                       class="ripple-host block text-center bg-gradient-to-r from-amber-500 to-orange-400 text-white py-4 rounded-xl font-bold transition-all hover:shadow-lg hover:shadow-amber-200">
                        <i class="fas fa-envelope mr-2"></i> Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORM + LOCATION -->
<section class="relative py-20 bg-white overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full -translate-y-32 translate-x-32"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-cyan-50 rounded-full translate-y-32 -translate-x-32"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Form -->
                <div class="reveal-contact">
                    <div class="contact-form-container p-8 md:p-12 shadow-2xl">
                        <div class="text-center mb-10">
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                                Send Us a <span class="gradient-text-contact">Message</span>
                            </h2>
                            <p class="text-gray-600">
                                Fill out the form and we’ll respond as soon as possible.
                            </p>
                        </div>

                        {{-- Replace action with your real route/controller if you have one --}}
                        <form id="contactForm" class="space-y-6" action="#" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf

                            <div class="relative">
                                <input type="text" id="name" name="name"
                                       class="form-input w-full p-4 rounded-xl focus:outline-none peer"
                                       placeholder=" "
                                       required>
                                <label for="name" class="form-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                                    Full Name *
                                </label>
                            </div>

                            <div class="relative">
                                <input type="email" id="email" name="email"
                                       class="form-input w-full p-4 rounded-xl focus:outline-none peer"
                                       placeholder=" "
                                       required>
                                <label for="email" class="form-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                                    Email Address *
                                </label>
                            </div>

                            <div class="relative">
                                <input type="tel" id="phone" name="phone"
                                       class="form-input w-full p-4 rounded-xl focus:outline-none peer"
                                       placeholder=" ">
                                <label for="phone" class="form-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                                    Phone Number (Optional)
                                </label>
                            </div>

                            <div class="relative">
                                <select id="service" name="service"
                                        class="form-input w-full p-4 rounded-xl focus:outline-none appearance-none">
                                    <option value="" selected>Select a service</option>
                                    <option value="mri">MRI Scanning</option>
                                    <option value="ct">CT Scan</option>
                                    <option value="ultrasound">Ultrasound</option>
                                    <option value="xray">X-Ray</option>
                                    <option value="consultation">Consultation</option>
                                    <option value="other">Other Inquiry</option>
                                </select>
                                <label for="service" class="form-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                                    Service Type
                                </label>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>

                            <div class="relative">
                                <textarea id="message" name="message" rows="4"
                                          class="form-input w-full p-4 rounded-xl focus:outline-none peer"
                                          placeholder=" "
                                          required></textarea>
                                <label for="message" class="form-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                                    Your Message *
                                </label>
                            </div>

                            <div class="relative">
                                <input type="file" id="attachment" name="attachment" class="hidden"
                                       accept=".pdf,.jpg,.jpeg,.png,.dcm">
                                <label id="attachmentLabel" for="attachment"
                                       class="cursor-pointer flex items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-blue-500 transition-colors">
                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600 font-semibold">Upload report (Optional)</p>
                                        <p class="text-sm text-gray-400">PDF, JPG, PNG, DICOM (.dcm)</p>
                                    </div>
                                </label>
                            </div>

                            <button type="submit" class="submit-button ripple-host w-full text-white py-4 rounded-xl font-bold text-lg">
                                <span id="submitText">Send Message</span>
                                <i id="submitIcon" class="fas fa-paper-plane ml-2"></i>
                            </button>

                            <div id="statusMessage" class="status-message text-center p-4 rounded-xl"></div>
                        </form>
                    </div>
                </div>

                <!-- Location + hours -->
                <div class="reveal-contact reveal-delay-1">
                    <div class="space-y-8">
                        <div class="map-container h-64 md:h-80 bg-gradient-to-br from-blue-100 to-cyan-100 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center px-6">
                                    <div class="location-pin inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
                                        <i class="fas fa-map-marker-alt text-2xl text-red-500"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Nairobi, Kenya</h3>
                                    <p class="text-gray-600">Visit our imaging center for walk-in guidance.</p>
                                </div>
                            </div>

                            @for($i = 0; $i < 5; $i++)
                                <div class="absolute rounded-full bg-blue-300/30"
                                     style="
                                        width: {{ rand(16, 28) }}px;
                                        height: {{ rand(16, 28) }}px;
                                        top: {{ rand(10, 90) }}%;
                                        left: {{ rand(10, 90) }}%;
                                        animation: float-contact {{ rand(10, 20) }}s ease-in-out infinite;
                                        animation-delay: {{ $i * 3 }}s;
                                     "></div>
                            @endfor
                        </div>

                        <div class="bg-gradient-to-br from-slate-50 to-blue-50 rounded-2xl p-8 shadow-lg">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-clock text-blue-500 mr-3"></i>
                                Working Hours
                            </h3>
                            <ul class="working-hours space-y-3">
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Monday - Friday</span>
                                    <span class="font-bold text-gray-900">7:00 AM - 10:00 PM</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Saturday</span>
                                    <span class="font-bold text-gray-900">8:00 AM - 8:00 PM</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Sunday & Holidays</span>
                                    <span class="font-bold text-gray-900">Closed / Limited support</span>
                                </li>
                            </ul>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-location-arrow text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Directions</h4>
                                        <p class="text-gray-600 text-sm">Get guidance to our location.</p>
                                        <a href="{{ route('contact') }}" class="text-blue-600 font-bold hover:text-blue-700">
                                            Ask on WhatsApp →
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Appointments</h4>
                                        <p class="text-gray-600 text-sm">Schedule your imaging session.</p>
                                        <a href="{{ route('appointments') }}" class="text-blue-600 font-bold hover:text-blue-700">
                                            Book Online →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                                    <i class="fas fa-user-shield text-amber-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-gray-900">Privacy</h4>
                                    <p class="text-gray-600 text-sm mt-1">
                                        Please avoid sharing highly sensitive information on public devices. For documents, use WhatsApp or email.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-sky-900"></div>

    <div class="absolute inset-0" style="
        background-image:
            linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: gridMove 20s linear infinite;
    "></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto reveal-contact">
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                    Need quick <span class="gradient-text-contact">guidance</span>?
                </h2>

                <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                    Call or WhatsApp our team for booking help, preparation instructions, and pricing.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="tel:{{ $phoneMain }}"
                       class="ripple-host group relative bg-gradient-to-r from-blue-500 to-cyan-400 text-white px-10 py-5 rounded-2xl font-bold text-lg hover:shadow-[0_20px_60px_-15px_rgba(59,130,246,0.5)] transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                        <div class="relative z-10 flex items-center space-x-3">
                            <i class="fas fa-phone-alt text-xl"></i>
                            <span>Call Now</span>
                        </div>
                    </a>

                    <a href="https://wa.me/{{ $whatsapp }}"
                       target="_blank" rel="noopener"
                       class="ripple-host group relative bg-gradient-to-r from-green-500 to-emerald-400 text-white px-10 py-5 rounded-2xl font-bold text-lg hover:shadow-[0_20px_60px_-15px_rgba(34,197,94,0.5)] transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                        <div class="relative z-10 flex items-center space-x-3">
                            <i class="fab fa-whatsapp text-xl"></i>
                            <span>WhatsApp</span>
                        </div>
                    </a>
                </div>

                <div class="mt-12 flex flex-wrap justify-center items-center gap-8">
                    <div class="flex items-center space-x-2 text-white/70">
                        <i class="fas fa-lock text-cyan-300"></i>
                        <span>Confidential</span>
                    </div>
                    <div class="flex items-center space-x-2 text-white/70">
                        <i class="fas fa-file-medical text-cyan-300"></i>
                        <span>Reports supported</span>
                    </div>
                    <div class="flex items-center space-x-2 text-white/70">
                        <i class="fas fa-user-md text-cyan-300"></i>
                        <span>Imaging team</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal animations
    const revealElements = document.querySelectorAll('.reveal-contact');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            const delay = entry.target.classList.contains('reveal-delay-1') ? 200 :
                         entry.target.classList.contains('reveal-delay-2') ? 400 : 0;

            setTimeout(() => entry.target.classList.add('is-visible'), delay);
            revealObserver.unobserve(entry.target);
        });
    }, { threshold: 0.1, rootMargin: '50px' });

    revealElements.forEach(el => revealObserver.observe(el));

    // Form handling (demo)
    const contactForm = document.getElementById('contactForm');
    const submitBtn = contactForm?.querySelector('button[type="submit"]');
    const submitText = document.getElementById('submitText');
    const submitIcon = document.getElementById('submitIcon');
    const statusMessage = document.getElementById('statusMessage');

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Sending...';
            submitIcon.className = 'fas fa-spinner fa-spin ml-2';
            submitBtn.classList.add('opacity-75');

            // Simulate
            setTimeout(() => {
                statusMessage.innerHTML = `
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3 success-check">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-green-800">Message sent!</h4>
                                <p class="text-green-600 text-sm">We’ll get back to you soon.</p>
                            </div>
                        </div>
                    </div>
                `;
                statusMessage.classList.add('show');

                contactForm.reset();

                // Reset floating labels state for select
                const serviceSelect = document.getElementById('service');
                serviceSelect?.classList.remove('has-value');

                // Reset attachment label
                const attachmentLabel = document.getElementById('attachmentLabel');
                if (attachmentLabel) {
                    attachmentLabel.innerHTML = `
                        <div class="text-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600 font-semibold">Upload report (Optional)</p>
                            <p class="text-sm text-gray-400">PDF, JPG, PNG, DICOM (.dcm)</p>
                        </div>
                    `;
                    attachmentLabel.classList.remove('border-blue-500', 'bg-blue-50');
                    attachmentLabel.classList.add('border-gray-300');
                }

                // Button normal
                submitBtn.disabled = false;
                submitText.textContent = 'Send Message';
                submitIcon.className = 'fas fa-paper-plane ml-2';
                submitBtn.classList.remove('opacity-75');

                setTimeout(() => statusMessage.classList.remove('show'), 5000);
            }, 1200);
        });
    }

    // File upload preview
    const fileInput = document.getElementById('attachment');
    const attachmentLabel = document.getElementById('attachmentLabel');

    fileInput?.addEventListener('change', (e) => {
        if (!e.target.files || e.target.files.length === 0) return;

        const file = e.target.files[0];
        const fileName = file.name;
        const fileSize = (file.size / 1024 / 1024).toFixed(2);

        if (attachmentLabel) {
            attachmentLabel.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-file-medical-alt text-3xl text-blue-500 mb-2"></i>
                    <p class="text-blue-600 font-semibold">${fileName}</p>
                    <p class="text-sm text-gray-500">${fileSize} MB</p>
                    <p class="text-xs text-gray-400 mt-1">Ready to send</p>
                </div>
            `;
            attachmentLabel.classList.remove('border-gray-300');
            attachmentLabel.classList.add('border-blue-500', 'bg-blue-50');
        }
    });

    // Floating label for select (since :placeholder-shown doesn't work)
    const serviceSelect = document.getElementById('service');
    const syncSelectLabel = () => {
        if (!serviceSelect) return;
        if (serviceSelect.value && serviceSelect.value !== '') {
            serviceSelect.classList.add('has-value');
        } else {
            serviceSelect.classList.remove('has-value');
        }
    };
    serviceSelect?.addEventListener('change', syncSelectLabel);
    syncSelectLabel();

    // Auto-resize textarea
    const textarea = document.getElementById('message');
    textarea?.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Safer phone formatting (doesn't force +254 on every keystroke)
    const phoneInput = document.getElementById('phone');
    phoneInput?.addEventListener('blur', (e) => {
        let v = (e.target.value || '').trim();
        if (!v) return;

        // keep digits only
        const digits = v.replace(/\D/g, '');

        // If user typed 07XXXXXXXX or 7XXXXXXXX, normalize to +2547XXXXXXXX
        if (digits.length === 10 && digits.startsWith('07')) {
            e.target.value = '+254' + digits.slice(1);
            return;
        }
        if (digits.length === 9 && digits.startsWith('7')) {
            e.target.value = '+254' + digits;
            return;
        }

        // If user already typed country code
        if (digits.startsWith('254') && digits.length >= 12) {
            e.target.value = '+' + digits;
            return;
        }

        // Otherwise leave as-is (user might be using another format)
        e.target.value = v;
    });

    // Ripple effect (only on elements with .ripple-host)
    document.querySelectorAll('.ripple-host').forEach(el => {
        el.addEventListener('click', function (e) {
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                border-radius: 9999px;
                background: rgba(255, 255, 255, 0.55);
                width: ${size}px;
                height: ${size}px;
                top: ${y}px;
                left: ${x}px;
                transform: scale(0);
                animation: ripple-contact .6s ease-out;
                pointer-events: none;
            `;
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 650);
        });
    });

    // Gentle parallax for particles
    const particles = document.querySelectorAll('.contact-particle');
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY || window.pageYOffset || 0;
        particles.forEach((p, i) => {
            const w = parseFloat(p.style.width) || 4;
            const speed = Math.min(0.35, w * 0.03);
            p.style.transform = `translateY(${scrolled * -speed}px)`;
        });
    }, { passive: true });
});
</script>
@endpush
