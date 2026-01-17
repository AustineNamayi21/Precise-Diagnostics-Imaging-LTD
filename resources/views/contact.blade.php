@extends('layouts.app')

@section('title', 'Contact Us | Precise Diagnostics Imaging')

@section('content')
<!-- Hero Section with Animated Background -->
<section class="relative overflow-hidden medical-gradient text-white py-24">
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/5 rounded-full animate-float-slow"></div>
        <div class="absolute top-1/3 right-10 w-40 h-40 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute bottom-20 left-1/4 w-32 h-32 bg-white/15 rounded-full animate-pulse"></div>
        
        <!-- Animated social icons in background -->
        <div class="absolute top-1/4 left-10 animate-bounce-slow">
            <i class="fab fa-whatsapp text-white/20 text-4xl"></i>
        </div>
        <div class="absolute bottom-1/3 right-20 animate-bounce" style="animation-delay: 0.5s">
            <i class="fas fa-envelope text-white/20 text-4xl"></i>
        </div>
        <div class="absolute top-10 right-1/3 animate-spin-slow">
            <i class="fas fa-phone text-white/20 text-4xl"></i>
        </div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-6 animate-fade-in-up">
                Get in <span class="text-yellow-300">Touch</span>
            </h1>
            <p class="text-xl mb-10 opacity-90 animate-fade-in-up-delay">
                We're here to help. Choose your preferred way to connect with us.
            </p>
            
            <!-- Quick Contact Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
                <div class="quick-stat animate-pop-in" style="animation-delay: 0.1s">
                    <i class="fas fa-clock text-2xl mb-2"></i>
                    <div class="font-bold">24/7 Support</div>
                </div>
                <div class="quick-stat animate-pop-in" style="animation-delay: 0.2s">
                    <i class="fas fa-bolt text-2xl mb-2"></i>
                    <div class="font-bold">Instant Response</div>
                </div>
                <div class="quick-stat animate-pop-in" style="animation-delay: 0.3s">
                    <i class="fas fa-headset text-2xl mb-2"></i>
                    <div class="font-bold">Multi-channel</div>
                </div>
                <div class="quick-stat animate-pop-in" style="animation-delay: 0.4s">
                    <i class="fas fa-check-circle text-2xl mb-2"></i>
                    <div class="font-bold">Always Helpful</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="text-white text-center">
            <span class="block mb-2">Explore contact options</span>
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </div>
</section>

<!-- Emergency Contact Banner -->
<div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-4">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-3 md:mb-0">
                <div class="w-3 h-3 bg-white rounded-full mr-3 animate-pulse"></div>
                <span class="font-bold">EMERGENCY CONTACT AVAILABLE 24/7</span>
            </div>
            <a href="tel:+254791903552" class="bg-white text-red-700 font-bold px-6 py-2 rounded-lg hover:bg-gray-100 transition flex items-center animate-pulse-once">
                <i class="fas fa-phone-volume mr-2"></i>
                EMERGENCY: +254 791 903 552
            </a>
        </div>
    </div>
</div>

