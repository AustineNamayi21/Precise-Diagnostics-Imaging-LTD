@extends('layouts.app')

@section('title', 'Contact Us | Precise Diagnostics Imaging')

@section('content')
<!-- Hero Section with Animated Background -->
<section class="relative overflow-hidden medical-gradient text-white py-20 md:py-28">
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-gradient-to-br from-blue-500/20 to-teal-500/20 rounded-full animate-float-slow"></div>
        <div class="absolute top-1/3 right-10 w-40 h-40 bg-gradient-to-tr from-purple-500/15 to-pink-500/15 rounded-full animate-float-delay"></div>
        <div class="absolute bottom-20 left-1/4 w-32 h-32 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 rounded-full animate-pulse-slow"></div>
        
        <!-- Animated medical icons in background -->
        <div class="absolute top-1/4 left-10 animate-bounce-slow">
            <i class="fas fa-heartbeat text-white/15 text-5xl"></i>
        </div>
        <div class="absolute bottom-1/3 right-20 animate-bounce-delay">
            <i class="fas fa-stethoscope text-white/15 text-5xl"></i>
        </div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="font-heading text-4xl sm:text-5xl md:text-6xl font-bold mb-4 animate-fade-in-up">
                Connect With <span class="text-cyan-300">Precision</span>
            </h1>
            <p class="text-lg sm:text-xl mb-8 opacity-90 animate-fade-in-up-delay">
                Your health is our priority. Choose the most convenient way to reach our medical team.
            </p>
            
            <!-- Animated Statistics -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mt-12">
                <div class="quick-stat animate-pop-in" data-delay="0.1s">
                    <div class="stat-number" data-target="98">0</div>
                    <div class="stat-label">Satisfaction Rate</div>
                </div>
                <div class="quick-stat animate-pop-in" data-delay="0.2s">
                    <div class="stat-number" data-target="30">0</div>
                    <div class="stat-label">Min Response Time</div>
                </div>
                <div class="quick-stat animate-pop-in" data-delay="0.3s">
                    <div class="stat-number" data-target="247">0</div>
                    <div class="stat-label">Days Support</div>
                </div>
                <div class="quick-stat animate-pop-in" data-delay="0.4s">
                    <div class="stat-number" data-target="5000">0</div>
                    <div class="stat-label">Patients Helped</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Animated scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <div class="scroll-indicator animate-bounce">
            <span class="block text-sm opacity-80 mb-2">Explore Options</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</section>

