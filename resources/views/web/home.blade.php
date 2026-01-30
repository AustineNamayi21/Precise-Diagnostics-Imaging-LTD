{{-- resources/views/web/home.blade.php --}}
@extends('layouts.web')

@section('title', 'Home - Precise Diagnostics Imaging')

@section('content')

<!-- Hero Section (Blue overlay, high contrast, elegant) -->
<section class="medical-gradient relative overflow-hidden text-white">
    <!-- Blue overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/70 via-blue-800/65 to-sky-700/60"></div>

    <!-- Decorative light blobs -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-400/20 rounded-full blur-3xl"></div>
    <div class="absolute top-24 -right-32 w-[28rem] h-[28rem] bg-blue-500/20 rounded-full blur-3xl"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6 py-28">
            <div class="max-w-4xl mx-auto text-center reveal">
                <h1 class="font-heading text-5xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-[0_12px_40px_rgba(0,0,0,0.45)]">
                    Precision in Every <span class="text-yellow-300">Diagnosis</span>
                </h1>

                <p class="text-xl mb-10 text-white/95 leading-relaxed drop-shadow-[0_10px_30px_rgba(0,0,0,0.35)]">
                    Advanced medical imaging with cutting-edge technology, expert radiologists,
                    and compassionate care for accurate diagnoses and better health outcomes.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('appointments') }}"
                       class="bg-white text-blue-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition-all transform hover:-translate-y-1 shadow-2xl inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book Appointment
                    </a>

                    <a href="{{ route('contact') }}"
                       class="border-2 border-white/90 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all inline-flex items-center justify-center">
                        <i class="fas fa-phone-alt mr-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>

        <!-- Hero Images Grid -->
        <div class="container mx-auto px-6 pb-16 hero-images grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach (['1.jpg','2.jpg','3.jpg','4.jpg'] as $img)
                <button type="button"
                        class="group h-64 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:scale-[1.03] cursor-zoom-in reveal"
                        data-lightbox-src="{{ asset('images/'.$img) }}"
                        aria-label="View image {{ $loop->iteration }}">
                    <img src="{{ asset('images/'.$img) }}"
                         alt="Medical Imaging {{ $loop->iteration }}"
                         class="w-full h-full object-cover group-hover:scale-[1.05] transition duration-500"
                         loading="lazy">
                </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center reveal">
                <div class="text-5xl font-bold text-blue-700 mb-2 stat-number" data-target="10000">0</div>
                <div class="text-gray-600">Patients Served</div>
            </div>

            <div class="text-center reveal">
                <div class="text-5xl font-bold text-teal-600 mb-2 stat-number" data-target="24">0</div>
                <div class="text-gray-600">Emergency Services</div>
            </div>

            <div class="text-center reveal">
                <div class="text-5xl font-bold text-blue-700 mb-2 stat-number" data-target="99.8">0</div>
                <div class="text-gray-600">Accuracy Rate (%)</div>
            </div>

            <div class="text-center reveal">
                <div class="text-5xl font-bold text-teal-600 mb-2 stat-number" data-target="30">0</div>
                <div class="text-gray-600">Average Wait Time (min)</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="medical-gradient-light py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <h2 class="font-heading text-4xl font-bold text-gray-900 mb-4">Our Advanced Services</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                State-of-the-art imaging technology for comprehensive diagnostics.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ([
                ['icon'=>'fa-mri','title'=>'MRI Scanning','desc'=>'High-resolution magnetic resonance imaging for detailed soft tissue analysis.','id'=>'mri'],
                ['icon'=>'fa-x-ray','title'=>'CT Scan','desc'=>'Computed tomography for cross-sectional imaging and 3D reconstruction.','id'=>'ct'],
                ['icon'=>'fa-heartbeat','title'=>'Ultrasound','desc'=>'Real-time imaging for obstetrics, cardiology, and abdominal diagnostics.','id'=>'ultrasound'],
            ] as $service)
            <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow reveal">
                <div class="text-blue-600 text-4xl mb-4">
                    <i class="fas {{ $service['icon'] }}"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3">{{ $service['title'] }}</h3>
                <p class="text-gray-600 mb-6">{{ $service['desc'] }}</p>
                <a href="{{ route('services') }}#{{ $service['id'] }}"
                   class="text-blue-600 font-semibold hover:text-blue-800">
                    Learn More →
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative overflow-hidden py-20 text-white">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-blue-800/75 to-sky-700/70"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6 text-center reveal">
            <h2 class="font-heading text-4xl font-bold mb-6 drop-shadow-[0_10px_30px_rgba(0,0,0,0.4)]">
                Ready for Your Diagnostic Journey?
            </h2>
            <p class="text-xl text-white/95 mb-10 max-w-2xl mx-auto drop-shadow-[0_10px_30px_rgba(0,0,0,0.3)]">
                Book your appointment today and experience healthcare with precision, compassion, and cutting-edge technology.
            </p>

            <a href="https://wa.me/254700000000?text=Hello%2C%20I%20want%20to%20book%20an%20appointment"
               target="_blank" rel="noopener"
               class="bg-white text-blue-900 px-10 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition-all inline-flex items-center justify-center shadow-2xl">
                <i class="fab fa-whatsapp mr-3 text-2xl"></i>
                Chat with Us on WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox-modal"
     class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300 cursor-zoom-out p-6">
    <img id="lightbox-image"
         src=""
         class="max-h-[90%] max-w-[90%] rounded-2xl shadow-2xl"
         alt="Enlarged image">
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal animations
    const items = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });
    items.forEach(el => io.observe(el));

    // Stats count-up
    const counters = document.querySelectorAll('.stat-number');
    const runCounter = (counter) => {
        const target = parseFloat(counter.dataset.target || '0');
        const start = performance.now();
        const duration = 1200;
        const isInt = Number.isInteger(target);

        const tick = (now) => {
            const t = Math.min(1, (now - start) / duration);
            const val = target * t;
            counter.textContent = isInt ? Math.floor(val) : val.toFixed(1);
            if (t < 1) requestAnimationFrame(tick);
            else counter.textContent = isInt ? target.toLocaleString() : target;
        };
        requestAnimationFrame(tick);
    };

    const statsIO = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                counters.forEach(runCounter);
                statsIO.disconnect();
            }
        });
    }, { threshold: 0.25 });

    if (counters.length) statsIO.observe(counters[0]);

    // Lightbox
    const lightbox = document.getElementById('lightbox-modal');
    const img = document.getElementById('lightbox-image');

    document.querySelectorAll('[data-lightbox-src]').forEach(el => {
        el.addEventListener('click', () => {
            img.src = el.dataset.lightboxSrc;
            lightbox.classList.remove('opacity-0', 'pointer-events-none');
        });
    });

    lightbox.addEventListener('click', () => {
        lightbox.classList.add('opacity-0', 'pointer-events-none');
        img.src = '';
    });
});
</script>
@endpush
