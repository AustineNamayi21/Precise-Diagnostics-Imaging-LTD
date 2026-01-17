@extends('layouts.app')

@section('title', 'Home - Advanced Medical Imaging')

@section('content')
<!-- Hero Section -->
<section class="medical-gradient text-white relative">
    <div class="container mx-auto px-6 py-24">
        <div class="max-w-4xl mx-auto text-center hero-reveal">
            <h1 class="font-heading text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                Precision in Every <span class="text-yellow-300">Diagnosis</span>
            </h1>
            <p class="text-xl mb-10 opacity-90">
                Advanced medical imaging with cutting-edge technology, expert radiologists, 
                and compassionate care for accurate diagnoses and better health outcomes.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('appointments') }}" class="hero-cta bg-white text-blue-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all transform hover:-translate-y-1 shadow-2xl inline-flex items-center justify-center">
                    <i class="fas fa-calendar-check mr-2"></i> Book Appointment
                </a>
                <a href="{{ route('contact') }}" class="hero-cta bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all inline-flex items-center justify-center">
                    <i class="fas fa-phone-alt mr-2"></i> Emergency Contact
                </a>
            </div>
        </div>
    </div>

    <!-- Hero Images Grid -->
    <div class="container mx-auto px-6 mt-12 hero-images grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 reveal-active">
        @foreach (['1.jpg','2.jpg','3.jpg','4.jpg'] as $img)
        <div class="h-64 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:scale-105 cursor-zoom-in">
            <img src="{{ asset('images/'.$img) }}" alt="Medical Imaging {{ $loop->iteration }}" class="w-full h-full object-cover" loading="lazy">
        </div>
        @endforeach
    </div>
</section>

<!-- Stats Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 stats-reveal">
            <div class="text-center stat-card">
                <div class="text-5xl font-bold text-blue-600 mb-2 stat-number" data-target="10000">0</div>
                <div class="text-gray-600">Patients Served</div>
            </div>
            <div class="text-center stat-card">
                <div class="text-5xl font-bold text-teal-600 mb-2 stat-number" data-target="24">0</div>
                <div class="text-gray-600">Emergency Services</div>
            </div>
            <div class="text-center stat-card">
                <div class="text-5xl font-bold text-blue-600 mb-2 stat-number" data-target="99.8">0</div>
                <div class="text-gray-600">Accuracy Rate (%)</div>
            </div>
            <div class="text-center stat-card">
                <div class="text-5xl font-bold text-teal-600 mb-2 stat-number" data-target="30">0</div>
                <div class="text-gray-600">Average Wait Time (min)</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="medical-gradient-light py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 services-reveal">
            <h2 class="font-heading text-4xl font-bold text-gray-900 mb-4">Our Advanced Services</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">State-of-the-art imaging technology for comprehensive diagnostics</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow service-card">
                <div class="text-blue-600 text-4xl mb-4 service-icon">
                    <i class="fas fa-mri"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3">MRI Scanning</h3>
                <p class="text-gray-600 mb-6">High-resolution magnetic resonance imaging for detailed soft tissue analysis.</p>
                <a href="{{ route('services') }}#mri" class="text-blue-600 font-semibold hover:text-blue-800">Learn More →</a>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow service-card">
                <div class="text-teal-600 text-4xl mb-4 service-icon">
                    <i class="fas fa-x-ray"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3">CT Scan</h3>
                <p class="text-gray-600 mb-6">Computed tomography for cross-sectional imaging and 3D reconstruction.</p>
                <a href="{{ route('services') }}#ct" class="text-blue-600 font-semibold hover:text-blue-800">Learn More →</a>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow service-card">
                <div class="text-blue-600 text-4xl mb-4 service-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3">Ultrasound</h3>
                <p class="text-gray-600 mb-6">Real-time imaging for obstetrics, cardiology, and abdominal diagnostics.</p>
                <a href="{{ route('services') }}#ultrasound" class="text-blue-600 font-semibold hover:text-blue-800">Learn More →</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="medical-gradient py-20 cta-reveal">
    <div class="container mx-auto px-6 text-center">
        <h2 class="font-heading text-4xl font-bold text-white mb-6">Ready for Your Diagnostic Journey?</h2>
        <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
            Book your appointment today and experience healthcare with precision, compassion, and cutting-edge technology.
        </p>
        <a href="https://wa.me/254700000000?text=Hello%2C%20I%20want%20to%20book%20an%20appointment" target="_blank" class="bg-white text-blue-900 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all inline-flex items-center justify-center whatsapp-icon">
            <i class="fab fa-whatsapp mr-3 text-2xl"></i>
            Chat with Us on WhatsApp
        </a>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox-modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300 cursor-zoom-out">
    <img id="lightbox-image" src="" class="max-h-[90%] max-w-[90%] rounded-2xl shadow-2xl" alt="Enlarged medical image">
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal animations
    const revealElements = document.querySelectorAll('.hero-reveal, .stats-reveal, .services-reveal, .cta-reveal, .service-card, .hero-images');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting) entry.target.classList.add('reveal-active');
        });
    }, { threshold: 0.15 });
    revealElements.forEach(el => observer.observe(el));

    // Stats count up
    const counters = document.querySelectorAll('.stat-number');
    counters.forEach(counter => {
        const updateCount = () => {
            const target = parseFloat(counter.getAttribute('data-target'));
            let count = parseFloat(counter.innerText);
            const increment = target / 200;
            if(count < target){
                counter.innerText = (target % 1 === 0 ? Math.floor(count + increment) : (count + increment).toFixed(1));
                requestAnimationFrame(updateCount);
            } else counter.innerText = target;
        };
        updateCount();
    });

    // WhatsApp bounce
    const whatsappIcon = document.querySelector('.whatsapp-icon i');
    if(whatsappIcon) setInterval(() => whatsappIcon.classList.toggle('animate-bounce'), 2000);

    // Lightbox modal for images
    const lightbox = document.getElementById('lightbox-modal');
    const lightboxImg = document.getElementById('lightbox-image');

    document.querySelectorAll('.hero-images div').forEach(imgDiv => {
        imgDiv.addEventListener('click', () => {
            const imgTag = imgDiv.querySelector('img');
            if (imgTag && imgTag.src) {
                lightboxImg.src = imgTag.src;
                lightbox.classList.remove('opacity-0', 'pointer-events-none');
            }
        });
    });

    // Close lightbox
    lightbox.addEventListener('click', () => {
        lightbox.classList.add('opacity-0', 'pointer-events-none');
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !lightbox.classList.contains('opacity-0')) {
            lightbox.classList.add('opacity-0', 'pointer-events-none');
        }
    });
});
</script>

<style>
/* Reveal animations */
.hero-reveal, .stats-reveal, .services-reveal, .cta-reveal, .service-card, .hero-images {
    opacity: 0; transform: translateY(30px); transition: all 0.8s ease;
}
.reveal-active { opacity: 1; transform: translateY(0); }

/* WhatsApp bounce */
@keyframes bounce { 0%,100%{ transform: translateY(0); } 50%{ transform: translateY(-8px); } }
.animate-bounce { animation: bounce 0.6s ease infinite; }

/* Lightbox fade */
#lightbox-modal { transition: opacity 0.3s ease; }

/* Image loading skeleton */
img {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}
@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
img:not([src=""]) { animation: none; background: transparent; }
</style>
@endpush