<!-- Main Contact Section -->
<section class="py-16 md:py-24 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            
            <!-- Contact Methods Grid with Enhanced Animation -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 mb-12 md:mb-20">
                
                <!-- WhatsApp Card - Enhanced -->
                <div class="contact-method-card whatsapp animate-card-float" data-delay="0.1s">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-2xl shadow-lg animate-pulse-glow">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                    </div>
                    <div class="pt-10">
                        <h3 class="contact-method-title">WhatsApp Chat</h3>
                        <p class="contact-method-description">
                            Instant messaging with our medical support team. Get quick responses for your health queries.
                        </p>
                        <div class="contact-info">
                            <div class="info-item">
                                <i class="fas fa-bolt text-green-500"></i>
                                <span>Response: <strong>2-5 minutes</strong></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock text-green-500"></i>
                                <span>Available: <strong>24/7</strong></span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="https://wa.me/254791903552?text=Hello%20Precise%20Diagnostics%2C%20I%20need%20medical%20assistance" 
                               target="_blank" 
                               class="contact-action-btn whatsapp-btn group">
                                <span class="flex items-center justify-center">
                                    <i class="fab fa-whatsapp mr-2 group-hover:scale-110 transition-transform"></i> 
                                    <span>Start WhatsApp Chat</span>
                                    <i class="fas fa-external-link-alt ml-2 text-sm opacity-70"></i>
                                </span>
                            </a>
                        </div>
                        <div class="mt-4">
                            <div class="text-center text-sm text-gray-600 mb-2">Scan to Chat</div>
                            <div class="flex justify-center">
                                <div class="qr-code-container">
                                    <div class="qr-code-placeholder">
                                        <div class="qr-animation"></div>
                                        <i class="fab fa-whatsapp text-green-600 text-3xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Phone Call Card - Enhanced -->
                <div class="contact-method-card phone animate-card-float" data-delay="0.2s">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-2xl shadow-lg animate-ring">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                    </div>
                    <div class="pt-10">
                        <h3 class="contact-method-title">Phone Consultation</h3>
                        <p class="contact-method-description">
                            Speak directly with our medical professionals for personalized health advice.
                        </p>
                        <div class="contact-info space-y-4">
                            <div class="phone-number-item">
                                <div class="phone-label">Medical Hotline</div>
                                <a href="tel:+254207856359" class="phone-link hover-lift">
                                    <i class="fas fa-hospital mr-2"></i> +254 207 856 359
                                </a>
                            </div>
                            <div class="phone-number-item">
                                <div class="phone-label">Mobile Support</div>
                                <a href="tel:+254791903552" class="phone-link hover-lift">
                                    <i class="fas fa-mobile-alt mr-2"></i> +254 791 903 552
                                </a>
                            </div>
                            <div class="phone-number-item">
                                <div class="phone-label">Consultation Hours</div>
                                <div class="phone-hours">
                                    <i class="far fa-clock mr-2"></i> 
                                    <span>Mon-Sun: 6:00 AM - 10:00 PM</span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6">
                            <a href="tel:+254207856359" class="contact-action-btn phone-btn group">
                                <i class="fas fa-phone mr-2 group-hover:rotate-12 transition-transform"></i> 
                                Call Now
                            </a>
                            <button onclick="scheduleMedicalCallback()" class="contact-action-btn callback-btn group">
                                <i class="fas fa-calendar-plus mr-2 group-hover:scale-110 transition-transform"></i> 
                                Schedule Call
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Email Card - Enhanced -->
                <div class="contact-method-card email animate-card-float" data-delay="0.3s">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white text-2xl shadow-lg animate-pulse-soft">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="pt-10">
                        <h3 class="contact-method-title">Email Communication</h3>
                        <p class="contact-method-description">
                            For detailed medical inquiries, appointment requests, or health reports.
                        </p>
                        <div class="contact-info">
                            <div class="email-addresses space-y-4">
                                <div class="email-item hover-lift">
                                    <div class="email-label">Medical Inquiries</div>
                                    <a href="mailto:info@precisediagnostic.co.ke" class="email-link">
                                        <i class="fas fa-user-md mr-2"></i> info@precisediagnostic.co.ke
                                    </a>
                                </div>
                                <div class="email-item hover-lift">
                                    <div class="email-label">Appointments</div>
                                    <a href="mailto:appointments@precisediagnostic.co.ke" class="email-link">
                                        <i class="fas fa-calendar-check mr-2"></i> appointments@precisediagnostic.co.ke
                                    </a>
                                </div>
                                <div class="email-item hover-lift">
                                    <div class="email-label">Medical Reports</div>
                                    <a href="mailto:reports@precisediagnostic.co.ke" class="email-link">
                                        <i class="fas fa-file-medical-alt mr-2"></i> reports@precisediagnostic.co.ke
                                    </a>
                                </div>
                            </div>
                        </div>
                        <button onclick="openEmailComposer()" class="contact-action-btn email-btn w-full group mt-6">
                            <i class="fas fa-paper-plane mr-2 group-hover:translate-x-1 transition-transform"></i> 
                            Compose Email
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form & Social Media -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                
                <!-- Enhanced Contact Form -->
                <div class="animate-slide-in-left">
                    <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8 form-container">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-400 flex items-center justify-center text-white text-xl mr-4">
                                <i class="fas fa-comment-medical"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold">Send a Message</h2>
                                <p class="text-gray-600">We'll respond within 2 hours</p>
                            </div>
                        </div>
                        
                        <form id="medicalContactForm" class="space-y-5">
                            <div class="form-group floating-label">
                                <input type="text" name="name" required class="form-input" placeholder=" ">
                                <label>Full Name *</label>
                                <div class="focus-border"></div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="form-group floating-label">
                                    <input type="tel" name="phone" required class="form-input" placeholder=" ">
                                    <label>Phone Number *</label>
                                    <div class="focus-border"></div>
                                </div>
                                
                                <div class="form-group floating-label">
                                    <input type="email" name="email" required class="form-input" placeholder=" ">
                                    <label>Email Address *</label>
                                    <div class="focus-border"></div>
                                </div>
                            </div>
                            
                            <div class="form-group floating-label">
                                <select name="subject" class="form-input" required>
                                    <option value=""></option>
                                    <option value="appointment">Book Medical Appointment</option>
                                    <option value="consultation">Medical Consultation</option>
                                    <option value="report">Medical Report Query</option>
                                    <option value="billing">Billing & Insurance</option>
                                    <option value="feedback">Feedback & Suggestions</option>
                                    <option value="other">Other Medical Inquiry</option>
                                </select>
                                <label>Inquiry Type *</label>
                                <div class="focus-border"></div>
                            </div>
                            
                            <div class="form-group floating-label">
                                <textarea name="message" required class="form-textarea" placeholder=" " rows="4"></textarea>
                                <label>Medical Details *</label>
                                <div class="focus-border"></div>
                            </div>
                            
                            <div class="flex items-center form-checkbox-container">
                                <input type="checkbox" name="newsletter" id="newsletter" class="form-checkbox">
                                <label for="newsletter" class="ml-3 cursor-pointer">
                                    Subscribe for health tips & medical updates
                                </label>
                            </div>
                            
                            <button type="submit" class="submit-form-btn group">
                                <span class="flex items-center justify-center">
                                    <i class="fas fa-paper-plane mr-2 group-hover:rotate-12 transition-transform"></i>
                                    <span>Send Medical Inquiry</span>
                                    <div class="btn-ripple"></div>
                                </span>
                            </button>
                        </form>
                        
                        <div class="mt-6 text-center">
                            <div class="inline-flex items-center text-sm text-gray-600">
                                <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                <span>Your information is secure and confidential</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Enhanced Social Media & Location -->
                <div class="space-y-8 animate-slide-in-right">
                    
                    <!-- Social Media Section -->
                    <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-xl mr-4">
                                <i class="fas fa-users-medical"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold">Join Our Community</h2>
                                <p class="text-gray-600">Health tips, updates, and support</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <a href="#" class="social-media-card facebook animate-social-hover" data-platform="facebook">
                                <div class="social-icon-wrapper">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <div class="social-content">
                                    <div class="social-name">Facebook</div>
                                    <div class="social-stats">
                                        <i class="fas fa-users mr-1"></i>
                                        <span class="follower-count" data-count="2500">2.5K</span>
                                    </div>
                                </div>
                            </a>
                            
                            <a href="#" class="social-media-card twitter animate-social-hover" data-platform="twitter">
                                <div class="social-icon-wrapper">
                                    <i class="fab fa-twitter"></i>
                                </div>
                                <div class="social-content">
                                    <div class="social-name">Twitter</div>
                                    <div class="social-stats">
                                        <i class="fas fa-users mr-1"></i>
                                        <span class="follower-count" data-count="1800">1.8K</span>
                                    </div>
                                </div>
                            </a>
                            
                            <a href="#" class="social-media-card instagram animate-social-hover" data-platform="instagram">
                                <div class="social-icon-wrapper">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="social-content">
                                    <div class="social-name">Instagram</div>
                                    <div class="social-stats">
                                        <i class="fas fa-users mr-1"></i>
                                        <span class="follower-count" data-count="3200">3.2K</span>
                                    </div>
                                </div>
                            </a>
                            
                            <a href="#" class="social-media-card linkedin animate-social-hover" data-platform="linkedin">
                                <div class="social-icon-wrapper">
                                    <i class="fab fa-linkedin-in"></i>
                                </div>
                                <div class="social-content">
                                    <div class="social-name">LinkedIn</div>
                                    <div class="social-stats">
                                        <i class="fas fa-users mr-1"></i>
                                        <span class="follower-count" data-count="500">500+</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Additional Social Links -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <a href="#" class="additional-social youtube group">
                                <div class="additional-social-icon">
                                    <i class="fab fa-youtube"></i>
                                </div>
                                <span>Health Education Videos</span>
                                <i class="fas fa-arrow-right ml-auto group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="#" class="additional-social google group">
                                <div class="additional-social-icon">
                                    <i class="fab fa-google"></i>
                                </div>
                                <span>Read Patient Reviews</span>
                                <i class="fas fa-arrow-right ml-auto group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Location Card -->
                    <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-500 flex items-center justify-center text-white text-xl mr-4">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold">Visit Our Facility</h2>
                                <p class="text-gray-600">State-of-the-art medical center</p>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="location-detail-item hover-lift">
                                <div class="location-icon">
                                    <i class="fas fa-clinic-medical"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Medical Center Address</h3>
                                    <p class="text-gray-700">
                                        5th Avenue Medical Suites, Fifth Ngong Avenue<br>
                                        3rd Floor, Suite 317<br>
                                        P.O. Box 39471 – 00623, NAIROBI
                                    </p>
                                </div>
                            </div>
                            
                            <div class="location-detail-item hover-lift">
                                <div class="location-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-2">Medical Consultation Hours</h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center schedule-item">
                                            <span>Monday - Friday</span>
                                            <span class="font-bold text-blue-600">6:00 AM - 10:00 PM</span>
                                        </div>
                                        <div class="flex justify-between items-center schedule-item">
                                            <span>Saturday</span>
                                            <span class="font-bold text-blue-600">7:00 AM - 8:00 PM</span>
                                        </div>
                                        <div class="flex justify-between items-center schedule-item">
                                            <span>Sunday & Holidays</span>
                                            <span class="font-bold text-blue-600">8:00 AM - 6:00 PM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="location-detail-item hover-lift">
                                <div class="location-icon">
                                    <i class="fas fa-wheelchair"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Facility Features</h3>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <span class="facility-tag">Free Parking</span>
                                        <span class="facility-tag">Wheelchair Access</span>
                                        <span class="facility-tag">Ambulance Bay</span>
                                        <span class="facility-tag">Wi-Fi</span>
                                        <span class="facility-tag">Pharmacy</span>
                                        <span class="facility-tag">Cafeteria</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=5th+Avenue+Office+Suites,+Fifth+Ngong+Avenue,+Nairobi" 
                               target="_blank"
                               class="location-action-btn group">
                                <i class="fas fa-directions mr-2 group-hover:rotate-45 transition-transform"></i>
                                Get Directions
                            </a>
                            <button onclick="openMedicalMap()" class="location-action-btn bg-gradient-to-r from-blue-600 to-cyan-500 text-white hover:shadow-lg group">
                                <i class="fas fa-map-marked-alt mr-2 group-hover:scale-110 transition-transform"></i>
                                View Medical Campus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Live Support Section -->
            <div class="mt-12 md:mt-20 animate-fade-in">
                <div class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-500 rounded-2xl p-6 md:p-8 text-white shadow-xl relative overflow-hidden">
                    <!-- Animated background elements -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full animate-pulse-slow"></div>
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 rounded-full animate-spin-slow"></div>
                    </div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-6 md:mb-0 text-center md:text-left">
                            <h3 class="text-2xl md:text-3xl font-bold mb-3">Need Medical Advice Now?</h3>
                            <p class="opacity-90 max-w-md">Our medical team is ready to assist you with any health concerns</p>
                        </div>
                        <button onclick="startMedicalSupport()" class="live-support-btn group">
                            <span class="flex items-center">
                                <i class="fas fa-comments-medical mr-2 group-hover:animate-pulse"></i>
                                Connect with Medical Team
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <div class="live-support-pulse"></div>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Success Modal -->
<div id="successModal" class="modal-overlay hidden">
    <div class="modal-container">
        <div class="modal-content">
            <div class="modal-success-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h3 class="modal-title">Medical Inquiry Sent!</h3>
            
            <div class="space-y-4">
                <p class="modal-message">
                    Thank you for reaching out. Our medical team will review your inquiry and respond within 2 hours.
                </p>
                
                <div class="reference-card">
                    <div class="reference-label">Your Reference Number</div>
                    <div class="reference-code" id="modalReference">PDI-MED-0000</div>
                    <div class="reference-note">Please keep this for tracking</div>
                </div>
            </div>
            
            <div class="modal-actions">
                <button onclick="closeSuccessModal()" class="modal-primary-btn">
                    Continue Browsing
                </button>
                <button onclick="window.location.href='/services'" class="modal-secondary-btn">
                    View Medical Services
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Medical Support Modal -->
<div id="supportModal" class="modal-overlay hidden">
    <div class="modal-container max-w-md">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                    <h3 class="font-bold text-lg">Medical Support Options</h3>
                </div>
                <button onclick="closeSupportModal()" class="modal-close-btn">&times;</button>
            </div>
            
            <div class="space-y-4">
                <a href="https://wa.me/254791903552" target="_blank" class="support-option whatsapp-option group">
                    <div class="support-option-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="support-option-content">
                        <div class="support-option-title">WhatsApp Medical Chat</div>
                        <div class="support-option-description">Instant messaging with medical staff</div>
                    </div>
                    <i class="fas fa-chevron-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
                
                <a href="tel:+254207856359" class="support-option phone-option group">
                    <div class="support-option-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="support-option-content">
                        <div class="support-option-title">Emergency Hotline</div>
                        <div class="support-option-description">Immediate medical assistance</div>
                    </div>
                    <i class="fas fa-chevron-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
                
                <button onclick="startVideoConsultation()" class="support-option video-option group">
                    <div class="support-option-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="support-option-content">
                        <div class="support-option-title">Video Consultation</div>
                        <div class="support-option-description">Virtual doctor appointment</div>
                    </div>
                    <i class="fas fa-chevron-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </button>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    <span>For life-threatening emergencies, call emergency services immediately</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced CSS Styles -->
