<!-- resources/views/components/footer.blade.php -->
<footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-white pt-16 pb-8">
    <div class="container mx-auto px-6">
        
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 mb-16">
            
            <!-- Clinic Info -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="medical-gradient w-14 h-14 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-brain text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="font-heading text-2xl font-bold">Precise Diagnostics</div>
                        <div class="text-blue-300 text-sm">Imaging Excellence</div>
                    </div>
                </div>
                <p class="text-gray-300 leading-relaxed">
                    Providing advanced medical imaging services with cutting-edge technology, 
                    expert radiologists, and compassionate care since 2010.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="social-icon bg-blue-600 hover:bg-blue-700">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon bg-sky-500 hover:bg-sky-600">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon bg-pink-600 hover:bg-pink-700">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon bg-green-600 hover:bg-green-700">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" class="social-icon bg-blue-700 hover:bg-blue-800">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-heading text-xl font-bold mb-6 pb-3 border-b border-blue-800">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="footer-link"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i>Home</a></li>
                    <li><a href="{{ route('about') }}" class="footer-link"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i>About Us</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i>Our Services</a></li>
                    <li><a href="{{ route('appointments') }}" class="footer-link"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i>Book Appointment</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i>Contact Us</a></li>
                </ul>
            </div>

            <!-- Our Services -->
            <div>
                <h3 class="font-heading text-xl font-bold mb-6 pb-3 border-b border-blue-800">Our Services</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('services') }}#mri" class="footer-link"><i class="fas fa-magnet text-blue-400 mr-2"></i>MRI Scanning</a></li>
                    <li><a href="{{ route('services') }}#ct" class="footer-link"><i class="fas fa-x-ray text-teal-400 mr-2"></i>CT Scan</a></li>
                    <li><a href="{{ route('services') }}#ultrasound" class="footer-link"><i class="fas fa-wave-square text-blue-400 mr-2"></i>Ultrasound</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link"><i class="fas fa-plus-circle text-green-400 mr-2"></i>View All Services</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="font-heading text-xl font-bold mb-6 pb-3 border-b border-blue-800">Contact Info</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <div class="bg-blue-900/50 p-3 rounded-lg mr-4">
                            <i class="fas fa-map-marker-alt text-blue-300"></i>
                        </div>
                        <div>
                            <div class="font-semibold">Our Location</div>
                            <div class="text-gray-300 text-sm">123 Medical Plaza, Healthcare District<br>Nairobi, Kenya</div>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-blue-900/50 p-3 rounded-lg mr-4">
                            <i class="fas fa-phone-alt text-blue-300"></i>
                        </div>
                        <div>
                            <div class="font-semibold">Phone Numbers</div>
                            <div class="text-gray-300 text-sm">
                                <div>Appointments: <a href="tel:+254712345678" class="hover:text-blue-300">+254 712 345 678</a></div>
                                <div>Emergency: <a href="tel:+254711999888" class="hover:text-red-300">+254 711 999 888</a></div>
                            </div>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-blue-900/50 p-3 rounded-lg mr-4">
                            <i class="fas fa-envelope text-blue-300"></i>
                        </div>
                        <div>
                            <div class="font-semibold">Email Address</div>
                            <div class="text-gray-300 text-sm">
                                <a href="mailto:info@precisediagnostics.co.ke" class="hover:text-blue-300">info@precisediagnostics.co.ke</a><br>
                                <a href="mailto:emergency@precisediagnostics.co.ke" class="hover:text-red-300">emergency@precisediagnostics.co.ke</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Emergency Banner -->
        <div class="bg-gradient-to-r from-red-900 to-red-800 border border-red-700 rounded-2xl p-6 mb-10 shadow-2xl">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="flex items-center mb-4 lg:mb-0">
                    <div class="bg-white p-4 rounded-xl mr-4">
                        <i class="fas fa-ambulance text-red-600 text-3xl"></i>
                    </div>
                    <div>
                        <div class="font-heading text-xl font-bold">24/7 Emergency Services</div>
                        <div class="text-red-200">Immediate medical imaging for emergency cases</div>
                    </div>
                </div>
                <a href="tel:+254711999888" class="bg-white text-red-700 font-bold px-8 py-3 rounded-xl hover:bg-gray-100 transition flex items-center">
                    <i class="fas fa-phone-volume mr-3 text-xl"></i>
                    CALL EMERGENCY: +254 711 999 888
                </a>
            </div>
        </div>

        <!-- Copyright & Links -->
        <div class="pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; 2025 Precise Diagnostics Imaging Ltd. All rights reserved.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Sitemap</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Careers</a>
                </div>
            </div>
        </div>

    </div>
</footer>

<style>
    .footer-link {
        @apply text-gray-300 hover:text-white transition flex items-center hover:translate-x-1 duration-300;
    }
    
    .social-icon {
        @apply w-10 h-10 rounded-full flex items-center justify-center text-white transition transform hover:-translate-y-1 duration-300;
    }
    
    /* Animation for emergency banner */
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(220, 38, 38, 0.5); }
        50% { box-shadow: 0 0 30px rgba(220, 38, 38, 0.8); }
    }
    
    .emergency-banner {
        animation: pulse-glow 2s infinite;
    }
</style>

<script>
    // Add pulsing animation to emergency banner
    document.addEventListener('DOMContentLoaded', function() {
        const emergencyBanner = document.querySelector('.bg-gradient-to-r.from-red-900');
        if (emergencyBanner) {
            emergencyBanner.classList.add('emergency-banner');
        }
    });
</script>