<nav x-data="{ mobileMenuOpen: false }"
     x-init="setTimeout(() => $el.classList.add('nav-loaded'), 50)"
     class="nav-root sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm
            opacity-0 -translate-y-2 transition-all duration-500">

    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="medical-gradient w-11 h-11 rounded-xl flex items-center justify-center
                            group-hover:scale-105 transition">
                    <i class="fas fa-brain text-white text-xl"></i>
                </div>
                <div class="leading-tight">
                    <div class="font-heading text-xl font-bold text-gray-900">
                        Precise Diagnostics
                    </div>
                    <div class="text-xs text-blue-600 font-medium tracking-wide">
                        Imaging Excellence
                    </div>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-8">

                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->routeIs('home') ? 'nav-active' : '' }}">
                    Home
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link {{ request()->routeIs('about') ? 'nav-active' : '' }}">
                    About Us
                </a>

                <a href="{{ route('services') }}"
                   class="nav-link {{ request()->routeIs('services') ? 'nav-active' : '' }}">
                    Services
                </a>

                <a href="{{ route('contact') }}"
                   class="nav-link {{ request()->routeIs('contact') ? 'nav-active' : '' }}">
                    Contact
                </a>

                <!-- Primary CTA -->
                <a href="{{ route('appointments') }}" class="btn-primary nav-cta">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Book Appointment
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                aria-label="Toggle menu"
                class="lg:hidden text-gray-700 hover:text-blue-600 focus:outline-none transition">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden bg-white border-t border-gray-100 py-4">

            <a href="{{ route('home') }}" class="mobile-nav-link">Home</a>
            <a href="{{ route('about') }}" class="mobile-nav-link">About Us</a>
            <a href="{{ route('services') }}" class="mobile-nav-link">Services</a>
            <a href="{{ route('contact') }}" class="mobile-nav-link">Contact</a>

            <a href="{{ route('appointments') }}"
               class="btn-primary block text-center mt-3">
                Book Appointment
            </a>
        </div>
    </div>
</nav>

<style>
/* ===== NAV ENTRY ANIMATION ===== */
.nav-loaded {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

/* ===== NAV LINKS ===== */
.nav-link {
    @apply font-bold text-gray-800 transition-colors duration-300;
}

.nav-link:hover {
    color: #2563eb;
}

.nav-active {
    color: #2563eb;
}

/* ===== MOBILE LINKS ===== */
.mobile-nav-link {
    @apply block px-4 py-3 font-bold text-gray-700
           hover:bg-gray-50 hover:text-blue-600 transition;
}

/* ===== PRIMARY BUTTON ===== */
.btn-primary {
    @apply px-5 py-2.5 rounded-lg font-bold text-white
           bg-gradient-to-r from-blue-600 to-teal-600
           hover:shadow-lg hover:-translate-y-0.5
           transition inline-flex items-center justify-center;
}

/* ===== CTA MICRO-ANIMATION ===== */
.nav-cta {
    animation: subtlePulse 3s infinite;
}

.nav-cta:hover {
    animation: none;
}

/* ===== KEYFRAMES ===== */
@keyframes subtlePulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.25); }
    50% { box-shadow: 0 0 0 10px rgba(37, 99, 235, 0); }
}
</style>
