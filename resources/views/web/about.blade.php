{{-- resources/views/web/about.blade.php --}}
@extends('layouts.web')

@section('title', 'About Us | Precise Diagnostics Imaging')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden text-white">
    <div class="absolute inset-0 about-hero-bg"></div>
    <div class="absolute inset-0 opacity-[0.10] hero-grid"></div>

    <!-- Soft blobs -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-sky-400/20 rounded-full blur-3xl animate-float-slow"></div>
    <div class="absolute top-20 -right-24 w-[28rem] h-[28rem] bg-blue-500/20 rounded-full blur-3xl animate-float"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6 py-24">
            <div class="max-w-4xl mx-auto text-center">
                <div class="reveal" data-reveal="up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                        <span class="text-sm font-semibold tracking-wide text-white/90">Established 2013 • Nairobi, Kenya</span>
                    </div>

                    <h1 class="font-heading text-5xl md:text-6xl font-extrabold mb-6 drop-shadow-[0_12px_40px_rgba(0,0,0,0.45)]">
                        About <span class="text-yellow-300">Precise Diagnostics</span>
                    </h1>

                    <p class="text-xl text-white/95 leading-relaxed drop-shadow-[0_10px_30px_rgba(0,0,0,0.35)]">
                        Leading medical imaging excellence since 2013.
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
                        @php
                            $stats = [
                                ['label' => 'Years of Excellence', 'value' => 12, 'suffix' => '+'],
                                ['label' => 'Patients Served', 'value' => 10000, 'suffix' => '+'],
                                ['label' => 'Accuracy Rate', 'value' => 99.8, 'suffix' => '%'],
                                ['label' => 'Service Availability', 'value' => 24, 'suffix' => '/7'],
                            ];
                        @endphp

                        @foreach ($stats as $s)
                            <div class="hero-stat reveal" data-reveal="up">
                                <div class="text-3xl md:text-4xl font-extrabold tracking-tight">
                                    <span class="stat-number" data-target="{{ $s['value'] }}">0</span>
                                    <span class="opacity-95">{{ $s['suffix'] }}</span>
                                </div>
                                <div class="mt-2 text-sm text-white/85">{{ $s['label'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 flex justify-center">
                        <a href="#about-content"
                           class="inline-flex items-center gap-2 text-white/90 hover:text-white transition font-semibold">
                            Scroll to explore
                            <i class="fas fa-chevron-down animate-bounce-slow"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTENT -->
<section id="about-content" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">

            <!-- Intro -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div class="reveal" data-reveal="up">
                    <h2 class="font-heading text-4xl font-extrabold text-slate-900 mb-6">
                        Get to Know <span class="text-blue-700">Us</span>
                    </h2>

                    <div class="space-y-4 text-lg text-slate-600 leading-relaxed">
                        <p>
                            <span class="font-bold text-slate-900">Precise Diagnostic Imaging Centre</span> was established in 2013.
                            We are dedicated to delivering high-quality, cost-effective, and accessible diagnostic imaging services in Kenya.
                        </p>
                        <p>
                            We use modern technology to support accurate diagnosis while providing one-on-one patient care,
                            guided by professional standards and compassionate service.
                        </p>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('services') }}"
                           class="btn-solid-blue inline-flex items-center justify-center rounded-xl px-6 py-3 font-bold text-white shadow-lg">
                            Explore Services <span class="ml-2">→</span>
                        </a>

                        <a href="{{ route('appointments') }}"
                           class="btn-soft inline-flex items-center justify-center rounded-xl px-6 py-3 font-bold text-slate-900">
                            Book Appointment
                        </a>
                    </div>
                </div>

                <!-- Illustration card -->
                <div class="reveal" data-reveal="up">
                    <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-blue-50 to-teal-50 p-8 shadow-xl hover:shadow-2xl transition">
                        <div class="rounded-2xl bg-gradient-to-br from-blue-600 to-teal-500 h-56 flex items-center justify-center shadow-inner relative overflow-hidden">
                            <div class="absolute inset-0 opacity-[0.15] hero-grid"></div>
                            <i class="fas fa-hospital-alt text-white text-7xl relative z-10"></i>
                        </div>
                        <div class="mt-6 text-center">
                            <span class="inline-flex items-center gap-2 rounded-full bg-blue-700 text-white px-5 py-2 font-bold shadow-lg">
                                <i class="fas fa-calendar-alt"></i> Since 2013
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission / Vision -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">
                <div class="reveal card-hover rounded-3xl border border-slate-200 bg-white p-8 shadow-lg" data-reveal="up">
                    <div class="w-14 h-14 rounded-2xl bg-blue-700 text-white flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="font-heading text-2xl font-extrabold text-slate-900 mb-3">Mission</h3>
                    <p class="text-slate-600 leading-relaxed">
                        To provide complete and accurate radiological investigations with a commitment to technological innovation,
                        compassionate patient care, and responsive relationships with the healthcare community.
                    </p>
                </div>

                <div class="reveal card-hover rounded-3xl border border-slate-200 bg-white p-8 shadow-lg" data-reveal="up">
                    <div class="w-14 h-14 rounded-2xl bg-teal-600 text-white flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="font-heading text-2xl font-extrabold text-slate-900 mb-3">Vision</h3>
                    <p class="text-slate-600 leading-relaxed">
                        To be a leading radiological centre in Kenya and East Africa, offering high-quality professional services
                        with strong ethical standards.
                    </p>
                    <div class="mt-5 flex gap-1 text-yellow-500">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <!-- Values -->
            <div class="mb-20">
                <div class="text-center mb-12 reveal" data-reveal="up">
                    <h2 class="font-heading text-4xl font-extrabold text-slate-900">
                        Our <span class="text-blue-700">Core Values</span>
                    </h2>
                    <p class="text-slate-600 mt-3 max-w-2xl mx-auto">
                        The standards that guide our work, our ethics, and our patient experience.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $values = [
                            ['title'=>'Dedication', 'icon'=>'fa-heart', 'color'=>'text-rose-600', 'bg'=>'bg-rose-50',
                             'text'=>"We commit to medical excellence and reliable support for physicians and patients, ensuring every visit is handled with care and professionalism."],
                            ['title'=>'Innovation', 'icon'=>'fa-lightbulb', 'color'=>'text-blue-700', 'bg'=>'bg-blue-50',
                             'text'=>"We stay at the forefront of imaging technology and continuous learning to deliver fast, accurate, high-quality results."],
                            ['title'=>'Compassion', 'icon'=>'fa-hands-helping', 'color'=>'text-emerald-600', 'bg'=>'bg-emerald-50',
                             'text'=>"We provide a calm, respectful environment and guide patients through every step—from scheduling to results."],
                        ];
                    @endphp

                    @foreach ($values as $v)
                        <div class="reveal card-hover rounded-3xl border border-slate-200 bg-white p-8 shadow-lg" data-reveal="up">
                            <div class="w-16 h-16 rounded-2xl {{ $v['bg'] }} flex items-center justify-center text-3xl mb-6">
                                <i class="fas {{ $v['icon'] }} {{ $v['color'] }}"></i>
                            </div>
                            <h3 class="font-heading text-2xl font-extrabold text-slate-900 mb-3">{{ $v['title'] }}</h3>
                            <p class="text-slate-600 leading-relaxed">{{ $v['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Commitment -->
            <div class="reveal rounded-3xl border border-slate-200 bg-gradient-to-r from-blue-50 to-teal-50 p-10 mb-20 shadow-lg" data-reveal="up">
                <div class="max-w-3xl mx-auto text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white shadow-md mb-6">
                        <i class="fas fa-handshake text-3xl text-blue-700"></i>
                    </div>
                    <h2 class="font-heading text-3xl font-extrabold text-slate-900 mb-4">Our Commitment</h2>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        We cover the complexities and continuous developments in radiology and imaging,
                        with a focus on quality assurance, patient privacy, and timely reporting.
                    </p>
                </div>
            </div>

            <!-- Testimonials & Visit -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Testimonials -->
                <div class="reveal" data-reveal="up">
                    <h2 class="font-heading text-3xl font-extrabold text-slate-900 mb-8">
                        What <span class="text-blue-700">Clients Say</span>
                    </h2>

                    <div class="space-y-6">
                        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-lg card-hover">
                            <p class="text-slate-600 text-lg italic leading-relaxed">
                                “Our expectation is that our clients will view us as a tried-and-true clinical centre of excellence.”
                            </p>
                            <div class="mt-5 flex items-center justify-between">
                                <div class="flex gap-1 text-yellow-500">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <div class="text-sm font-semibold text-slate-700">Client Feedback</div>
                            </div>
                        </div>

                        <div class="rounded-3xl border border-yellow-200 bg-yellow-50 p-8 card-hover">
                            <h3 class="font-heading text-xl font-extrabold text-slate-900 mb-3 flex items-center gap-3">
                                <i class="fab fa-google text-blue-700 text-2xl"></i>
                                Leave us a review on Google
                            </h3>
                            <p class="text-slate-600 mb-5">
                                We value your feedback. It helps us improve our services and patient experience.
                            </p>

                            {{-- Replace the link below with your real Google review link --}}
                            <a href="#"
                               class="btn-solid-blue inline-flex w-full items-center justify-center rounded-xl px-6 py-3 font-bold text-white">
                                <i class="fab fa-google mr-2"></i> Write a Review
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Visit / Contact -->
                <div class="reveal" data-reveal="up">
                    <h2 class="font-heading text-3xl font-extrabold text-slate-900 mb-8">
                        Contact & <span class="text-teal-600">Visit Us</span>
                    </h2>

                    <div class="rounded-3xl border border-slate-200 bg-white shadow-xl overflow-hidden card-hover">
                        <div class="h-52 bg-gradient-to-r from-blue-600 to-teal-500 relative">
                            <div class="absolute inset-0 opacity-[0.14] hero-grid"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-6xl"></i>
                            </div>
                            <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur px-4 py-2 rounded-lg">
                                <span class="font-bold text-blue-700">Nairobi, Kenya</span>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl flex-shrink-0">
                                        <i class="fas fa-map-pin"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 mb-1">Physical Address</h3>
                                        <p class="text-slate-600">
                                            5th Avenue Office Suites, Fifth Ngong Avenue<br>
                                            3rd Floor Suite No. 317<br>
                                            P.O. Box 39471 – 00623, Nairobi
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl flex-shrink-0">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 mb-1">Phone Numbers</h3>
                                        <p class="text-slate-600">
                                            <a class="hover:text-blue-700 font-semibold" href="tel:+254207856359">+254 207 856 359</a><br>
                                            <a class="hover:text-blue-700 font-semibold" href="tel:+254791903552">+254 791 903 552</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl flex-shrink-0">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 mb-1">Email</h3>
                                        <p class="text-slate-600">
                                            <a class="hover:text-blue-700 font-semibold" href="mailto:info@precisediagnostic.co.ke">info@precisediagnostic.co.ke</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <a target="_blank" rel="noopener"
                                   href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode('5th Avenue Office Suites, Fifth Ngong Avenue, Nairobi') }}"
                                   class="btn-soft inline-flex items-center justify-center rounded-xl px-5 py-3 font-bold text-slate-900">
                                    <i class="fas fa-directions mr-2"></i> Get Directions
                                </a>

                                <a href="tel:+254207856359"
                                   class="btn-solid-blue inline-flex items-center justify-center rounded-xl px-5 py-3 font-bold text-white">
                                    <i class="fas fa-phone mr-2"></i> Call Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="relative overflow-hidden py-20 text-white">
    <div class="absolute inset-0 about-cta-bg"></div>
    <div class="absolute inset-0 opacity-[0.10] hero-grid"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-6 text-center reveal" data-reveal="up">
            <h2 class="font-heading text-4xl font-extrabold mb-6 drop-shadow-[0_10px_30px_rgba(0,0,0,0.35)]">
                Ready to Experience Precision?
            </h2>
            <p class="text-xl text-white/95 mb-10 max-w-2xl mx-auto drop-shadow-[0_10px_30px_rgba(0,0,0,0.25)]">
                Join thousands of satisfied patients who trust us with their diagnostic needs.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('appointments') }}"
                   class="btn-primary inline-flex items-center justify-center px-8 py-4 rounded-xl font-bold text-lg shadow-2xl">
                    <i class="fas fa-calendar-check mr-2"></i> Book Appointment
                </a>

                <a href="{{ route('contact') }}"
                   class="border-2 border-white/90 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all inline-flex items-center justify-center">
                    <i class="fas fa-directions mr-2"></i> Visit Our Clinic
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
@media (prefers-reduced-motion: reduce) {
    .reveal, .animate-float, .animate-float-slow, .animate-bounce-slow { animation: none !important; transition: none !important; }
}

