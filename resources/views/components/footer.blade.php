<footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-white pt-16 pb-8">
    <div class="container mx-auto px-6">

        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 mb-14 footer-reveal">

            <!-- Clinic Info -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="medical-gradient w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fas fa-brain text-white text-xl"></i>
                    </div>
                    <div>
                        <div class="font-heading text-xl font-bold">Precise Diagnostics</div>
                        <div class="text-blue-300 text-sm">Imaging Excellence</div>
                    </div>
                </div>

                <p class="text-gray-400 text-sm leading-relaxed">
                    Providing advanced medical imaging services with modern technology,
                    experienced radiologists, and patient-focused care.
                </p>

                <!-- Socials -->
                <div class="flex space-x-4">
                    <a href="https://facebook.com" target="_blank" class="social-icon" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="social-icon" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="social-icon" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/254712345678" target="_blank" class="social-icon" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" class="social-icon" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="footer-heading">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                    <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link">Services</a></li>
                    <li><a href="{{ route('appointments') }}" class="footer-link">Appointments</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link">Contact</a></li>
                </ul>
            </div>

            <!-- Imaging Services -->
            <div>
                <h3 class="footer-heading">Imaging Services</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('services') }}#mri" class="footer-link">MRI</a></li>
                    <li><a href="{{ route('services') }}#ct" class="footer-link">CT Scan</a></li>
                    <li><a href="{{ route('services') }}#ultrasound" class="footer-link">Ultrasound</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link text-blue-400 font-semibold">View All</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="footer-heading">Contact Details</h3>
                <div class="text-sm text-gray-400 space-y-4">

                    <div>
                        <span class="block font-bold text-white mb-1">Physical Address</span>
                        5th Avenue Office Suites, Fifth Ngong Avenue<br>
                        3rd Floor Suite No. 317<br>
                        P.O. Box 39471 – 00623, Nairobi
                    </div>

                    <div>
                        <span class="block font-bold text-white mb-1">Phone</span>
                        <a href="tel:+254712345678" class="hover:text-white transition">
                            +254 712 345 678
                        </a>
                    </div>

                    <div>
                        <span class="block font-bold text-white mb-1">Email</span>
                        <a href="mailto:info@precisediagnostics.co.ke" class="hover:text-white transition">
                            info@precisediagnostics.co.ke
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 footer-reveal">
            <div class="text-gray-500 text-sm">
                © {{ date('Y') }} Precise Diagnostics Imaging Ltd. All rights reserved.
            </div>

            <div class="flex gap-6 text-sm">
                <a href="{{ route('privacy') }}" class="footer-legal-link">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="footer-legal-link">Terms of Service</a>
                <a href="{{ route('sitemap') }}" class="footer-legal-link">Sitemap</a>
                <a href="{{ route('careers') }}" class="footer-legal-link">Careers</a>
            </div>
        </div>

    </div>
</footer>

<!-- STYLES -->
<style>
.footer-heading {
    @apply font-bold text-lg mb-6 pb-3 border-b border-gray-800;
}

.footer-link {
    @apply text-gray-400 hover:text-white transition;
}

.footer-legal-link {
    @apply text-gray-500 hover:text-white transition;
}

.social-icon {
    @apply w-10 h-10 rounded-full flex items-center justify-center
           bg-gray-800 hover:bg-blue-600 transition transform hover:-translate-y-1;
}

/* Reveal animation */
.footer-reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease;
}

.reveal-active {
    opacity: 1;
    transform: translateY(0);
}
</style>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const revealItems = document.querySelectorAll('.footer-reveal');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-active');
            }
        });
    }, { threshold: 0.15 });

    revealItems.forEach(item => observer.observe(item));
});
</script>
