@extends('layouts.app')

@section('title', 'About Us | Precise Diagnostics Imaging')

@section('content')
<!-- Hero Section with Parallax -->
<section class="relative overflow-hidden medical-gradient text-white py-24">
    <!-- Animated background elements -->
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float-slow"></div>
        <div class="absolute top-1/4 right-20 w-16 h-16 bg-white/5 rounded-full animate-float"></div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-white/15 rounded-full animate-float-slow"></div>
        <div class="absolute bottom-10 right-10 w-12 h-12 bg-white/10 rounded-full animate-pulse"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-6 animate-fade-in-up">
                About <span class="text-yellow-300">Precise Diagnostics</span>
            </h1>
            <p class="text-xl mb-10 opacity-90 animate-fade-in-up-delay">
                Leading medical imaging excellence since 2013
            </p>
            
            <!-- Animated stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16">
                <div class="stat-card animate-pop-in" style="animation-delay: 0.1s">
                    <div class="stat-number" data-count="12">0</div>
                    <div class="stat-label">Years of Excellence</div>
                </div>
                <div class="stat-card animate-pop-in" style="animation-delay: 0.2s">
                    <div class="stat-number" data-count="10000">0</div>
                    <div class="stat-label">Patients Served</div>
                </div>
                <div class="stat-card animate-pop-in" style="animation-delay: 0.3s">
                    <div class="stat-number" data-count="99.8">0</div>
                    <div class="stat-label">Accuracy Rate</div>
                </div>
                <div class="stat-card animate-pop-in" style="animation-delay: 0.4s">
                    <div class="stat-number" data-count="24">0</div>
                    <div class="stat-label">/7 Service</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="text-white text-center">
            <span class="block mb-2">Scroll to explore</span>
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            
            <!-- Get to Know Us -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div class="animate-slide-in-left">
                    <div class="text-4xl font-bold mb-6">
                        <span class="text-blue-600">Get to Know</span> <span class="text-teal-600">Us</span>
                    </div>
                    <div class="space-y-4 text-lg text-gray-700 leading-relaxed">
                        <p class="animate-fade-in" style="animation-delay: 0.1s">
                            <span class="font-bold text-blue-700">Precise Diagnostic Imaging Centre</span> was established in the year 2013. We are one of the market leaders dedicated to the provision of the highest quality, most cost effective and accessible diagnostic imaging services in Kenya.
                        </p>
                        <p class="animate-fade-in" style="animation-delay: 0.2s">
                            We use the latest and most advanced technology available to gather accurate diagnosis while providing one-on-one patient care, and never losing sight of what makes our service unique and professional.
                        </p>
                    </div>
                </div>
                <div class="relative animate-slide-in-right">
                    <div class="bg-blue-100 rounded-3xl p-8 shadow-2xl transform hover:scale-105 transition duration-500">
                        <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden">
                            <div class="bg-gradient-to-br from-blue-400 to-teal-500 h-full flex items-center justify-center">
                                <i class="fas fa-hospital-alt text-white text-8xl"></i>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <div class="inline-block px-6 py-2 bg-blue-600 text-white rounded-full font-bold">
                                Since 2013
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating elements -->
                    <div class="absolute -top-4 -left-4 w-20 h-20 bg-teal-100 rounded-full animate-float"></div>
                    <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-blue-100 rounded-full animate-float-slow"></div>
                </div>
            </div>
            
            <!-- Mission & Vision Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">
                <!-- Mission Card -->
                <div class="mission-card animate-pop-in" style="animation-delay: 0.1s">
                    <div class="mission-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="mission-title">Mission Statement</h3>
                    <p class="mission-text">
                        We are dedicated to providing the most complete and accurate radiological investigations in Central Kenya and across the country with a commitment to technological innovation, compassionate patient care, and maintenance of professional and responsive relationships with the healthcare community.
                    </p>
                    <div class="mission-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
                
                <!-- Vision Card -->
                <div class="vision-card animate-pop-in" style="animation-delay: 0.2s">
                    <div class="vision-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="vision-title">Our Vision</h3>
                    <p class="vision-text">
                        To be an excellent radiological Centre in Kenya and East Africa offering high quality and professional services with proper ethical standards.
                    </p>
                    <div class="vision-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            
            <!-- Our Values -->
            <div class="mb-20">
                <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in-up">
                    Our <span class="text-blue-600">Core Values</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Dedication -->
                    <div class="value-card animate-stagger" data-index="0">
                        <div class="value-icon bg-red-100">
                            <i class="fas fa-heart text-red-600"></i>
                        </div>
                        <h3 class="value-title">Dedication</h3>
                        <p class="value-text">
                            It's in everything we do at Precise Diagnostic Imaging Center, starting with our commitment to medical excellence. Our goal is to facilitate the needs of physicians, doctors, researchers, all medical practitioners and healthcare providers, and provide every patient with the best possible degree of care.
                        </p>
                        <div class="value-badge">
                            <i class="fas fa-award"></i> Excellence
                        </div>
                    </div>
                    
                    <!-- Innovation -->
                    <div class="value-card animate-stagger" data-index="1">
                        <div class="value-icon bg-blue-100">
                            <i class="fas fa-lightbulb text-blue-600"></i>
                        </div>
                        <h3 class="value-title">Innovation</h3>
                        <p class="value-text">
                            Today's technological advances in medical imaging are truly remarkable. Precise Diagnostic Imaging Centre is at the forefront of the imaging industry. By using the latest in imaging technology, combined with specially trained staff, we provide you and your doctor with fast, accurate and highly detailed results.
                        </p>
                        <div class="value-badge">
                            <i class="fas fa-rocket"></i> Cutting-edge
                        </div>
                    </div>
                    
                    <!-- Compassion -->
                    <div class="value-card animate-stagger" data-index="2">
                        <div class="value-icon bg-green-100">
                            <i class="fas fa-hands-helping text-green-600"></i>
                        </div>
                        <h3 class="value-title">Compassion</h3>
                        <p class="value-text">
                            Providing compassionate patient care has always been a priority at Precise Diagnostic Imaging Center. From scheduling your exam to receiving your results, our staff will guide you through the process. We recognize the importance of providing timely results.
                        </p>
                        <div class="value-badge">
                            <i class="fas fa-hand-holding-heart"></i> Caring
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Our Commitment -->
            <div class="bg-gradient-to-r from-blue-50 to-teal-50 rounded-3xl p-8 md:p-12 mb-20 animate-slide-up">
                <div class="max-w-3xl mx-auto text-center">
                    <div class="inline-block p-4 bg-white rounded-2xl shadow-lg mb-6 animate-bounce-in">
                        <i class="fas fa-handshake text-4xl text-blue-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-6">Our Commitment</h2>
                    <p class="text-xl text-gray-700 leading-relaxed">
                        Precise Diagnostic Imaging Centre covers the complexities and developments of the radiology and imaging market. That is saying a lot for a diagnostic imaging center – and it applies to everyone who works here.
                    </p>
                </div>
            </div>
            
            <!-- Testimonials & Location -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Testimonials -->
                <div class="animate-slide-in-left">
                    <h2 class="text-3xl font-bold mb-8">
                        What <span class="text-blue-600">Clients Say</span> About Us
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="testimonial-card animate-fade-in" style="animation-delay: 0.1s">
                            <div class="testimonial-content">
                                "Our expectation is that our clients will view us as a tried-and-true clinical center of excellence."
                            </div>
                            <div class="testimonial-author">
                                <div class="stars">
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <i class="fas fa-star text-yellow-500"></i>
                                </div>
                                <span>Client Feedback</span>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.2s">
                            <h3 class="font-bold text-lg mb-4 flex items-center">
                                <i class="fab fa-google text-blue-600 mr-3"></i>
                                Leave us a review on our Google Page
                            </h3>
                            <p class="text-gray-700 mb-4">
                                We value our clients feedback, complements and complaints.
                            </p>
                            <button class="google-review-btn animate-pulse-once">
                                <i class="fab fa-google mr-2"></i> Write a Review
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Location & Contact -->
                <div class="animate-slide-in-right">
                    <h2 class="text-3xl font-bold mb-8">
                        Contact & <span class="text-teal-600">Visit Us!</span>
                    </h2>
                    
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                        <!-- Map Placeholder -->
                        <div class="h-48 bg-gradient-to-r from-blue-400 to-teal-500 relative">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-6xl"></i>
                            </div>
                            <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg">
                                <span class="font-bold text-blue-600">Nairobi, Kenya</span>
                            </div>
                        </div>
                        
                        <!-- Address Details -->
                        <div class="p-8">
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="location-icon">
                                        <i class="fas fa-map-pin"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg mb-1">Physical Address</h3>
                                        <p class="text-gray-700">
                                            5th Avenue Office Suites, Fifth Ngong Avenue<br>
                                            3rd Floor Suite No. 317<br>
                                            P.O. Box 39471 – 00623, NAIROBI
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="location-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg mb-1">Phone Numbers</h3>
                                        <p class="text-gray-700">
                                            +254 207 856 359<br>
                                            +254 791 903 552
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="location-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg mb-1">Email</h3>
                                        <p class="text-gray-700">
                                            info@precisediagnostic.co.ke
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <button class="location-action-btn">
                                    <i class="fas fa-directions mr-2"></i> Get Directions
                                </button>
                                <button class="location-action-btn bg-blue-600 text-white hover:bg-blue-700">
                                    <i class="fas fa-phone mr-2"></i> Call Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="medical-gradient py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="font-heading text-4xl font-bold text-white mb-6">Ready to Experience Precision?</h2>
        <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
            Join thousands of satisfied patients who trust us with their diagnostic needs.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/appointments" class="bg-white text-blue-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all transform hover:-translate-y-1 shadow-2xl">
                <i class="fas fa-calendar-check mr-2"></i> Book Appointment
            </a>
            <a href="/contact" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all">
                <i class="fas fa-directions mr-2"></i> Visit Our Clinic
            </a>
        </div>
    </div>
