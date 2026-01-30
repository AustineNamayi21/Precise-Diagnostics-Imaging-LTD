{{-- resources/views/layouts/web.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Precise Diagnostics Imaging Centre')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'High-quality, cost-effective diagnostic imaging services in Kenya. X-ray, Ultrasound, CT Scan, MRI, and reporting.')">
    <meta name="theme-color" content="#0ea5e9">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        :root{
            --pd-blue: #0ea5e9;     /* sky-500 */
            --pd-blue-deep: #0369a1;/* sky-700 */
            --pd-ink: #0f172a;      /* slate-900 */
        }

        body{
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color: var(--pd-ink);
        }

        .font-heading{
            font-family: Poppins, Inter, system-ui, sans-serif;
        }

        /* ===== GLOBAL BACKGROUND (BLUE, NOT GREY) ===== */
        .page-bg{
            background:
                radial-gradient(1000px 500px at 10% -10%, rgba(14,165,233,.18), transparent 55%),
                radial-gradient(900px 420px at 90% 0%, rgba(34,197,94,.12), transparent 55%),
                radial-gradient(900px 520px at 50% 100%, rgba(56,189,248,.15), transparent 55%),
                linear-gradient(to bottom, #f8fbff, #ffffff);
        }

        /* Reusable hero overlay (BLUE, NOT GREY) */
        .hero-overlay-blue::before{
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(2, 132, 199, 0.55),
                rgba(3, 105, 161, 0.75)
            );
            z-index: 0;
        }

        .hero-overlay-blue > *{
            position: relative;
            z-index: 1;
        }

        .pd-container{
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        .reveal{
            opacity: 0;
            transform: translateY(14px);
            transition: opacity .65s ease, transform .65s ease;
        }

        .reveal.is-visible{
            opacity: 1;
            transform: translateY(0);
        }

        html{ scroll-behavior: smooth; }

        @media (prefers-reduced-motion: reduce){
            .reveal{ transition: none; transform: none; opacity: 1; }
            html{ scroll-behavior: auto; }
        }
    </style>
</head>

<body class="min-h-screen page-bg">

    {{-- Progress bar --}}
    <div id="pd-progress" class="fixed top-0 left-0 h-1 bg-sky-500 z-[60]" style="width:0;"></div>

    {{-- NAV --}}
    @if (view()->exists('components.web.navbar'))
        @include('components.web.navbar')
    @else
        <header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-200">
            <div class="pd-container py-4 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-500/10 flex items-center justify-center">
                        <span class="text-sky-600 font-heading font-extrabold">PD</span>
                    </div>
                    <div>
                        <div class="font-heading font-bold">Precise Diagnostics</div>
                        <div class="text-xs text-slate-500">Imaging Centre</div>
                    </div>
                </a>

                <nav class="hidden md:flex gap-6 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-sky-600">About</a>
                    <a href="{{ route('services') }}" class="hover:text-sky-600">Services</a>
                    <a href="{{ route('contact') }}" class="hover:text-sky-600">Contact</a>
                    <a href="{{ route('appointments') }}"
                       class="px-4 py-2 rounded-xl bg-sky-600 text-white hover:bg-sky-700">
                        Book Appointment
                    </a>
                </nav>
            </div>
        </header>
    @endif

    {{-- MAIN --}}
    <main class="relative">
        @if (session('success'))
            <div class="pd-container pt-6">
                <div class="reveal rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="pd-container pt-6">
                <div class="reveal rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-800">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- FOOTER --}}
    @if (view()->exists('components.web.footer'))
        @include('components.web.footer')
    @else
        <footer class="mt-20 bg-slate-900 text-slate-300">
            <div class="pd-container py-14 grid md:grid-cols-3 gap-10">
                <div>
                    <div class="font-heading text-lg font-bold text-white">
                        Precise Diagnostics Imaging Centre
                    </div>
                    <p class="mt-3 text-sm opacity-80">
                        Advanced, patient-centered diagnostic imaging using modern medical technology.
                    </p>
                </div>

                <div>
                    <div class="font-heading font-semibold text-white mb-3">Quick Links</div>
                    <div class="flex flex-col gap-2 text-sm">
                        <a href="{{ route('about') }}" class="hover:text-sky-400">About</a>
                        <a href="{{ route('services') }}" class="hover:text-sky-400">Services</a>
                        <a href="{{ route('contact') }}" class="hover:text-sky-400">Contact</a>
                        <a href="{{ route('appointments') }}" class="hover:text-sky-400">Appointments</a>
                    </div>
                </div>

                <div>
                    <div class="font-heading font-semibold text-white mb-3">Contact</div>
                    <p class="text-sm opacity-80">
                        Nairobi, Kenya<br>
                        Mon – Sat: 8:00 AM – 3:00 PM
                    </p>
                </div>
            </div>

            <div class="border-t border-white/10">
                <div class="pd-container py-5 text-xs flex justify-between opacity-70">
                    <span>© {{ date('Y') }} Precise Diagnostics Imaging Centre</span>
                    <span>All rights reserved</span>
                </div>
            </div>
        </footer>
    @endif

    {{-- Back to top --}}
    <button id="pd-top"
            class="hidden fixed bottom-6 right-6 bg-white border rounded-xl px-4 py-2 shadow hover:bg-slate-50">
        ↑ Top
    </button>

    @stack('scripts')

    <script>
        // Scroll progress + back to top
        const bar = document.getElementById('pd-progress');
        const topBtn = document.getElementById('pd-top');

        window.addEventListener('scroll', () => {
            const h = document.documentElement;
            const scrolled = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100;
            if (bar) bar.style.width = scrolled + '%';

            if (topBtn) {
                topBtn.classList.toggle('hidden', h.scrollTop < 400);
            }
        });

        if (topBtn) {
            topBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Reveal animation
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    </script>
</body>
</html>
