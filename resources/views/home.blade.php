@extends('layouts.app')

@section('title', 'Home - Advanced Medical Imaging')

@section('content')
<!-- Hero Section -->
<section class="medical-gradient text-white">
    <div class="container mx-auto px-6 py-24">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-6 leading-tight">
                Precision in Every <span class="text-yellow-300">Diagnosis</span>
            </h1>
            <p class="text-xl mb-10 opacity-90">
                Advanced medical imaging with cutting-edge technology, expert radiologists, 
                and compassionate care for accurate diagnoses and better health outcomes.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/appointments" class="bg-white text-blue-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all transform hover:-translate-y-1 shadow-2xl">
                    <i class="fas fa-calendar-check mr-2"></i> Book Appointment
                </a>
                <a href="/contact" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all">
                    <i class="fas fa-phone-alt mr-2"></i> Emergency Contact
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-5xl font-bold text-blue-600 mb-2">10,000+</div>
                <div class="text-gray-600">Patients Served</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-teal-600 mb-2">24/7</div>
                <div class="text-gray-600">Emergency Services</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-blue-600 mb-2">99.8%</div>
                <div class="text-gray-600">Accuracy Rate</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-teal-600 mb-2">30min</div>
                <div class="text-gray-600">Average Wait Time</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="medical-gradient-light py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="font-heading text-4xl font-bold text-gray-900 mb-4">Our Advanced Services</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">State-of-the-art imaging technology for comprehensive diagnostics</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow">
                <div class="text-blue-600 text-4xl mb-4">
                    <i class="fas fa-mri"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3">MRI Scanning</h3>
                <p class="text-gray-600 mb-6">High-resolution magnetic resonance imaging for detailed soft tissue analysis.</p>
                <a href="/services#mri" class="text-blue-600 font-semibold hover:text-blue-800">Learn More →</a>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow">
                <div class="text-teal-600 text-4xl mb-4">
                    <i class="fas fa-x-ray"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3">CT Scan</h3>
                <p class="text-gray-600 mb-6">Computed tomography for cross-sectional imaging and 3D reconstruction.</p>
                <a href="/services#ct" class="text-blue-600 font-semibold hover:text-blue-800">Learn More →</a>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow">
                <div class="text-blue-600 text-4xl mb-4">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3">Ultrasound</h3>
                <p class="text-gray-600 mb-6">Real-time imaging for obstetrics, cardiology, and abdominal diagnostics.</p>
                <a href="/services#ultrasound" class="text-blue-600 font-semibold hover:text-blue-800">Learn More →</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="medical-gradient py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="font-heading text-4xl font-bold text-white mb-6">Ready for Your Diagnostic Journey?</h2>
        <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
            Book your appointment today and experience healthcare with precision, compassion, and cutting-edge technology.
        </p>
        <a href="/contact" class="bg-white text-blue-900 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all inline-flex items-center">
            <i class="fab fa-whatsapp mr-3 text-2xl"></i>
            Chat with Us on WhatsApp
        </a>
    </div>
</section>
@endsection