</section>

<style>
    /* Animation Classes */
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }
    
    .animate-fade-in-up-delay {
        animation: fadeInUp 0.8s ease-out 0.3s both;
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out;
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out;
    }
    
    .animate-slide-up {
        animation: slideUp 0.6s ease-out;
    }
    
    .animate-pop-in {
        animation: popIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
    }
    
    .animate-stagger {
        opacity: 0;
        transform: translateY(30px);
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float-slow {
        animation: float 8s ease-in-out infinite;
    }
    
    .animate-pulse-once {
        animation: pulseOnce 2s infinite;
    }
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out both;
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    /* Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.5);
        }
        70% {
            transform: scale(1.05);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }
    
    @keyframes pulseOnce {
        0% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
        }
    }
    
    /* Stat Cards */
    .stat-card {
        @apply bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20;
    }
    
    .stat-number {
        @apply text-4xl font-bold mb-2;
    }
    
    .stat-label {
        @apply text-sm opacity-90;
    }
    
    /* Mission & Vision Cards */
    .mission-card {
        @apply bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-3xl p-8 relative overflow-hidden hover:shadow-2xl transition-shadow duration-300;
    }
    
    .mission-icon {
        @apply w-16 h-16 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl mb-6;
    }
    
    .mission-title {
        @apply text-2xl font-bold text-blue-900 mb-4;
    }
    
    .mission-text {
        @apply text-gray-700 leading-relaxed;
    }
    
    .mission-arrow {
        @apply absolute bottom-6 right-6 w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl;
        animation: slideRight 2s infinite;
    }
    
    .vision-card {
        @apply bg-gradient-to-br from-teal-50 to-teal-100 border border-teal-200 rounded-3xl p-8 relative overflow-hidden hover:shadow-2xl transition-shadow duration-300;
    }
    
    .vision-icon {
        @apply w-16 h-16 rounded-2xl bg-teal-600 text-white flex items-center justify-center text-2xl mb-6;
    }
    
    .vision-title {
        @apply text-2xl font-bold text-teal-900 mb-4;
    }
    
    .vision-text {
        @apply text-gray-700 leading-relaxed;
    }
    
    .vision-stars {
        @apply absolute bottom-6 right-6 flex space-x-1;
    }
    
    .vision-stars i {
        @apply text-yellow-500 text-xl;
        animation: starTwinkle 2s infinite;
    }
    
    .vision-stars i:nth-child(2) { animation-delay: 0.2s; }
    .vision-stars i:nth-child(3) { animation-delay: 0.4s; }
    .vision-stars i:nth-child(4) { animation-delay: 0.6s; }
    .vision-stars i:nth-child(5) { animation-delay: 0.8s; }
    
    /* Value Cards */
    .value-card {
        @apply bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 relative overflow-hidden;
    }
    
    .value-card:hover {
        transform: translateY(-10px);
    }
    
    .value-icon {
        @apply w-20 h-20 rounded-2xl flex items-center justify-center text-3xl mb-6;
    }
    
    .value-title {
        @apply text-2xl font-bold text-gray-900 mb-4;
    }
    
    .value-text {
        @apply text-gray-700 leading-relaxed mb-6;
    }
    
    .value-badge {
        @apply inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium;
    }
    
    /* Testimonial Cards */
    .testimonial-card {
        @apply bg-white rounded-2xl p-8 border border-gray-100 shadow-lg;
    }
    
    .testimonial-content {
        @apply text-gray-700 text-lg italic mb-6;
    }
    
    .testimonial-author {
        @apply flex justify-between items-center;
    }
    
    .stars {
        @apply flex space-x-1;
    }
    
    /* Location Styles */
    .location-icon {
        @apply w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl mr-4 flex-shrink-0;
    }
    
    .location-action-btn {
        @apply w-full border border-blue-600 text-blue-600 py-3 rounded-xl font-medium hover:bg-blue-50 transition flex items-center justify-center;
    }
    
    /* Google Review Button */
    .google-review-btn {
        @apply bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center w-full;
    }
    
    /* Additional Animations */
    @keyframes slideRight {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(5px);
        }
    }
    
    @keyframes starTwinkle {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.5;
            transform: scale(0.8);
        }
    }
    
    /* Hover Effects */
    .hover-scale {
        transition: transform 0.3s ease;
    }
    
    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>