/* Backgrounds matching Home feel */
.about-hero-bg{
    background: radial-gradient(1200px 600px at 20% 10%, rgba(56,189,248,.25), transparent 55%),
                radial-gradient(900px 500px at 85% 20%, rgba(99,102,241,.18), transparent 55%),
                linear-gradient(135deg, rgba(2,6,23,.95), rgba(30,64,175,.80), rgba(14,116,144,.78));
}
.about-cta-bg{
    background: radial-gradient(900px 500px at 30% 20%, rgba(56,189,248,.20), transparent 60%),
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
@keyframes float { 0%,100%{ transform:translateY(0)} 50%{ transform:translateY(-14px)} }
.animate-bounce-slow { animation: bounceSlow 2.2s ease-in-out infinite; }
@keyframes bounceSlow { 0%,100%{ transform: translateY(0)} 50%{ transform: translateY(6px)} }

/* Reveal */
.reveal{ opacity:0; transform: translateY(18px); transition: opacity .8s cubic-bezier(.2,.8,.2,1), transform .8s cubic-bezier(.2,.8,.2,1); }
.reveal.is-visible{ opacity:1; transform: translateY(0); }

/* Hero stat card */
.hero-stat{
    border-radius: 1rem;
    border: 1px solid rgba(255,255,255,.15);
    background: rgba(255,255,255,.10);
    backdrop-filter: blur(12px);
    padding: 1.1rem .9rem;
}

/* Buttons (same feel as Home) */
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
.btn-solid-blue{
    background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
    transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
}
.btn-solid-blue:hover{
    transform: translateY(-2px);
    filter: brightness(1.02);
    box-shadow: 0 18px 50px rgba(15,23,42,.20);
}
.btn-soft{
    background: #ffffff;
    border: 1px solid rgba(15,23,42,.12);
    box-shadow: 0 16px 40px rgba(15,23,42,.06);
    transition: transform .25s ease, box-shadow .25s ease;
}
.btn-soft:hover{
    transform: translateY(-2px);
    box-shadow: 0 22px 60px rgba(15,23,42,.10);
}

/* Card hover */
.card-hover{ transition: transform .25s ease, box-shadow .25s ease; }
.card-hover:hover{ transform: translateY(-6px); box-shadow: 0 26px 70px rgba(15,23,42,.14); }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Reveal animations
    const els = document.querySelectorAll('.reveal');
    if (!prefersReduced) {
        els.forEach((el, i) => { el.style.transitionDelay = `${Math.min(i * 55, 260)}ms`; });
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        els.forEach(el => io.observe(el));
    } else {
        els.forEach(el => el.classList.add('is-visible'));
    }

    // Counter (hero stats) once
    const nums = document.querySelectorAll('.stat-number');
    const format = (n, d=0) => Number(n).toLocaleString(undefined, { minimumFractionDigits:d, maximumFractionDigits:d });

    const animateNum = (el) => {
        const raw = el.dataset.target || '0';
        const target = parseFloat(raw);
        const decimals = raw.includes('.') ? raw.split('.')[1].length : 0;

        const start = performance.now();
        const duration = 1100;

        const tick = (now) => {
            const t = Math.min(1, (now - start) / duration);
            const eased = 1 - Math.pow(1 - t, 3);
            const val = target * eased;
            el.textContent = format(val, decimals);
            if (t < 1) requestAnimationFrame(tick);
            else el.textContent = format(target, decimals);
        };

        requestAnimationFrame(tick);
    };

    const hero = document.querySelector('section.relative.overflow-hidden.text-white');
    if (hero && nums.length && !prefersReduced) {
        const counterIO = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    nums.forEach(animateNum);
                    counterIO.disconnect();
                }
            });
        }, { threshold: 0.35 });

        counterIO.observe(hero);
    } else if (nums.length) {
        nums.forEach(el => {
            const raw = el.dataset.target || '0';
            const decimals = raw.includes('.') ? raw.split('.')[1].length : 0;
            el.textContent = Number(raw).toLocaleString(undefined, { minimumFractionDigits:decimals, maximumFractionDigits:decimals });
        });
    }
});
</script>
@endpush