<style>
    /* Enhanced Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes float-delay {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-15px) rotate(5deg); }
        66% { transform: translateY(10px) rotate(-5deg); }
    }
    
    @keyframes pulse-glow {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(37, 211, 102, 0.3);
            transform: scale(1);
        }
        50% { 
            box-shadow: 0 0 40px rgba(37, 211, 102, 0.6);
            transform: scale(1.05);
        }
    }
    
    @keyframes ring {
        0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5); }
        70% { box-shadow: 0 0 0 20px rgba(59, 130, 246, 0); }
        100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
    }
    
    @keyframes card-float {
        0% { transform: translateY(0) rotateX(0); }
        50% { transform: translateY(-10px) rotateX(5deg); }
        100% { transform: translateY(0) rotateX(0); }
    }
    
    @keyframes social-hover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-5px); }
    }
    
    @keyframes slide-up-stagger {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes ripple-effect {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    @keyframes typewriter {
        from { width: 0; }
        to { width: 100%; }
    }
    
    @keyframes blink-caret {
        from, to { border-color: transparent; }
        50% { border-color: currentColor; }
    }
    
    /* Animation Classes */
    .animate-float-slow {
        animation: float 8s ease-in-out infinite;
    }
    
    .animate-float-delay {
        animation: float-delay 10s ease-in-out infinite;
    }
    
    .animate-pulse-slow {
        animation: pulse 3s ease-in-out infinite;
    }
    
    .animate-pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite;
    }
    
    .animate-ring {
        animation: ring 2s infinite;
    }
    
    .animate-card-float {
        animation: card-float 6s ease-in-out infinite;
    }
    
    .animate-social-hover:hover {
        animation: social-hover 0.3s ease-out forwards;
    }
    
    .animate-slide-in-left {
        animation: slide-up-stagger 0.8s ease-out;
        animation-fill-mode: both;
    }
    
    .animate-slide-in-right {
        animation: slide-up-stagger 0.8s ease-out 0.2s both;
    }
    
    .animate-fade-in-up {
        animation: slide-up-stagger 0.6s ease-out;
    }
    
    .animate-fade-in-up-delay {
        animation: slide-up-stagger 0.6s ease-out 0.3s both;
    }
    
    .animate-fade-in {
        animation: slide-up-stagger 0.8s ease-out 0.4s both;
    }
    
    .animate-pop-in {
        opacity: 0;
        animation: slide-up-stagger 0.5s ease-out forwards;
    }
    
    .animate-bounce-delay {
        animation: bounce 3s infinite 0.5s;
    }
    
    /* Quick Stats */
    .quick-stat {
        @apply bg-white/10 backdrop-blur-sm rounded-2xl p-4 md:p-6 text-center border border-white/20 hover:bg-white/15 transition-all duration-300;
    }
    
    .stat-number {
        @apply text-3xl md:text-4xl font-bold mb-2;
        font-family: 'SF Mono', 'Monaco', 'Cascadia Code', monospace;
    }
    
    .stat-label {
        @apply text-sm md:text-base opacity-90;
    }
    
    /* Enhanced Contact Cards */
    .contact-method-card {
        @apply bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-lg relative;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .contact-method-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .contact-method-card.whatsapp {
        border-top: 4px solid #25D366;
    }
    
    .contact-method-card.phone {
        border-top: 4px solid #3B82F6;
    }
    
    .contact-method-card.email {
        border-top: 4px solid #FB923C;
    }
    
    .contact-method-title {
        @apply text-xl md:text-2xl font-bold text-gray-900 mb-3 text-center;
    }
    
    .contact-method-description {
        @apply text-gray-600 mb-6 text-center;
        line-height: 1.6;
    }
    
    /* Contact Info */
    .info-item {
        @apply flex items-center mb-3 last:mb-0;
    }
    
    .info-item i {
        @apply mr-3 w-5 text-center;
    }
    
    /* Action Buttons */
    .contact-action-btn {
        @apply w-full py-3 px-4 rounded-xl font-bold transition-all duration-300 relative overflow-hidden;
    }
    
    .whatsapp-btn {
        @apply bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    }
    
    .phone-btn {
        @apply bg-gradient-to-r from-blue-500 to-blue-600 text-white hover:from-blue-600 hover:to-blue-700;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .callback-btn {
        @apply border-2 border-blue-500 text-blue-600 hover:bg-blue-50;
    }
    
    .email-btn {
        @apply bg-gradient-to-r from-amber-500 to-orange-500 text-white hover:from-amber-600 hover:to-orange-600;
        box-shadow: 0 4px 15px rgba(251, 146, 60, 0.3);
    }
    
    /* QR Code Animation */
    .qr-code-container {
        @apply relative;
    }
    
    .qr-code-placeholder {
        @apply w-24 h-24 bg-gradient-to-br from-green-50 to-green-100 rounded-xl flex items-center justify-center relative overflow-hidden;
        border: 2px dashed #25D366;
    }
    
    .qr-animation {
        @apply absolute inset-0 bg-gradient-to-r from-transparent via-green-200/30 to-transparent;
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    /* Enhanced Form Styles */
    .form-container {
        background: linear-gradient(145deg, #ffffff, #f8fafc);
    }
    
    .form-group {
        @apply relative;
    }
    
    .form-group.floating-label {
        @apply relative;
    }
    
    .form-input, .form-textarea, .form-group select {
        @apply w-full p-4 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all duration-300;
        font-size: 16px;
    }
    
    .form-group.floating-label label {
        @apply absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 transition-all duration-300 pointer-events-none;
        background: white;
        padding: 0 8px;
    }
    
    .form-input:focus + label,
    .form-input:not(:placeholder-shown) + label,
    .form-textarea:focus + label,
    .form-textarea:not(:placeholder-shown) + label,
    .form-group select:focus + label,
    .form-group select:valid + label {
        @apply top-0 text-sm text-blue-600;
        transform: translateY(-50%) scale(0.9);
    }
    
    .focus-border {
        @apply absolute bottom-0 left-0 w-0 h-1 bg-blue-500 transition-all duration-300;
    }
    
    .form-input:focus ~ .focus-border,
    .form-textarea:focus ~ .focus-border,
    .form-group select:focus ~ .focus-border {
        @apply w-full;
    }
    
    .form-checkbox-container {
        @apply p-3 bg-gray-50 rounded-xl;
    }
    
    .form-checkbox {
        @apply w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0;
    }
    
    /* Submit Button */
    .submit-form-btn {
        @apply w-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white py-4 rounded-xl font-bold hover:shadow-xl transition-all duration-300 relative overflow-hidden;
    }
    
    .btn-ripple {
        @apply absolute inset-0 bg-white opacity-0;
        border-radius: 50%;
        transform: scale(0);
    }
    
    /* Social Media Cards */
    .social-media-card {
        @apply rounded-xl p-4 transition-all duration-300 cursor-pointer;
    }
    
    .social-media-card.facebook {
        @apply bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200;
    }
    
    .social-media-card.twitter {
        @apply bg-gradient-to-br from-sky-50 to-sky-100 border border-sky-200;
    }
    
    .social-media-card.instagram {
        @apply bg-gradient-to-br from-pink-50 to-rose-100 border border-pink-200;
    }
    
    .social-media-card.linkedin {
        @apply bg-gradient-to-br from-blue-50 to-indigo-100 border border-indigo-200;
    }
    
    .social-icon-wrapper {
        @apply w-12 h-12 rounded-xl flex items-center justify-center text-2xl mb-3 mx-auto;
    }
    
    .social-media-card.facebook .social-icon-wrapper {
        @apply bg-blue-100 text-blue-600;
    }
    
    .social-media-card.twitter .social-icon-wrapper {
        @apply bg-sky-100 text-sky-600;
    }
    
    .social-media-card.instagram .social-icon-wrapper {
        @apply bg-gradient-to-r from-pink-100 to-rose-100 text-pink-600;
    }
    
    .social-media-card.linkedin .social-icon-wrapper {
        @apply bg-blue-100 text-blue-600;
    }
    
    .social-content {
        @apply text-center;
    }
    
    .social-name {
        @apply font-bold mb-1;
    }
    
    .social-stats {
        @apply text-sm opacity-75 flex items-center justify-center;
    }
    
    /* Additional Social Links */
    .additional-social {
        @apply border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all duration-300 flex items-center;
    }
    
    .additional-social.youtube {
        @apply hover:border-red-200 hover:bg-red-50;
    }
    
    .additional-social.google {
        @apply hover:border-blue-200 hover:bg-blue-50;
    }
    
    .additional-social-icon {
        @apply w-10 h-10 rounded-lg flex items-center justify-center mr-3;
    }
    
    .additional-social.youtube .additional-social-icon {
        @apply bg-red-100 text-red-600;
    }
    
    .additional-social.google .additional-social-icon {
        @apply bg-blue-100 text-blue-600;
    }
    
    /* Location Details */
    .location-detail-item {
        @apply flex items-start p-4 rounded-xl hover:bg-gray-50 transition-all duration-300;
    }
    
    .location-icon {
        @apply w-12 h-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center text-xl mr-4 flex-shrink-0;
    }
    
    .schedule-item {
        @apply py-2 px-3 rounded-lg hover:bg-blue-50 transition-colors;
    }
    
    .facility-tag {
        @apply px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm;
    }
    
    .location-action-btn {
        @apply w-full border-2 border-blue-500 text-blue-600 py-3 rounded-xl font-medium hover:bg-blue-50 transition-all duration-300 flex items-center justify-center;
    }
    
    /* Live Support */
    .live-support-btn {
        @apply bg-white text-blue-600 px-6 py-4 rounded-xl font-bold hover:shadow-2xl transition-all duration-300 relative overflow-hidden flex items-center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .live-support-pulse {
        @apply absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent;
        animation: shimmer 2s infinite;
    }
    
    /* Modals */
    .modal-overlay {
        @apply fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4;
    }
    
    .modal-container {
        @apply bg-white rounded-2xl max-w-md w-full;
        animation: modal-appear 0.3s ease-out;
    }
    
    @keyframes modal-appear {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    .modal-content {
        @apply p-6 md:p-8;
    }
    
    .modal-success-icon {
        @apply w-20 h-20 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6;
        animation: bounce-in 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    .modal-title {
        @apply text-2xl font-bold text-center mb-4;
    }
    
    .modal-message {
        @apply text-gray-600 text-center mb-6;
    }
    
    .reference-card {
        @apply bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-4 border border-blue-100;
    }
    
    .reference-label {
        @apply text-sm text-gray-600 mb-1;
    }
    
    .reference-code {
        @apply font-mono font-bold text-xl text-blue-600 mb-1;
    }
    
    .reference-note {
        @apply text-xs text-gray-500;
    }
    
    .modal-actions {
        @apply space-y-3 mt-6;
    }
    
    .modal-primary-btn {
        @apply w-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white py-3 rounded-xl font-bold hover:shadow-lg transition-all duration-300;
    }
    
    .modal-secondary-btn {
        @apply w-full border-2 border-gray-300 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-50 transition-colors;
    }
    
    .modal-close-btn {
        @apply text-2xl text-gray-500 hover:text-gray-700 transition-colors;
    }
    
    /* Support Options */
    .support-option {
        @apply flex items-center p-4 border border-gray-200 rounded-xl hover:shadow-md transition-all duration-300;
    }
    
    .support-option-icon {
        @apply w-12 h-12 rounded-xl flex items-center justify-center text-xl mr-4;
    }
    
    .whatsapp-option {
        @apply hover:border-green-200 hover:bg-green-50;
    }
    
    .whatsapp-option .support-option-icon {
        @apply bg-green-100 text-green-600;
    }
    
    .phone-option {
        @apply hover:border-blue-200 hover:bg-blue-50;
    }
    
    .phone-option .support-option-icon {
        @apply bg-blue-100 text-blue-600;
    }
    
    .video-option {
        @apply hover:border-purple-200 hover:bg-purple-50;
    }
    
    .video-option .support-option-icon {
        @apply bg-purple-100 text-purple-600;
    }
    
    .support-option-content {
        @apply flex-1;
    }
    
    .support-option-title {
        @apply font-bold;
    }
    
    .support-option-description {
        @apply text-sm text-gray-600;
    }
    
    /* Scroll Indicator */
    .scroll-indicator {
        @apply text-center;
    }
    
    .scroll-indicator i {
        @apply text-2xl;
        animation: bounce 2s infinite;
    }
    
    /* Utility Classes */
    .hover-lift:hover {
        transform: translateY(-2px);
    }
    
    /* Media Queries */
    @media (max-width: 640px) {
        .contact-method-card {
            @apply p-5;
        }
        
        .contact-method-title {
            @apply text-xl;
        }
        
        .modal-container {
            @apply max-w-full;
        }
    }
</style>

<!-- JavaScript Magic -->
<script>
    // Initialize page with enhanced animations
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize number counting animation
        initNumberCounters();
        
        // Initialize enhanced form
        initEnhancedContactForm();
        
        // Initialize interactive elements
        initInteractiveElements();
        
        // Initialize scroll animations
        initScrollAnimations();
        
        // Initialize social media hover effects
        initSocialMediaEffects();
        
        // Initialize WhatsApp QR code animation
        initWhatsAppQRAnimation();
        
        // Initialize ripple effects
        initRippleEffects();
        
        // Initialize typing effect for headings
        initTypingEffect();
    });

    // Animated number counters
    function initNumberCounters() {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 50;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 30);
                } else {
                    counter.textContent = target;
                }
            };
            
            // Start counter when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            observer.observe(counter);
        });
    }

    // Enhanced contact form with validation
    function initEnhancedContactForm() {
        const form = document.getElementById('medicalContactForm');
        const inputs = form.querySelectorAll('.form-input, .form-textarea, select');
        
        // Add focus effects
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
            
            // Add character counter for textarea
            if (input.tagName === 'TEXTAREA') {
                const counter = document.createElement('div');
                counter.className = 'text-right text-sm text-gray-500 mt-1';
                counter.innerHTML = `<span class="char-count">0</span>/500`;
                input.parentElement.appendChild(counter);
                
                input.addEventListener('input', function() {
                    const count = this.value.length;
                    counter.querySelector('.char-count').textContent = count;
                    
                    if (count > 400) {
                        counter.classList.add('text-amber-600');
                    } else {
                        counter.classList.remove('text-amber-600');
                    }
                });
            }
        });
        
        // Form submission with enhanced feedback
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!form.checkValidity()) {
                // Add shake animation to invalid fields
                const invalidFields = form.querySelectorAll(':invalid');
                invalidFields.forEach(field => {
                    field.style.animation = 'shake 0.5s';
                    setTimeout(() => {
                        field.style.animation = '';
                    }, 500);
                });
                return;
            }
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = `
                <span class="flex items-center justify-center">
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    <span>Sending Medical Inquiry...</span>
                </span>
            `;
            submitBtn.disabled = true;
            
            // Simulate API call with enhanced animation
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            // Generate medical reference number
            const refNumber = Math.floor(10000 + Math.random() * 90000);
            const reference = `PDI-MED-${refNumber}`;
            
            // Show success modal with enhanced animation
            showSuccessModal(reference);
            
            // Reset form
            form.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            
            // Log to console (in production, send to backend)
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            console.log('Medical inquiry submitted:', {
                ...data,
                reference: reference,
                timestamp: new Date().toISOString()
            });
        });
    }

    // Interactive elements with animations
    function initInteractiveElements() {
        // Schedule callback with enhanced UI
        window.scheduleMedicalCallback = function() {
            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.innerHTML = `
                <div class="modal-container max-w-sm">
                    <div class="modal-content">
                        <h3 class="text-xl font-bold mb-4">Schedule Medical Callback</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Your Name</label>
                                <input type="text" class="form-input" placeholder="Full name" id="callbackName">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Phone Number</label>
                                <input type="tel" class="form-input" placeholder="+254 XXX XXX XXX" id="callbackPhone">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Preferred Time</label>
                                <select class="form-input" id="callbackTime">
                                    <option>Within 30 minutes</option>
                                    <option>Within 1 hour</option>
                                    <option>Within 2 hours</option>
                                    <option>Specific time (we'll call)</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex space-x-3 mt-6">
                            <button onclick="this.closest('.modal-overlay').remove()" 
                                    class="flex-1 border border-gray-300 rounded-xl py-3 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button onclick="confirmMedicalCallback()" 
                                    class="flex-1 bg-blue-600 text-white rounded-xl py-3 hover:bg-blue-700">
                                Schedule Call
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            modal.classList.remove('hidden');
        };
        
        // Email composer
        window.openEmailComposer = function() {
            const subject = 'Medical Inquiry - Precise Diagnostics';
            const body = `Dear Medical Team,\n\nI would like to inquire about:\n\n[Please describe your medical inquiry here]\n\nBest regards,\n[Your Name]`;
            
            window.location.href = `mailto:info@precisediagnostic.co.ke?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        };
        
        // Medical map view
        window.openMedicalMap = function() {
            const address = '5th Avenue Office Suites, Fifth Ngong Avenue, Nairobi';
            window.open(`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`, '_blank');
            
            // Show notification
            showNotification('Opening medical facility location in Google Maps...', 'info');
        };
        
        // Start medical support
        window.startMedicalSupport = function() {
            document.getElementById('supportModal').classList.remove('hidden');
        };
        
        // Close support modal
        window.closeSupportModal = function() {
            document.getElementById('supportModal').classList.add('hidden');
        };
        
        // Start video consultation
        window.startVideoConsultation = function() {
            showNotification('Video consultation feature coming soon! Please use WhatsApp or phone for now.', 'info');
            closeSupportModal();
        };
    }

    // Scroll animations with parallax effect
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observe all animated elements
        document.querySelectorAll('.animate-pop-in, .animate-slide-up, .animate-fade-in').forEach(el => {
            const delay = el.getAttribute('data-delay');
            if (delay) {
                el.style.animationDelay = delay;
            }
            observer.observe(el);
        });
        
        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            const heroBg = document.querySelector('.medical-gradient');
            
            if (heroBg) {
                heroBg.style.transform = `translate3d(0, ${rate}px, 0)`;
            }
        });
    }

    // Social media hover effects
    function initSocialMediaEffects() {
        const socialCards = document.querySelectorAll('.social-media-card');
        
        socialCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                const platform = this.getAttribute('data-platform');
                const icon = this.querySelector('i');
                
                // Add platform-specific animation
                switch(platform) {
                    case 'facebook':
                        icon.style.transform = 'scale(1.2)';
                        break;
                    case 'instagram':
                        icon.style.animation = 'spin 1s linear';
                        break;
                    case 'twitter':
                        icon.style.transform = 'translateY(-5px)';
                        break;
                    case 'linkedin':
                        icon.style.transform = 'rotate(10deg)';
                        break;
                }
            });
            
            card.addEventListener('mouseleave', function() {
                const icon = this.querySelector('i');
                icon.style.transform = '';
                icon.style.animation = '';
            });
        });
    }

    // WhatsApp QR code animation
    function initWhatsAppQRAnimation() {
        const qrContainer = document.querySelector('.qr-code-placeholder');
        if (qrContainer) {
            setTimeout(() => {
                qrContainer.style.transition = 'all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                qrContainer.style.opacity = '1';
                qrContainer.style.transform = 'scale(1) rotate(0deg)';
            }, 1000);
        }
    }

    // Ripple effect for buttons
    function initRippleEffects() {
        document.addEventListener('click', function(e) {
            const target = e.target.closest('.contact-action-btn, .submit-form-btn, .live-support-btn, .location-action-btn');
            
            if (target) {
                const ripple = document.createElement('span');
                const rect = target.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.7);
                    transform: scale(0);
                    animation: ripple-effect 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    top: ${y}px;
                    left: ${x}px;
                    pointer-events: none;
                    z-index: 1;
                `;
                
                target.style.position = 'relative';
                target.style.overflow = 'hidden';
                target.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            }
        });
    }

    // Typing effect for headings
    function initTypingEffect() {
        const heroTitle = document.querySelector('.font-heading');
        if (heroTitle) {
            const text = heroTitle.textContent;
            heroTitle.textContent = '';
            heroTitle.style.borderRight = '2px solid';
            
            let i = 0;
            const typeWriter = () => {
                if (i < text.length) {
                    heroTitle.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                } else {
                    heroTitle.style.borderRight = 'none';
                }
            };
            
            // Start typing when hero is in view
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    typeWriter();
                    observer.unobserve(heroTitle);
                }
            });
            
            observer.observe(heroTitle);
        }
    }

    // Show success modal with animation
    function showSuccessModal(reference) {
        const modal = document.getElementById('successModal');
        const refElement = document.getElementById('modalReference');
        
        refElement.textContent = reference;
        modal.classList.remove('hidden');
        
        // Add confetti effect
        createConfetti();
    }

    // Close success modal
    window.closeSuccessModal = function() {
        const modal = document.getElementById('successModal');
        modal.style.opacity = '1';
        
        modal.style.transition = 'opacity 0.3s ease-out';
        modal.style.opacity = '0';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.style.opacity = '1';
        }, 300);
    };

    // Confetti effect for success
    function createConfetti() {
        const colors = ['#3B82F6', '#10B981', '#8B5CF6', '#EF4444', '#F59E0B'];
        
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.cssText = `
                position: fixed;
                width: 10px;
                height: 10px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                top: -20px;
                left: ${Math.random() * 100}vw;
                border-radius: ${Math.random() > 0.5 ? '50%' : '0'};
                z-index: 1000;
                animation: fall ${Math.random() * 2 + 1}s linear forwards;
            `;
            
            document.body.appendChild(confetti);
            
            setTimeout(() => confetti.remove(), 3000);
        }
        
        // Add confetti animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                to {
                    transform: translateY(100vh) rotate(${Math.random() * 360}deg);
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Show notification
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 ${
            type === 'info' ? 'bg-blue-600 text-white' : 
            type === 'success' ? 'bg-green-600 text-white' : 
            'bg-amber-600 text-white'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Confirm medical callback
    window.confirmMedicalCallback = function() {
        const name = document.getElementById('callbackName').value;
        const phone = document.getElementById('callbackPhone').value;
        const time = document.getElementById('callbackTime').value;
        
        if (!name || !phone) {
            showNotification('Please fill in all fields', 'warning');
            return;
        }
        
        const modal = document.querySelector('.modal-overlay');
        modal.remove();
        
        showNotification(`Callback scheduled! We'll call you ${time.toLowerCase()}`, 'success');
        
        console.log('Medical callback scheduled:', { name, phone, time });
    };
</script>
@endsection