<!-- Main Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            
            <!-- Contact Methods Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
                
                <!-- WhatsApp Card -->
                <div class="contact-method-card whatsapp animate-slide-up" style="animation-delay: 0.1s">
                    <div class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h3 class="contact-method-title">WhatsApp Chat</h3>
                    <p class="contact-method-description">
                        Instant messaging with our support team. Fastest response time.
                    </p>
                    <div class="contact-info">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-clock mr-2 text-green-600"></i>
                            <span>Response time: <strong>2-5 minutes</strong></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-600"></i>
                            <span>Available: <strong>24/7</strong></span>
                        </div>
                    </div>
                    <a href="https://wa.me/254791903552?text=Hello%20Precise%20Diagnostics%2C%20I%20need%20information%20about%20your%20services" 
                       target="_blank" 
                       class="contact-action-btn whatsapp-btn">
                        <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
                    </a>
                    <div class="whatsapp-qr hidden md:block mt-4">
                        <div class="text-center text-sm text-gray-600 mb-2">Scan QR Code</div>
                        <div class="flex justify-center">
                            <div class="bg-white p-2 rounded-lg">
                                <!-- QR Code Placeholder -->
                                <div class="w-24 h-24 bg-gradient-to-br from-green-100 to-green-200 rounded flex items-center justify-center">
                                    <i class="fab fa-whatsapp text-green-600 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Phone Call Card -->
                <div class="contact-method-card phone animate-slide-up" style="animation-delay: 0.2s">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3 class="contact-method-title">Phone Call</h3>
                    <p class="contact-method-description">
                        Speak directly with our reception or medical team.
                    </p>
                    <div class="contact-info space-y-3">
                        <div class="phone-number">
                            <div class="phone-label">Main Line</div>
                            <a href="tel:+254207856359" class="phone-link">
                                <i class="fas fa-phone mr-2"></i> +254 207 856 359
                            </a>
                        </div>
                        <div class="phone-number">
                            <div class="phone-label">Mobile</div>
                            <a href="tel:+254791903552" class="phone-link">
                                <i class="fas fa-mobile-alt mr-2"></i> +254 791 903 552
                            </a>
                        </div>
                        <div class="phone-number">
                            <div class="phone-label">Hours</div>
                            <div class="phone-hours">
                                <i class="far fa-clock mr-2"></i> Mon-Sun: 6:00 AM - 10:00 PM
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="tel:+254207856359" class="contact-action-btn phone-btn">
                            <i class="fas fa-phone mr-2"></i> Call Now
                        </a>
                        <button onclick="scheduleCallback()" class="contact-action-btn callback-btn">
                            <i class="fas fa-phone-volume mr-2"></i> Request Callback
                        </button>
                    </div>
                </div>
                
                <!-- Email Card -->
                <div class="contact-method-card email animate-slide-up" style="animation-delay: 0.3s">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="contact-method-title">Email Us</h3>
                    <p class="contact-method-description">
                        For detailed inquiries, appointments, or medical questions.
                    </p>
                    <div class="contact-info">
                        <div class="email-addresses space-y-3">
                            <div class="email-item">
                                <div class="email-label">General Inquiries</div>
                                <a href="mailto:info@precisediagnostic.co.ke" class="email-link">
                                    <i class="fas fa-envelope mr-2"></i> info@precisediagnostic.co.ke
                                </a>
                            </div>
                            <div class="email-item">
                                <div class="email-label">Appointments</div>
                                <a href="mailto:appointments@precisediagnostic.co.ke" class="email-link">
                                    <i class="fas fa-calendar-check mr-2"></i> appointments@precisediagnostic.co.ke
                                </a>
                            </div>
                            <div class="email-item">
                                <div class="email-label">Medical Reports</div>
                                <a href="mailto:reports@precisediagnostic.co.ke" class="email-link">
                                    <i class="fas fa-file-medical mr-2"></i> reports@precisediagnostic.co.ke
                                </a>
                            </div>
                        </div>
                    </div>
                    <button onclick="openEmailForm()" class="contact-action-btn email-btn w-full">
                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                    </button>
                </div>
            </div>
            
            <!-- Contact Form & Social Media -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Contact Form -->
                <div class="animate-slide-in-left">
                    <div class="bg-white rounded-3xl shadow-2xl p-8">
                        <h2 class="text-3xl font-bold mb-2">Send Us a Message</h2>
                        <p class="text-gray-600 mb-8">We'll respond within 2 hours</p>
                        
                        <form id="contactForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="name" required class="form-input focus-scale" placeholder="John Doe">
                                </div>
                                
                                <div>
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" name="phone" required class="form-input focus-scale" placeholder="+254 712 345 678">
                                </div>
                            </div>
                            
                            <div>
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" required class="form-input focus-scale" placeholder="john@example.com">
                            </div>
                            
                            <div>
                                <label class="form-label">Subject *</label>
                                <select name="subject" class="form-input focus-scale">
                                    <option value="">Select a subject</option>
                                    <option value="appointment">Book Appointment</option>
                                    <option value="inquiry">General Inquiry</option>
                                    <option value="report">Medical Report Query</option>
                                    <option value="billing">Billing Question</option>
                                    <option value="feedback">Feedback/Suggestion</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label">Message *</label>
                                <textarea name="message" required class="form-textarea focus-scale" placeholder="Please describe your inquiry in detail..." rows="5"></textarea>
                            </div>
                            
                            <div class="flex items-start">
                                <input type="checkbox" name="newsletter" class="form-checkbox mt-1">
                                <span class="ml-2 text-gray-700">Subscribe to our newsletter for health tips and updates</span>
                            </div>
                            
                            <button type="submit" class="submit-form-btn">
                                <i class="fas fa-paper-plane mr-2"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Social Media & Location -->
                <div class="animate-slide-in-right">
                    
                    <!-- Social Media -->
                    <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8">
                        <h2 class="text-3xl font-bold mb-6">Connect on Social Media</h2>
                        <p class="text-gray-600 mb-8">Follow us for health tips, updates, and community</p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <a href="#" class="social-media-card facebook animate-pop-in" style="animation-delay: 0.1s">
                                <div class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <div class="social-name">Facebook</div>
                                <div class="social-followers">2.5K followers</div>
                            </a>
                            
                            <a href="#" class="social-media-card twitter animate-pop-in" style="animation-delay: 0.2s">
                                <div class="social-icon">
                                    <i class="fab fa-twitter"></i>
                                </div>
                                <div class="social-name">Twitter</div>
                                <div class="social-followers">1.8K followers</div>
                            </a>
                            
                            <a href="#" class="social-media-card instagram animate-pop-in" style="animation-delay: 0.3s">
                                <div class="social-icon">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="social-name">Instagram</div>
                                <div class="social-followers">3.2K followers</div>
                            </a>
                            
                            <a href="#" class="social-media-card linkedin animate-pop-in" style="animation-delay: 0.4s">
                                <div class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </div>
                                <div class="social-name">LinkedIn</div>
                                <div class="social-followers">500+ connections</div>
                            </a>
                        </div>
                        
                        <!-- Additional Social Links -->
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="#" class="additional-social youtube">
                                <i class="fab fa-youtube mr-3"></i> YouTube Channel
                            </a>
                            <a href="#" class="additional-social google">
                                <i class="fab fa-google mr-3"></i> Google Business
                            </a>
                        </div>
                    </div>
                    
                    <!-- Location Card -->
                    <div class="bg-white rounded-3xl shadow-2xl p-8">
                        <h2 class="text-3xl font-bold mb-6">Visit Our Clinic</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="location-detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
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
                                <div class="location-detail-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Opening Hours</h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span>Monday - Friday</span>
                                            <span class="font-bold">6:00 AM - 10:00 PM</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Saturday</span>
                                            <span class="font-bold">7:00 AM - 8:00 PM</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Sunday & Holidays</span>
                                            <span class="font-bold">8:00 AM - 6:00 PM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="location-detail-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Parking & Accessibility</h3>
                                    <p class="text-gray-700">
                                        Free parking available • Wheelchair accessible • Elevator service • Ambulance bay
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 grid grid-cols-2 gap-4">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=5th+Avenue+Office+Suites,+Fifth+Ngong+Avenue,+Nairobi" 
                               target="_blank"
                               class="location-action-btn">
                                <i class="fas fa-directions mr-2"></i> Get Directions
                            </a>
                            <button onclick="openMap()" class="location-action-btn bg-blue-600 text-white hover:bg-blue-700">
                                <i class="fas fa-map mr-2"></i> View on Map
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Live Chat Widget -->
            <div class="mt-16">
                <div class="bg-gradient-to-r from-blue-600 to-teal-600 rounded-3xl p-8 text-white">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-6 md:mb-0">
                            <h3 class="text-2xl font-bold mb-2">Need Immediate Assistance?</h3>
                            <p class="opacity-90">Chat live with our support team</p>
                        </div>
                        <button onclick="startLiveChat()" class="live-chat-btn animate-pulse-once">
                            <i class="fas fa-comment-dots mr-2"></i> Start Live Chat
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8">
        <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-in">
                <i class="fas fa-check text-green-600 text-2xl"></i>
            </div>
            
            <h3 class="text-2xl font-bold mb-4" id="modalTitle">Message Sent!</h3>
            
            <div class="space-y-4 mb-6">
                <p class="text-gray-600" id="modalMessage">
                    Thank you for contacting us. We'll get back to you within 2 hours.
                </p>
                
                <div class="bg-gray-50 rounded-xl p-4 text-left">
                    <div class="font-bold text-sm text-gray-600 mb-2">Reference:</div>
                    <div class="font-mono font-bold" id="modalReference">PDI-CONTACT-0000</div>
                </div>
            </div>
            
            <div class="space-y-3">
                <button onclick="closeSuccessModal()" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                    Continue Browsing
                </button>
                <button onclick="window.location.href='/'" class="w-full border border-gray-300 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-50 transition">
                    Back to Homepage
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Live Chat Modal -->
<div id="chatModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                    <h3 class="font-bold text-lg">Live Chat Support</h3>
                </div>
                <button onclick="closeChatModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
        </div>
        
        <div class="p-6">
            <div class="text-center mb-6">
                <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-blue-600 text-3xl"></i>
                </div>
                <p class="text-gray-600">Our support team is ready to help you</p>
            </div>
            
            <div class="space-y-3">
                <a href="https://wa.me/254791903552" target="_blank" class="chat-option whatsapp">
                    <i class="fab fa-whatsapp mr-3 text-2xl"></i>
                    <div>
                        <div class="font-bold">WhatsApp Chat</div>
                        <div class="text-sm text-gray-600">Instant messaging</div>
                    </div>
                </a>
                
                <a href="tel:+254207856359" class="chat-option phone">
                    <i class="fas fa-phone-alt mr-3 text-2xl"></i>
                    <div>
                        <div class="font-bold">Voice Call</div>
                        <div class="text-sm text-gray-600">Speak with agent</div>
                    </div>
                </a>
                
                <button onclick="startTextChat()" class="chat-option chat">
                    <i class="fas fa-comments mr-3 text-2xl"></i>
                    <div>
                        <div class="font-bold">Text Chat</div>
                        <div class="text-sm text-gray-600">Browser-based chat</div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animation Classes */
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float-slow {
        animation: float 8s ease-in-out infinite;
    }
    
    .animate-bounce-slow {
        animation: bounce 3s infinite;
    }
    
    .animate-spin-slow {
        animation: spin 20s linear infinite;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }
    
    .animate-fade-in-up-delay {
        animation: fadeInUp 0.8s ease-out 0.3s both;
    }
    
    .animate-slide-up {
        animation: slideUp 0.6s ease-out both;
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out;
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out;
    }
    
    .animate-pop-in {
        animation: popIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
    }
    
    .animate-pulse-once {
        animation: pulseOnce 2s infinite;
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    /* Keyframes */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }
    
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
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
    
    @keyframes pulseOnce {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
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
    
    /* Quick Stats */
    .quick-stat {
        @apply bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20;
    }
    
    /* Contact Method Cards */
    .contact-method-card {
        @apply bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300;
    }
    
    .contact-method-card:hover {
        transform: translateY(-5px);
    }
    
    .contact-method-card.whatsapp {
        border-top: 4px solid #25D366;
    }
    
    .contact-method-card.phone {
        border-top: 4px solid #3B82F6;
    }
    
    .contact-method-card.email {
        border-top: 4px solid #EA4335;
    }
    
    .contact-icon {
        @apply w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mb-6;
    }
    
    .contact-method-card.whatsapp .contact-icon {
        @apply bg-green-100 text-green-600;
    }
    
    .contact-method-card.phone .contact-icon {
        @apply bg-blue-100 text-blue-600;
    }
    
    .contact-method-card.email .contact-icon {
        @apply bg-red-100 text-red-600;
    }
    
    .contact-method-title {
        @apply text-2xl font-bold text-gray-900 mb-3;
    }
    
    .contact-method-description {
        @apply text-gray-600 mb-6;
    }
    
    .contact-info {
        @apply mb-6;
    }
    
    /* Action Buttons */
    .contact-action-btn {
        @apply w-full py-3 rounded-xl font-bold transition-all duration-200 flex items-center justify-center;
    }
    
    .whatsapp-btn {
        @apply bg-green-600 text-white hover:bg-green-700;
    }
    
    .phone-btn {
        @apply bg-blue-600 text-white hover:bg-blue-700;
    }
    
    .callback-btn {
        @apply border border-blue-600 text-blue-600 hover:bg-blue-50;
    }
    
    .email-btn {
        @apply bg-red-600 text-white hover:bg-red-700;
    }
    
    /* Phone Numbers */
    .phone-number {
        @apply mb-3;
    }
    
    .phone-label {
        @apply text-sm text-gray-500 mb-1;
    }
    
    .phone-link {
        @apply flex items-center text-blue-600 font-medium hover:text-blue-800;
    }
    
    .phone-hours {
        @apply flex items-center text-gray-700;
    }
    
    /* Email Addresses */
    .email-item {
        @apply mb-3;
    }
    
    .email-label {
        @apply text-sm text-gray-500 mb-1;
    }
    
    .email-link {
        @apply flex items-center text-gray-700 hover:text-blue-600;
    }
    
    /* Form Elements */
    .form-label {
        @apply block text-gray-700 mb-2 font-medium;
    }
    
    .form-input {
        @apply w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition;
    }
    
    .form-textarea {
        @apply w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition;
    }
    
    .form-checkbox {
        @apply rounded border-gray-300 text-blue-600 focus:ring-blue-500;
    }
    
    .focus-scale:focus {
        transform: scale(1.01);
    }
    
    .submit-form-btn {
        @apply w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition flex items-center justify-center;
    }
    
    /* Social Media Cards */
    .social-media-card {
        @apply rounded-2xl p-4 text-center transition-all duration-300 hover:scale-105 hover:shadow-xl;
    }
    
    .social-media-card.facebook {
        @apply bg-blue-50 border border-blue-100 text-blue-700;
    }
    
    .social-media-card.twitter {
        @apply bg-sky-50 border border-sky-100 text-sky-700;
    }
    
    .social-media-card.instagram {
        @apply bg-pink-50 border border-pink-100 text-pink-700;
    }
    
    .social-media-card.linkedin {
        @apply bg-blue-50 border border-blue-100 text-blue-700;
    }
    
    .social-icon {
        @apply text-3xl mb-2;
    }
    
    .social-name {
        @apply font-bold mb-1;
    }
    
    .social-followers {
        @apply text-sm opacity-75;
    }
    
    /* Additional Social Links */
    .additional-social {
        @apply border border-gray-200 rounded-xl p-4 text-center hover:bg-gray-50 transition flex items-center justify-center;
    }
    
    .additional-social.youtube {
        @apply text-red-600;
    }
    
    .additional-social.google {
        @apply text-blue-600;
    }
    
    /* Location Details */
    .location-detail-icon {
        @apply w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl mr-4 flex-shrink-0;
    }
    
    .location-action-btn {
        @apply w-full border border-blue-600 text-blue-600 py-3 rounded-xl font-medium hover:bg-blue-50 transition flex items-center justify-center;
    }
    
    /* Live Chat */
    .live-chat-btn {
        @apply bg-white text-blue-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-100 transition flex items-center;
    }
    
    /* Chat Options */
    .chat-option {
        @apply flex items-center p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition;
    }
    
    .chat-option.whatsapp:hover {
        @apply bg-green-50 border-green-200;
    }
    
    .chat-option.phone:hover {
        @apply bg-blue-50 border-blue-200;
    }
    
    .chat-option.chat:hover {
        @apply bg-purple-50 border-purple-200;
    }
</style>

<script>
    // Initialize page with animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate contact method cards
        animateContactCards();
        
        // Initialize form validation
        initContactForm();
        
        // Add hover effects
        initHoverEffects();
        
        // Initialize WhatsApp QR code
        initWhatsAppQR();
    });

    // Animate contact cards with staggered effect
    function animateContactCards() {
        const cards = document.querySelectorAll('.animate-slide-up');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    }

    // Initialize contact form with validation
    function initContactForm() {
        const form = document.getElementById('contactForm');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Generate reference
                const refNumber = Math.floor(1000 + Math.random() * 9000);
                const reference = `PDI-CONTACT-${refNumber}`;
                
                // Show success modal
                document.getElementById('modalReference').textContent = reference;
                document.getElementById('successModal').classList.remove('hidden');
                
                // Reset form
                form.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Log submission (in real app, send to backend)
                const formData = new FormData(form);
                console.log('Contact form submitted:', {
                    name: formData.get('name'),
                    email: formData.get('email'),
                    phone: formData.get('phone'),
                    subject: formData.get('subject'),
                    message: formData.get('message'),
                    reference: reference
                });
            }, 1500);
        });
    }

    // Initialize hover effects
    function initHoverEffects() {
        // Add ripple effect to all buttons
        document.querySelectorAll('button, .contact-action-btn, .submit-form-btn, .live-chat-btn, .location-action-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                createRipple(e, this);
            });
        });
        
        // Add scale effect on hover for cards
        const contactCards = document.querySelectorAll('.contact-method-card');
        contactCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
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

    // Initialize WhatsApp QR code
    function initWhatsAppQR() {
        // In a real implementation, this would generate a QR code
        // For now, we'll just animate the placeholder
        const qrPlaceholder = document.querySelector('.whatsapp-qr');
        if (qrPlaceholder) {
            qrPlaceholder.style.opacity = '0';
            qrPlaceholder.style.transform = 'scale(0.8)';
            
            setTimeout(() => {
                qrPlaceholder.style.transition = 'all 0.5s ease-out';
                qrPlaceholder.style.opacity = '1';
                qrPlaceholder.style.transform = 'scale(1)';
            }, 1000);
        }
    }

    // Schedule callback function
    function scheduleCallback() {
        const name = prompt('Please enter your name for callback:');
        if (name) {
            const phone = prompt('Please enter your phone number:');
            if (phone) {
                alert(`Thank you ${name}! We'll call you at ${phone} within 30 minutes.`);
                
                // In real implementation, send to backend
                console.log('Callback scheduled:', { name, phone });
            }
        }
    }

    // Open email form function
    function openEmailForm() {
        // Scroll to contact form
        document.getElementById('contactForm').scrollIntoView({ behavior: 'smooth' });
        
        // Highlight email subject
        const subjectSelect = document.querySelector('select[name="subject"]');
        subjectSelect.value = 'inquiry';
        subjectSelect.focus();
        
        // Add animation
        subjectSelect.style.animation = 'pulseOnce 1s';
        setTimeout(() => {
            subjectSelect.style.animation = '';
        }, 1000);
    }

    // Open map function
    function openMap() {
        // In a real implementation, open Google Maps
        const address = encodeURIComponent('5th Avenue Office Suites, Fifth Ngong Avenue, 3rd Floor Suite No. 317, Nairobi');
        window.open(`https://www.google.com/maps/search/?api=1&query=${address}`, '_blank');
    }

    // Start live chat function
    function startLiveChat() {
        document.getElementById('chatModal').classList.remove('hidden');
    }

    function closeChatModal() {
        document.getElementById('chatModal').classList.add('hidden');
    }

    // Start text chat function
    function startTextChat() {
        alert('Live text chat feature would be integrated here. For now, please use WhatsApp or phone.');
        closeChatModal();
    }

    // Close success modal
    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.style.opacity = '1';
        
        setTimeout(() => {
            modal.style.transition = 'opacity 0.3s ease-out';
            modal.style.opacity = '0';
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.opacity = '';
            }, 300);
        }, 100);
    }

    // Social media analytics (simulated)
    function updateSocialStats() {
        // In a real implementation, this would fetch from APIs
        const socialCards = document.querySelectorAll('.social-media-card');
        
        socialCards.forEach(card => {
            const followersEl = card.querySelector('.social-followers');
            if (followersEl) {
                const current = parseInt(followersEl.textContent);
                const newCount = current + Math.floor(Math.random() * 10);
                followersEl.textContent = newCount.toLocaleString() + ' followers';
            }
        });
    }

    // Update social stats every 30 seconds (simulated growth)
    setInterval(updateSocialStats, 30000);
</script>
@endsection