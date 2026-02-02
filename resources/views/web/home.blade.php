{{-- resources/views/web/home.blade.php --}}
@extends('layouts.web')

@section('title', 'Home - Precise Diagnostics Imaging')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden text-white">
    <!-- Animated gradient background -->
    <div class="absolute inset-0 medical-hero-bg"></div>

    <!-- Subtle grid overlay -->
    <div class="absolute inset-0 opacity-[0.10] hero-grid"></div>

    <!-- Decorative blobs -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-400/25 rounded-full blur-3xl animate-float-slow"></div>
    <div class="absolute top-24 -right-32 w-[28rem] h-[28rem] bg-blue-500/20 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-[-10rem] left-1/2 -translate-x-1/2 w-[40rem] h-[40rem] bg-indigo-500/10 rounded-full blur-3xl animate-pulse-soft"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6 pt-28 pb-12">
            <div class="max-w-5xl mx-auto text-center">
                <div class="reveal" data-reveal="up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                        <span class="text-sm font-semibold tracking-wide text-white/90">Trusted Diagnostic Imaging in Kenya</span>
                    </div>

                    <h1 class="font-heading text-5xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-[0_12px_40px_rgba(0,0,0,0.45)]">
                        Precision in Every <span class="text-yellow-300">Diagnosis</span>
                    </h1>

                    <p class="text-xl md:text-[1.35rem] mb-10 text-white/95 leading-relaxed drop-shadow-[0_10px_30px_rgba(0,0,0,0.35)]">
                        Advanced medical imaging with cutting-edge technology, expert radiologists,
                        and compassionate care for accurate diagnoses and better health outcomes.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('appointments') }}"
                           class="btn-primary group inline-flex items-center justify-center px-8 py-4 rounded-xl font-bold text-lg shadow-2xl">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Book Appointment
                            <span class="ml-2 inline-block transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </a>

                        <a href="{{ route('contact') }}"
                           class="btn-ghost inline-flex items-center justify-center px-8 py-4 rounded-xl font-bold text-lg border-2 border-white/90 hover:bg-white/10 transition-all">
                            <i class="fas fa-phone-alt mr-2"></i> Contact Us
                        </a>
                    </div>

                    <!-- trust chips -->
                    <div class="mt-10 flex flex-wrap gap-3 justify-center text-white/90">
                        <div class="chip">
                            <i class="fas fa-shield-alt"></i> Secure & Confidential
                        </div>
                        <div class="chip">
                            <i class="fas fa-user-md"></i> Expert Radiologists
                        </div>
                        <div class="chip">
                            <i class="fas fa-bolt"></i> Fast Turnaround
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- HERO IMAGES -->
        <div class="container mx-auto px-6 pb-16">
            <div class="hero-images grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach (['1.jpg','2.jpg','3.jpg','4.jpg'] as $img)
                    <button type="button"
                            class="image-card group h-64 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:scale-[1.03] cursor-zoom-in reveal"
                            data-reveal="up"
                            data-lightbox-src="{{ asset('images/'.$img) }}"
                            data-lightbox-index="{{ $loop->index }}"
                            aria-label="View image {{ $loop->iteration }}">
                        <img src="{{ asset('images/'.$img) }}"
                             alt="Medical Imaging {{ $loop->iteration }}"
                             class="w-full h-full object-cover group-hover:scale-[1.06] transition duration-700"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-sm font-semibold tracking-wide text-white/95">
                                Diagnostic Imaging
                            </span>
                            <span class="inline-flex items-center gap-2 text-xs bg-white/15 border border-white/15 px-3 py-1 rounded-full backdrop-blur">
                                View <i class="fas fa-search-plus"></i>
                            </span>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach ([
                ['value'=>'10000','label'=>'Patients Served','tone'=>'blue'],
                ['value'=>'24','label'=>'Emergency Services','tone'=>'teal'],
                ['value'=>'99.8','label'=>'Accuracy Rate (%)','tone'=>'blue'],
                ['value'=>'30','label'=>'Average Wait Time (min)','tone'=>'teal'],
            ] as $stat)
                <div class="text-center reveal" data-reveal="up">
                    <div class="stat-card">
                        <div class="text-5xl font-extrabold mb-2 stat-number {{ $stat['tone'] === 'blue' ? 'text-blue-700' : 'text-teal-600' }}"
                             data-target="{{ $stat['value'] }}">0</div>
                        <div class="text-gray-600 font-medium">{{ $stat['label'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SERVICES PREVIEW -->
<section class="medical-gradient-light py-20 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-10 right-10 w-72 h-72 bg-sky-300/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-6rem] left-10 w-96 h-96 bg-blue-300/15 rounded-full blur-3xl"></div>
    </div>

    <div class="relative container mx-auto px-6">
        <div class="text-center mb-16 reveal" data-reveal="up">
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
                <div class="service-card reveal" data-reveal="up">
                    <div class="service-icon">
                        <i class="fas {{ $service['icon'] }}"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-3 text-gray-900">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $service['desc'] }}</p>

                    <a href="{{ route('services') }}#{{ $service['id'] }}"
                       class="inline-flex items-center gap-2 text-blue-700 font-semibold hover:text-blue-900 transition">
                        Learn More <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </a>

                    <!-- subtle shine -->
                    <span class="card-shine" aria-hidden="true"></span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="relative overflow-hidden py-20 text-white">
    <div class="absolute inset-0 cta-bg"></div>
    <div class="absolute inset-0 opacity-[0.12] hero-grid"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6 text-center reveal" data-reveal="up">
            <h2 class="font-heading text-4xl font-bold mb-6 drop-shadow-[0_10px_30px_rgba(0,0,0,0.4)]">
                Ready for Your Diagnostic Journey?
            </h2>
            <p class="text-xl text-white/95 mb-10 max-w-2xl mx-auto drop-shadow-[0_10px_30px_rgba(0,0,0,0.3)]">
                Book your appointment today and experience healthcare with precision, compassion, and cutting-edge technology.
            </p>

            <a href="https://wa.me/254700000000?text=Hello%2C%20I%20want%20to%20book%20an%20appointment"
               target="_blank" rel="noopener"
               class="btn-primary inline-flex items-center justify-center px-10 py-4 rounded-xl font-bold text-lg shadow-2xl">
                <i class="fab fa-whatsapp mr-3 text-2xl"></i>
                Chat with Us on WhatsApp
            </a>

            <div class="mt-8 text-white/80 text-sm">
                Or call us directly for assistance. We respond fast.
            </div>
        </div>
    </div>
</section>

<!-- LIGHTBOX MODAL -->
<div id="lightbox-modal"
     class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300 p-6">
    <button type="button"
            id="lightbox-close"
            class="absolute top-5 right-5 w-11 h-11 rounded-full bg-white/10 border border-white/15 backdrop-blur flex items-center justify-center text-white hover:bg-white/20 transition"
            aria-label="Close preview">
        <i class="fas fa-times"></i>
    </button>

    <button type="button"
            id="lightbox-prev"
            class="hidden sm:flex absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 border border-white/15 backdrop-blur items-center justify-center text-white hover:bg-white/20 transition"
            aria-label="Previous image">
        <i class="fas fa-chevron-left"></i>
    </button>

    <img id="lightbox-image"
         src=""
         class="max-h-[90%] max-w-[90%] rounded-2xl shadow-2xl select-none"
         alt="Enlarged image">

    <button type="button"
            id="lightbox-next"
            class="hidden sm:flex absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 border border-white/15 backdrop-blur items-center justify-center text-white hover:bg-white/20 transition"
            aria-label="Next image">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

@endsection

@push('styles')
<style>
/* -----------------------------
   Premium Animations + Helpers
------------------------------*/
@media (prefers-reduced-motion: reduce) {
    .reveal, .animate-float, .animate-float-slow, .animate-pulse-soft { animation: none !important; transition: none !important; }
}

/* Backgrounds */
.medical-hero-bg{
    background: radial-gradient(1200px 600px at 20% 10%, rgba(56,189,248,.25), transparent 55%),
                radial-gradient(900px 500px at 85% 20%, rgba(99,102,241,.18), transparent 55%),
                linear-gradient(135deg, rgba(2,6,23,.95), rgba(30,64,175,.80), rgba(14,116,144,.78));
    animation: gradientShift 10s ease-in-out infinite alternate;
}
.cta-bg{
    background: radial-gradient(800px 500px at 30% 20%, rgba(56,189,248,.20), transparent 60%),
                linear-gradient(90deg, rgba(2,6,23,.92), rgba(30,64,175,.78), rgba(14,116,144,.75));
}
.hero-grid{
    background-image:
      linear-gradient(to right, rgba(255,255,255,.35) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(255,255,255,.35) 1px, transparent 1px);
    background-size: 44px 44px;
    mask-image: radial-gradient(circle at 50% 30%, black 0%, transparent 70%);
}

/* Floating */
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-slow { animation: float 10s ease-in-out infinite; }
.animate-pulse-soft { animation: pulseSoft 5s ease-in-out infinite; }

@keyframes float {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-14px); }
}
@keyframes pulseSoft{
  0%,100% { transform: translateX(-50%) scale(1); opacity: .55; }
  50% { transform: translateX(-50%) scale(1.05); opacity: .75; }
}
@keyframes gradientShift{
  0% { filter: saturate(1) contrast(1); }
  100% { filter: saturate(1.12) contrast(1.06); }
}

/* Reveal animation */
.reveal{ opacity: 0; transform: translateY(18px); transition: opacity .8s cubic-bezier(.2,.8,.2,1), transform .8s cubic-bezier(.2,.8,.2,1); }
.reveal.is-visible{ opacity: 1; transform: translateY(0); }
.reveal[data-reveal="up"]{ transform: translateY(22px); }
.reveal[data-reveal="down"]{ transform: translateY(-22px); }
.reveal[data-reveal="left"]{ transform: translateX(22px); }
.reveal[data-reveal="right"]{ transform: translateX(-22px); }

/* Buttons */
.btn-primary{
    background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 45%, #ffffff 100%);
    color: #0b2a5b;
    border: 1px solid rgba(255,255,255,.55);
    transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
}
.btn-primary:hover{
    transform: translateY(-2px);
    filter: brightness(1.02);
    box-shadow: 0 18px 50px rgba(0,0,0,.35);
}
.btn-ghost{ backdrop-filter: blur(10px); }

/* Chips */
.chip{
    display:inline-flex; align-items:center; gap:.5rem;
    padding:.55rem .85rem;
    border-radius:999px;
    background: rgba(255,255,255,.10);
    border: 1px solid rgba(255,255,255,.15);
    backdrop-filter: blur(10px);
    font-weight: 600;
}

/* Image card */
.image-card{ position: relative; }

/* Stat card */
.stat-card{
    border-radius: 1rem;
    padding: 1.25rem 1rem;
    background: linear-gradient(180deg, #ffffff, #f8fafc);
    border: 1px solid rgba(15,23,42,.08);
    box-shadow: 0 18px 45px rgba(15,23,42,.06);
}

/* Service card */
.service-card{
    position: relative;
    overflow: hidden;
    border-radius: 1.25rem;
    padding: 2rem;
    background: rgba(255,255,255,.85);
    border: 1px solid rgba(15,23,42,.08);
    box-shadow: 0 18px 45px rgba(15,23,42,.10);
    backdrop-filter: blur(10px);
    transition: transform .25s ease, box-shadow .25s ease;
}
.service-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 26px 70px rgba(15,23,42,.18);
}
.service-icon{
    width: 3.25rem; height: 3.25rem;
    border-radius: 1rem;
    display:flex; align-items:center; justify-content:center;
    background: linear-gradient(135deg, rgba(37,99,235,.12), rgba(14,165,233,.12));
    color: #2563eb;
    font-size: 1.6rem;
    margin-bottom: 1rem;
    border: 1px solid rgba(37,99,235,.18);
}
.card-shine{
    position:absolute; inset:-1px;
    background: radial-gradient(500px 200px at 20% 0%, rgba(56,189,248,.22), transparent 55%),
                radial-gradient(450px 220px at 90% 10%, rgba(99,102,241,.16), transparent 60%);
    opacity: .0;
    transition: opacity .35s ease;
    pointer-events:none;
}
.service-card:hover .card-shine{ opacity: 1; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Reveal animations (with slight stagger)
    const items = document.querySelectorAll('.reveal');
    if (!prefersReduced) {
        items.forEach((el, i) => { el.style.transitionDelay = `${Math.min(i * 60, 300)}ms`; });
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.15 });
        items.forEach(el => io.observe(el));
    } else {
        items.forEach(el => el.classList.add('is-visible'));
    }

    // Stats count-up (formats nicely, handles decimals)
    const counters = document.querySelectorAll('.stat-number');
    const formatNumber = (n, decimals = 0) => {
        const opts = { minimumFractionDigits: decimals, maximumFractionDigits: decimals };
        return Number(n).toLocaleString(undefined, opts);
    };

    const runCounter = (counter) => {
        const target = parseFloat(counter.dataset.target || '0');
        const decimals = (String(counter.dataset.target || '').includes('.')) ? (String(counter.dataset.target).split('.')[1].length) : 0;
        const start = performance.now();
        const duration = 1200;

        const tick = (now) => {
            const t = Math.min(1, (now - start) / duration);
            const eased = 1 - Math.pow(1 - t, 3); // easeOutCubic
            const val = target * eased;
            counter.textContent = formatNumber(val, decimals);
            if (t < 1) requestAnimationFrame(tick);
            else counter.textContent = formatNumber(target, decimals);
        };
        requestAnimationFrame(tick);
    };

    if (counters.length) {
        const statsIO = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    counters.forEach(runCounter);
                    statsIO.disconnect();
                }
            });
        }, { threshold: 0.25 });

        statsIO.observe(counters[0]);
    }

    // Lightbox (ESC, next/prev, prevent scroll)
    const lightbox = document.getElementById('lightbox-modal');
    const img = document.getElementById('lightbox-image');
    const btnClose = document.getElementById('lightbox-close');
    const btnPrev = document.getElementById('lightbox-prev');
    const btnNext = document.getElementById('lightbox-next');

    const thumbs = Array.from(document.querySelectorAll('[data-lightbox-src]'));
    const sources = thumbs.map(t => t.dataset.lightboxSrc);
    let index = 0;

    const openLightbox = (i) => {
        index = i;
        img.src = sources[index];
        lightbox.classList.remove('opacity-0', 'pointer-events-none');
        document.documentElement.style.overflow = 'hidden';
    };

    const closeLightbox = () => {
        lightbox.classList.add('opacity-0', 'pointer-events-none');
        img.src = '';
        document.documentElement.style.overflow = '';
    };

    const prev = () => openLightbox((index - 1 + sources.length) % sources.length);
    const next = () => openLightbox((index + 1) % sources.length);

    thumbs.forEach((el) => {
        el.addEventListener('click', () => openLightbox(parseInt(el.dataset.lightboxIndex || '0', 10)));
    });

    btnClose?.addEventListener('click', (e) => { e.stopPropagation(); closeLightbox(); });
    btnPrev?.addEventListener('click', (e) => { e.stopPropagation(); prev(); });
    btnNext?.addEventListener('click', (e) => { e.stopPropagation(); next(); });

    lightbox.addEventListener('click', closeLightbox);

    document.addEventListener('keydown', (e) => {
        if (lightbox.classList.contains('pointer-events-none')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') prev();
        if (e.key === 'ArrowRight') next();
    });
});
</script>
@endpush