<script>
    // Initialize animations on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats counting
        animateStats();
        
        // Animate staggered value cards
        animateStaggeredCards();
        
        // Add scroll animations
        initScrollAnimations();
        
        // Add hover effects
        initHoverEffects();
        
        // Initialize floating elements
        initFloatingElements();
    });

    // Animate statistics counting
    function animateStats() {
        const statNumbers = document.querySelectorAll('.stat-number');
        
        statNumbers.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-count'));
            const suffix = stat.textContent.includes('%') ? '%' : '';
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            
            let current = 0;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                if (suffix === '%') {
                    stat.textContent = current.toFixed(1) + suffix;
                } else {
                    stat.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        });
    }

    // Animate staggered cards
    function animateStaggeredCards() {
        const cards = document.querySelectorAll('.animate-stagger');
        
        cards.forEach(card => {
            const index = parseInt(card.getAttribute('data-index'));
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
                card.style.transition = 'all 0.6s ease-out';
            }, index * 200);
        });
    }

    // Initialize scroll animations
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        // Observe all animate-on-scroll elements
        document.querySelectorAll('.animate-fade-in, .animate-slide-up').forEach(el => {
            observer.observe(el);
        });
    }

    // Initialize hover effects
    function initHoverEffects() {
        // Add hover effect to value cards
        const valueCards = document.querySelectorAll('.value-card');
        valueCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
                this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('button, .location-action-btn, .google-review-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                createRipple(e, this);
            });
        });
    }

    // Ripple effect function
    function createRipple(event, element) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            width: ${size}px;
            height: ${size}px;
            top: ${y}px;
            left: ${x}px;
            pointer-events: none;
        `;
        
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Initialize floating elements
    function initFloatingElements() {
        // Make location icon float
        const locationIcon = document.querySelector('.location-icon');
        if (locationIcon) {
            locationIcon.style.animation = 'float 4s ease-in-out infinite';
        }

        // Make mission arrow bounce
        const missionArrow = document.querySelector('.mission-arrow');
        if (missionArrow) {
            missionArrow.style.animation = 'slideRight 2s infinite';
        }
    }

    // Google Review button functionality
    document.querySelector('.google-review-btn')?.addEventListener('click', function() {
        // In a real implementation, this would link to Google Maps review
        alert('This would redirect to your Google Maps review page. For now, this is a simulation.');
        
        // Add success animation
        this.innerHTML = '<i class="fas fa-check mr-2"></i> Thank you!';
        this.style.backgroundColor = '#10B981';
        
        setTimeout(() => {
            this.innerHTML = '<i class="fab fa-google mr-2"></i> Write a Review';
            this.style.backgroundColor = '';
        }, 2000);
    });

    // Location action buttons
    document.querySelectorAll('.location-action-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (this.textContent.includes('Directions')) {
                // Open Google Maps with your address
                const address = encodeURIComponent('5th Avenue Office Suites, Fifth Ngong Avenue, 3rd Floor Suite No. 317, Nairobi');
                window.open(`https://www.google.com/maps/dir/?api=1&destination=${address}`, '_blank');
            } else if (this.textContent.includes('Call')) {
                // Call the main number
                window.location.href = 'tel:+254207856359';
            }
        });
    });

    // Parallax effect on scroll
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.animate-float, .animate-float-slow');
        
        parallaxElements.forEach(el => {
            const speed = el.classList.contains('animate-float-slow') ? 0.5 : 0.3;
            const yPos = -(scrolled * speed);
            el.style.transform = `translateY(${yPos}px)`;
        });
    });
</script>
@endsection