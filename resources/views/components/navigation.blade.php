<!-- resources/views/components/navigation.blade.php -->
<nav x-data="{ mobileMenuOpen: false, userMenuOpen: false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="medical-gradient w-12 h-12 rounded-2xl flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-brain text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="font-heading text-2xl font-bold text-gray-900 leading-tight">Precise Diagnostics</div>
                        <div class="text-sm text-blue-600 font-medium tracking-wide">Imaging Excellence</div>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
                <a href="{{ route('about') }}" class="nav-link">
                    <i class="fas fa-info-circle mr-2"></i>About Us
                </a>
                
                <!-- Services Dropdown -->
                <div class="relative group">
                    <button class="nav-link">
                        <i class="fas fa-procedures mr-2"></i>Services <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform -translate-y-2 group-hover:translate-y-0 z-50">
                        <div class="p-4">
                            <a href="{{ route('services') }}#mri" class="dropdown-item">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-magnet text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="font-semibold">MRI Scanning</div>
                                    <div class="text-xs text-gray-500">Advanced 3T Technology</div>
                                </div>
                            </a>
                            <a href="{{ route('services') }}#ct" class="dropdown-item mt-3">
                                <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-x-ray text-teal-600"></i>
                                </div>
                                <div>
                                    <div class="font-semibold">CT Scan</div>
                                    <div class="text-xs text-gray-500">128-Slice Scanner</div>
                                </div>
                            </a>
                            <a href="{{ route('services') }}#ultrasound" class="dropdown-item mt-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-wave-square text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="font-semibold">Ultrasound</div>
                                    <div class="text-xs text-gray-500">4D & Doppler</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('appointments') }}" class="nav-link bg-gradient-to-r from-blue-600 to-teal-600 text-white hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-calendar-alt mr-2"></i>Book Appointment
                </a>
                
                <a href="{{ route('contact') }}" class="nav-link">
                    <i class="fas fa-phone-alt mr-2"></i>Contact
                </a>

                <!-- Emergency Badge -->
                <div class="ml-4 relative group">
                    <div class="flex items-center space-x-2 bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-full cursor-pointer hover:bg-red-100 transition">
                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                        <span class="font-bold"><i class="fas fa-ambulance mr-1"></i>Emergency</span>
                        <i class="fas fa-phone text-sm"></i>
                    </div>
                    <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <div class="p-4">
                            <div class="font-bold text-gray-900 mb-2">Emergency Contacts</div>
                            <a href="tel:+1234567890" class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                <div>
                                    <div class="font-semibold">Ambulance</div>
                                    <div class="text-sm text-gray-500">24/7 Service</div>
                                </div>
                                <div class="text-blue-600 font-bold">+1 (234) 567-890</div>
                            </a>
                            <a href="tel:+1234567891" class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                <div>
                                    <div class="font-semibold">Emergency Dept</div>
                                    <div class="text-sm text-gray-500">Direct Line</div>
                                </div>
                                <div class="text-blue-600 font-bold">+1 (234) 567-891</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-gray-700 hover:text-blue-600 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden bg-white border-t border-gray-100 py-4">
            <div class="container mx-auto px-4">
                <a href="{{ route('home') }}" class="mobile-nav-link">
                    <i class="fas fa-home mr-3"></i>Home
                </a>
                <a href="{{ route('about') }}" class="mobile-nav-link">
                    <i class="fas fa-info-circle mr-3"></i>About Us
                </a>
                <a href="{{ route('services') }}" class="mobile-nav-link">
                    <i class="fas fa-procedures mr-3"></i>Services
                </a>
                <a href="{{ route('appointments') }}" class="mobile-nav-link bg-blue-600 text-white rounded-lg">
                    <i class="fas fa-calendar-alt mr-3"></i>Book Appointment
                </a>
                <a href="{{ route('contact') }}" class="mobile-nav-link">
                    <i class="fas fa-phone-alt mr-3"></i>Contact
                </a>
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <div class="text-sm font-semibold text-gray-500 mb-3">Emergency Contacts</div>
                    <a href="tel:+1234567890" class="flex items-center justify-between p-3 bg-red-50 rounded-lg mb-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3 animate-pulse"></div>
                            <div>
                                <div class="font-bold text-red-700">Ambulance</div>
                                <div class="text-sm text-red-600">+1 (234) 567-890</div>
                            </div>
                        </div>
                        <i class="fas fa-phone text-red-600"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        @apply px-5 py-2.5 rounded-lg font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center;
    }
    .nav-link-active {
        @apply text-blue-600 bg-blue-50;
    }
    .dropdown-item {
        @apply flex items-center p-3 rounded-lg hover:bg-gray-50 transition;
    }
    .mobile-nav-link {
        @apply block py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition mb-1 flex items-center;
    }
</style>