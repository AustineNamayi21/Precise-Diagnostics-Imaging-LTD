@extends('layouts.app')

@section('title', 'Our Imaging Services | Precise Diagnostics')

@section('content')
<!-- Hero Section -->
<section class="medical-gradient text-white py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-6">Advanced Diagnostic Imaging</h1>
            <p class="text-xl mb-10 opacity-90">
                State-of-the-art imaging technology with precision, clarity, and expert interpretation for accurate diagnoses.
            </p>
            
            <!-- Interactive Service Selector Wizard -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 mb-8">
                <h2 class="text-2xl font-bold mb-4"><i class="fas fa-search-medical mr-2"></i>Find Your Scan</h2>
                <p class="mb-6">Not sure which scan you need? Our smart guide helps you find the right imaging service.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button onclick="showSymptomChecker()" class="bg-white/20 hover:bg-white/30 p-4 rounded-xl transition flex flex-col items-center">
                        <i class="fas fa-stethoscope text-3xl mb-2"></i>
                        <span class="font-semibold">Symptom Checker</span>
                    </button>
                    
                    <button onclick="showBodyMap()" class="bg-white/20 hover:bg-white/30 p-4 rounded-xl transition flex flex-col items-center">
                        <i class="fas fa-user-md text-3xl mb-2"></i>
                        <span class="font-semibold">Interactive Body Map</span>
                    </button>
                    
                    <button onclick="showComparison()" class="bg-white/20 hover:bg-white/30 p-4 rounded-xl transition flex flex-col items-center">
                        <i class="fas fa-balance-scale text-3xl mb-2"></i>
                        <span class="font-semibold">Compare Scans</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Body Map Section -->
<section id="bodyMapSection" class="py-16 bg-gray-50 hidden">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12 font-heading">Interactive Body Map</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Body Diagram -->
            <div class="bg-white rounded-2xl p-8 shadow-xl">
                <div class="relative h-96">
                    <!-- Simplified body diagram with clickable areas -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <!-- Head -->
                            <button onclick="selectBodyPart('head')" class="body-part absolute -top-20 left-1/2 transform -translate-x-1/2" data-part="head">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center border-2 border-blue-300 hover:border-blue-500 transition">
                                    <i class="fas fa-brain text-blue-600"></i>
                                </div>
                                <span class="mt-2 text-sm font-semibold text-gray-700">Head/Brain</span>
                            </button>
                            
                            <!-- Chest -->
                            <button onclick="selectBodyPart('chest')" class="body-part absolute top-8 left-1/2 transform -translate-x-1/2" data-part="chest">
                                <div class="w-20 h-24 bg-red-100 rounded-lg flex items-center justify-center border-2 border-red-300 hover:border-red-500 transition">
                                    <i class="fas fa-heart text-red-600"></i>
                                </div>
                                <span class="mt-2 text-sm font-semibold text-gray-700">Chest/Heart</span>
                            </button>
                            
                            <!-- Abdomen -->
                            <button onclick="selectBodyPart('abdomen')" class="body-part absolute top-32 left-1/2 transform -translate-x-1/2" data-part="abdomen">
                                <div class="w-24 h-28 bg-green-100 rounded-lg flex items-center justify-center border-2 border-green-300 hover:border-green-500 transition">
                                    <i class="fas fa-liver text-green-600"></i>
                                </div>
                                <span class="mt-2 text-sm font-semibold text-gray-700">Abdomen</span>
                            </button>
                            
                            <!-- Limbs -->
                            <button onclick="selectBodyPart('limbs')" class="body-part absolute top-48 left-1/2 transform -translate-x-1/2" data-part="limbs">
                                <div class="w-20 h-32 bg-purple-100 rounded-lg flex items-center justify-center border-2 border-purple-300 hover:border-purple-500 transition">
                                    <i class="fas fa-bone text-purple-600"></i>
                                </div>
                                <span class="mt-2 text-sm font-semibold text-gray-700">Joints/Bones</span>
                            </button>
                        </div>
                    </div>
                </div>
                <p class="text-center text-gray-600 mt-6">Click on a body area to see recommended scans</p>
            </div>
            
            <!-- Recommended Scans Display -->
            <div id="recommendedScans" class="space-y-6">
                <div class="text-center py-12">
                    <i class="fas fa-mouse-pointer text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600">Select a Body Area</h3>
                    <p class="text-gray-500">Click on any body part above to see recommended imaging services</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- All Services Grid -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="font-heading text-4xl font-bold text-gray-900 mb-4">Our Comprehensive Imaging Services</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">Advanced technology, expert radiologists, and compassionate care for accurate diagnoses</p>
        </div>
        
        <!-- Service Categories -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="category-filter active" data-category="all">All Services</button>
            <button class="category-filter" data-category="neurological">Neurological</button>
            <button class="category-filter" data-category="cardiac">Cardiac</button>
            <button class="category-filter" data-category="musculoskeletal">Musculoskeletal</button>
            <button class="category-filter" data-category="abdominal">Abdominal</button>
            <button class="category-filter" data-category="general">General Imaging</button>
        </div>
        
        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- MRI Scanning -->
            <div class="service-card fade-in" data-categories="neurological musculoskeletal abdominal">
                <div class="service-header">
                    <div class="service-icon bg-blue-100">
                        <i class="fas fa-mri text-blue-600 text-3xl"></i>
                    </div>
                    <div class="service-badge">MOST ADVANCED</div>
                </div>
                <h3 class="service-title font-bold">MRI Scanning</h3>
                <p class="service-description font-semibold">
                    Magnetic resonance imaging (MRI) uses strong magnetic fields and radio waves to produce detailed images of the inside of the body.
                </p>
                
                <div class="service-specs">
                    <div class="spec-item">
                        <i class="fas fa-clock text-blue-500"></i>
                        <span>30-60 minutes</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-radiation text-green-500"></i>
                        <span>No Radiation</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-image text-purple-500"></i>
                        <span>3D Imaging</span>
                    </div>
                </div>
                
                <div class="service-pricing">
                    <div class="price-range">KES 15,000 - 45,000</div>
                    <div class="insurance-badge">
                        <i class="fas fa-shield-alt"></i>
                        Insurance Accepted
                    </div>
                </div>
                
                <div class="service-actions">
                    <button onclick="bookService('MRI Scanning')" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book MRI Scan
                    </button>
                    <button onclick="showDetails('mri')" class="btn-details">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                </div>
                
                <!-- Testimonial for this service -->
                <div class="service-testimonial">
                    <div class="testimonial-content">
                        "The MRI at Precise Diagnostics was painless and the staff was incredibly supportive. Results were explained clearly."
                    </div>
                    <div class="testimonial-author">
                        <div class="rating">★★★★★</div>
                        <span>John M., Nairobi</span>
                    </div>
                </div>
            </div>
            
            <!-- MR Spectroscopy -->
            <div class="service-card fade-in" data-categories="neurological">
                <div class="service-header">
                    <div class="service-icon bg-purple-100">
                        <i class="fas fa-brain text-purple-600 text-3xl"></i>
                    </div>
                </div>
                <h3 class="service-title font-bold">MR Spectroscopy</h3>
                <p class="service-description font-semibold">
                    Magnetic Resonance Spectroscopy is a noninvasive diagnostic test for measuring biochemical changes in the brain.
                </p>
                
                <div class="service-specs">
                    <div class="spec-item">
                        <i class="fas fa-clock text-blue-500"></i>
                        <span>45-75 minutes</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-atom text-purple-500"></i>
                        <span>Brain Chemistry</span>
                    </div>
                </div>
                
                <div class="service-pricing">
                    <div class="price-range">KES 25,000 - 35,000</div>
                    <div class="insurance-badge">
                        <i class="fas fa-shield-alt"></i>
                        Insurance Accepted
                    </div>
                </div>
                
                <div class="service-actions">
                    <button onclick="bookService('MR Spectroscopy')" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book MR Spectroscopy
                    </button>
                    <button onclick="showDetails('mr-spectroscopy')" class="btn-details">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                </div>
            </div>
            
            <!-- CT Scanning -->
            <div class="service-card fade-in" data-categories="neurological cardiac abdominal musculoskeletal">
                <div class="service-header">
                    <div class="service-icon bg-teal-100">
                        <i class="fas fa-ct-scan text-teal-600 text-3xl"></i>
                    </div>
                    <div class="service-badge">FAST RESULTS</div>
                </div>
                <h3 class="service-title font-bold">CT Scanning</h3>
                <p class="service-description font-semibold">
                    Computed Tomography (CT) scan is a painless, noninvasive way to detect diseases and injuries by producing 3D images.
                </p>
                
                <div class="service-specs">
                    <div class="spec-item">
                        <i class="fas fa-clock text-blue-500"></i>
                        <span>10-30 minutes</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-bolt text-yellow-500"></i>
                        <span>128-Slice Scanner</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-cube text-red-500"></i>
                        <span>3D Reconstruction</span>
                    </div>
                </div>
                
                <div class="service-pricing">
                    <div class="price-range">KES 8,000 - 25,000</div>
                    <div class="insurance-badge">
                        <i class="fas fa-shield-alt"></i>
                        Insurance Accepted
                    </div>
                </div>
                
                <div class="service-actions">
                    <button onclick="bookService('CT Scanning')" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book CT Scan
                    </button>
                    <button onclick="showDetails('ct')" class="btn-details">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                </div>
                
                <!-- Testimonial for this service -->
                <div class="service-testimonial">
                    <div class="testimonial-content">
                        "The CT scan was quick and efficient. I had my results within 2 hours. Highly recommended!"
                    </div>
                    <div class="testimonial-author">
                        <div class="rating">★★★★★</div>
                        <span>Sarah K., Mombasa</span>
                    </div>
                </div>
            </div>
            
            <!-- Ultrasound Scan -->
            <div class="service-card fade-in" data-categories="abdominal cardiac">
                <div class="service-header">
                    <div class="service-icon bg-blue-100">
                        <i class="fas fa-ultrasound text-blue-600 text-3xl"></i>
                    </div>
                </div>
                <h3 class="service-title font-bold">Ultrasound Scan</h3>
                <p class="service-description font-semibold">
                    Ultrasound uses high-frequency sound waves to capture live images from the inside of your body. Safe with no radiation.
                </p>
                
                <div class="service-specs">
                    <div class="spec-item">
                        <i class="fas fa-clock text-blue-500"></i>
                        <span>15-45 minutes</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-baby text-pink-500"></i>
                        <span>Pregnancy Safe</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-video text-green-500"></i>
                        <span>Live Imaging</span>
                    </div>
                </div>
                
                <div class="service-pricing">
                    <div class="price-range">KES 5,000 - 15,000</div>
                    <div class="insurance-badge">
                        <i class="fas fa-shield-alt"></i>
                        Insurance Accepted
                    </div>
                </div>
                
                <div class="service-actions">
                    <button onclick="bookService('Ultrasound Scan')" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book Ultrasound
                    </button>
                    <button onclick="showDetails('ultrasound')" class="btn-details">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                </div>
            </div>
            
            <!-- Fluoroscopy -->
            <div class="service-card fade-in" data-categories="general">
                <div class="service-header">
                    <div class="service-icon bg-red-100">
                        <i class="fas fa-x-ray-video text-red-600 text-3xl"></i>
                    </div>
                </div>
                <h3 class="service-title font-bold">Fluoroscopy</h3>
                <p class="service-description font-semibold">
                    Fluoroscopy shows continuous X-ray images on a monitor, like an X-ray movie. Used for real-time visualization of bodily functions.
                </p>
                
                <div class="service-specs">
                    <div class="spec-item">
                        <i class="fas fa-clock text-blue-500"></i>
                        <span>20-60 minutes</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-film text-red-500"></i>
                        <span>Real-time Video</span>
                    </div>
                </div>
                
                <div class="service-pricing">
                    <div class="price-range">KES 10,000 - 30,000</div>
                </div>
                
                <div class="service-actions">
                    <button onclick="bookService('Fluoroscopy')" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book Fluoroscopy
                    </button>
                    <button onclick="showDetails('fluoroscopy')" class="btn-details">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                </div>
            </div>
            
            <!-- ECG Scan -->
            <div class="service-card fade-in" data-categories="cardiac">
                <div class="service-header">
                    <div class="service-icon bg-green-100">
                        <i class="fas fa-heartbeat text-green-600 text-3xl"></i>
                    </div>
                </div>
                <h3 class="service-title font-bold">ECG Scan</h3>
                <p class="service-description font-semibold">
                    Electrocardiogram (ECG) checks your heart's rhythm and electrical activity. Simple, painless, and provides immediate results.
                </p>
                
                <div class="service-specs">
                    <div class="spec-item">
                        <i class="fas fa-clock text-blue-500"></i>
                        <span>5-10 minutes</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-bolt text-yellow-500"></i>
                        <span>Immediate Results</span>
                    </div>
                </div>
                
                <div class="service-pricing">
                    <div class="price-range">KES 3,000 - 5,000</div>
                    <div class="insurance-badge">
                        <i class="fas fa-shield-alt"></i>
                        Insurance Accepted
                    </div>
                </div>
                
                <div class="service-actions">
                    <button onclick="bookService('ECG Scan')" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book ECG
                    </button>
                    <button onclick="showDetails('ecg')" class="btn-details">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                </div>
                
                <!-- Testimonial for this service -->
                <div class="service-testimonial">
                    <div class="testimonial-content">
                        "Quick ECG that detected my irregular heartbeat. The doctor explained everything clearly. Life-saving!"
                    </div>
                    <div class="testimonial-author">
                        <div class="rating">★★★★★</div>
                        <span>Michael O., Kisumu</span>
                    </div>
                </div>
            </div>
            
            <!-- General X-Ray -->
            <div class="service-card fade-in" data-categories="musculoskeletal general">
                <div class="service-header">
                    <div class="service-icon bg-gray-100">
                        <i class="fas fa-x-ray text-gray-600 text-3xl"></i>
                    </div>
                </div>
                <h3 class="service-title font-bold">General X-Ray</h3>
                <p class="service-description font-semibold">
                    General X-rays are used for initial assessment of bones and joints to rule out fractures and arthritis, and to follow up surgical procedures.
                </p>
                
                <div class="service-specs">
                    <div class="spec-item">
                        <i class="fas fa-clock text-blue-500"></i>
                        <span>5-15 minutes</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-image text-gray-500"></i>
                        <span>Digital Imaging</span>
                    </div>
                </div>
                
                <div class="service-pricing">
                    <div class="price-range">KES 2,000 - 8,000</div>
                    <div class="insurance-badge">
                        <i class="fas fa-shield-alt"></i>
                        Insurance Accepted
                    </div>
                </div>
                
                <div class="service-actions">
                    <button onclick="bookService('General X-Ray')" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book X-Ray
                    </button>
                    <button onclick="showDetails('xray')" class="btn-details">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                </div>
            </div>
            
        </div>
        
        <!-- Other Services Section -->
        <div class="mt-20 bg-gradient-to-r from-blue-50 to-teal-50 rounded-2xl p-8">
            <h3 class="text-2xl font-bold mb-6 text-center font-bold">Other Specialized Services</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="text-blue-600 text-2xl mb-3">
                        <i class="fas fa-heart text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Echocardiography (Echo)</h4>
                    <p class="text-gray-700 font-medium text-sm">Ultrasound of the heart to assess cardiac structure and function.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="text-purple-600 text-2xl mb-3">
                        <i class="fas fa-brain text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Electroencephalography (EEG)</h4>
                    <p class="text-gray-700 font-medium text-sm">Records electrical activity of the brain for neurological assessment.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="text-green-600 text-2xl mb-3">
                        <i class="fas fa-running text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Nerve Conduction Tests (NCT)</h4>
                    <p class="text-gray-700 font-medium text-sm">Measures how fast electrical signals move through your nerves.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Insurance & Payment Information -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold mb-6 font-heading font-bold">Insurance & Payment</h2>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-green-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl mb-2 font-bold">Insurance Partners</h3>
                            <p class="text-gray-700 font-medium">We work with all major insurance providers including NHIF, Jubilee, APA, AAR, and more.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-credit-card text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl mb-2 font-bold">Flexible Payment Options</h3>
                            <p class="text-gray-700 font-medium">Cash, M-Pesa, debit/credit cards, and payment plans available for all services.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-xl">
                <h3 class="text-2xl font-bold mb-6 font-bold">Instant Quote Request</h3>
                <form id="quoteForm" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Select Service</label>
                        <select class="w-full p-3 border border-gray-300 rounded-lg">
                            <option>MRI Scanning</option>
                            <option>CT Scanning</option>
                            <option>Ultrasound Scan</option>
                            <option>ECG Scan</option>
                            <option>General X-Ray</option>
                            <option>Other Services</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Insurance Provider</label>
                        <select class="w-full p-3 border border-gray-300 rounded-lg">
                            <option>NHIF</option>
                            <option>Jubilee Insurance</option>
                            <option>APA Insurance</option>
                            <option>AAR Insurance</option>
                            <option>Other</option>
                            <option>No Insurance</option>
                        </select>
                    </div>
                    <button type="button" onclick="requestQuote()" class="w-full medical-gradient text-white p-4 rounded-xl font-bold hover:opacity-90 transition">
                        <i class="fas fa-calculator mr-2"></i> Get Instant Quote
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="medical-gradient py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="font-heading text-4xl font-bold text-white mb-6">Ready for Your Diagnostic Scan?</h2>
        <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
            Book your appointment online or speak with our imaging specialists for guidance.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/appointments" class="bg-white text-blue-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all">
                <i class="fas fa-calendar-alt mr-2"></i> Book Appointment Online
            </a>
            <a href="tel:+254712345678" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all">
                <i class="fas fa-phone-alt mr-2"></i> Call: +254 712 345 678
            </a>
        </div>
    </div>
</section>

<!-- Service Details Modal (Hidden by default) -->
<div id="serviceModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <h3 id="modalTitle" class="text-3xl font-bold">Service Details</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div id="modalContent">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
    /* Service Card Styles */
    .service-card {
        @apply bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100;
    }
    
    .service-header {
        @apply flex justify-between items-start mb-4;
    }
    
    .service-icon {
        @apply w-16 h-16 rounded-2xl flex items-center justify-center;
    }
    
    .service-badge {
        @apply bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full;
    }
    
    .service-title {
        @apply text-2xl font-bold text-gray-900 mb-3; /* Already has font-bold */
    }
    
    .service-description {
        @apply text-gray-700 font-semibold mb-6 leading-relaxed; /* Added font-semibold */
    }
    
    .service-specs {
        @apply flex flex-wrap gap-3 mb-6;
    }
    
    .spec-item {
        @apply flex items-center text-sm text-gray-700 bg-gray-50 px-3 py-2 rounded-lg;
    }
    
    .service-pricing {
        @apply flex justify-between items-center mb-6;
    }
    
    .price-range {
        @apply text-xl font-bold text-blue-600;
    }
    
    .insurance-badge {
        @apply bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full flex items-center;
    }
    
    .service-actions {
        @apply flex gap-3 mb-6;
    }
    
    .btn-book {
        @apply flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition flex items-center justify-center;
    }
    
    .btn-details {
        @apply px-6 py-3 border border-blue-600 text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition;
    }
    
    .service-testimonial {
        @apply bg-blue-50 border border-blue-100 rounded-xl p-4;
    }
    
    .testimonial-content {
        @apply text-gray-700 italic mb-2;
    }
    
    .testimonial-author {
        @apply flex justify-between items-center text-sm;
    }
    
    .rating {
        @apply text-yellow-500;
    }
    
    /* Category Filter Styles */
    .category-filter {
        @apply px-6 py-2 rounded-full border border-gray-300 text-gray-700 font-medium hover:border-blue-500 hover:text-blue-600 transition;
    }
    
    .category-filter.active {
        @apply bg-blue-600 text-white border-blue-600;
    }
    
    /* Body Map Styles */
    .body-part {
        @apply flex flex-col items-center cursor-pointer transition-transform duration-300;
    }
    
    .body-part:hover {
        transform: scale(1.1);
    }
    
    /* Make all important text bold */
    .font-bold {
        font-weight: 700 !important;
    }
    
    .font-semibold {
        font-weight: 600 !important;
    }
</style>

<script>
    // Body Map Functionality
    const bodyPartServices = {
        'head': [
            { name: 'MRI Scanning', description: 'Detailed brain imaging for neurological conditions', icon: 'fas fa-mri' },
            { name: 'CT Scanning', description: 'Quick brain scan for trauma or stroke assessment', icon: 'fas fa-ct-scan' },
            { name: 'MR Spectroscopy', description: 'Biochemical analysis of brain tissue', icon: 'fas fa-brain' }
        ],
        'chest': [
            { name: 'CT Scanning', description: 'Detailed lung and heart imaging', icon: 'fas fa-ct-scan' },
            { name: 'ECG Scan', description: 'Heart rhythm and electrical activity', icon: 'fas fa-heartbeat' },
            { name: 'Ultrasound Scan', description: 'Heart structure assessment (Echo)', icon: 'fas fa-ultrasound' }
        ],
        'abdomen': [
            { name: 'Ultrasound Scan', description: 'Liver, kidneys, gallbladder assessment', icon: 'fas fa-ultrasound' },
            { name: 'CT Scanning', description: 'Comprehensive abdominal imaging', icon: 'fas fa-ct-scan' },
            { name: 'MRI Scanning', description: 'Detailed soft tissue abdominal imaging', icon: 'fas fa-mri' }
        ],
        'limbs': [
            { name: 'General X-Ray', description: 'Bone fractures and joint assessment', icon: 'fas fa-x-ray' },
            { name: 'MRI Scanning', description: 'Soft tissue injuries and joint details', icon: 'fas fa-mri' },
            { name: 'Ultrasound Scan', description: 'Muscle and tendon assessment', icon: 'fas fa-ultrasound' }
        ]
    };

    function showBodyMap() {
        document.getElementById('bodyMapSection').classList.remove('hidden');
        window.scrollTo({
            top: document.getElementById('bodyMapSection').offsetTop - 100,
            behavior: 'smooth'
        });
    }

    function selectBodyPart(part) {
        const services = bodyPartServices[part];
        const container = document.getElementById('recommendedScans');
        
        let html = `
            <h3 class="text-2xl font-bold mb-6">Recommended Scans for ${part.charAt(0).toUpperCase() + part.slice(1)}</h3>
            <div class="space-y-4">
        `;
        
        services.forEach(service => {
            html += `
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-2">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                            <i class="${service.icon} text-blue-600"></i>
                        </div>
                        <div>
                            <div class="font-bold">${service.name}</div>
                            <div class="text-sm text-gray-600 font-medium">${service.description}</div>
                        </div>
                    </div>
                    <button onclick="bookService('${service.name}')" class="mt-2 w-full bg-blue-50 text-blue-700 py-2 rounded-lg font-medium hover:bg-blue-100 transition">
                        Book ${service.name}
                    </button>
                </div>
            `;
        });
        
        html += `</div>`;
        container.innerHTML = html;
    }

    // Service Filtering
    document.querySelectorAll('.category-filter').forEach(button => {
        button.addEventListener('click', function() {
            // Update active button
            document.querySelectorAll('.category-filter').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.dataset.category;
            const serviceCards = document.querySelectorAll('.service-card');
            
            serviceCards.forEach(card => {
                if (category === 'all' || card.dataset.categories.includes(category)) {
                    card.style.display = 'block';
                    setTimeout(() => card.style.opacity = '1', 10);
                } else {
                    card.style.opacity = '0';
                    setTimeout(() => card.style.display = 'none', 300);
                }
            });
        });
    });

    // Booking Function
    function bookService(serviceName) {
        alert(`Booking ${serviceName}... Redirecting to appointment page.`);
        window.location.href = '/appointments?service=' + encodeURIComponent(serviceName);
    }

    // Modal Functions
    function showDetails(serviceType) {
        const modal = document.getElementById('serviceModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        
        // Service details content
        const serviceDetails = {
            'mri': {
                title: 'MRI Scanning - Complete Details',
                content: `
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-bold text-lg mb-2">What is MRI?</h4>
                                <p class="text-gray-700 font-medium">Magnetic Resonance Imaging (MRI) uses powerful magnets and radio waves to create detailed images of organs and tissues without radiation.</p>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-2">Preparation</h4>
                                <ul class="list-disc pl-5 text-gray-700 font-medium space-y-1">
                                    <li>No metal objects allowed</li>
                                    <li>May require fasting for abdominal scans</li>
                                    <li>Inform staff of any implants</li>
                                    <li>Wear comfortable clothing</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-xl">
                            <h4 class="font-bold text-lg mb-2">Our Technology</h4>
                            <p class="font-medium">We use a 3T (Tesla) MRI scanner which provides higher resolution images than standard 1.5T scanners, allowing for more accurate diagnoses.</p>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-lg mb-2">Common Uses</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <span class="bg-gray-100 px-3 py-2 rounded-lg font-medium">Brain Tumors</span>
                                <span class="bg-gray-100 px-3 py-2 rounded-lg font-medium">Spinal Injuries</span>
                                <span class="bg-gray-100 px-3 py-2 rounded-lg font-medium">Joint Problems</span>
                                <span class="bg-gray-100 px-3 py-2 rounded-lg font-medium">Soft Tissue</span>
                            </div>
                        </div>
                    </div>
                `
            },
            'ct': {
                title: 'CT Scanning - Complete Details',
                content: `
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold text-lg mb-2">About CT Scan</h4>
                            <p class="text-gray-700 font-medium">Computed Tomography (CT) combines multiple X-ray measurements taken from different angles to produce cross-sectional images.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2">Our 128-Slice CT Scanner</h4>
                            <p class="text-gray-700 font-medium">Our advanced 128-slice scanner provides faster scanning, lower radiation dose, and higher resolution images than traditional CT scanners.</p>
                        </div>
                    </div>
                `
            }
            // Add more service details as needed
        };
        
        if (serviceDetails[serviceType]) {
            modalTitle.textContent = serviceDetails[serviceType].title;
            modalContent.innerHTML = serviceDetails[serviceType].content;
            modal.classList.remove('hidden');
        }
    }

    function closeModal() {
        document.getElementById('serviceModal').classList.add('hidden');
    }

    // Quote Request
    function requestQuote() {
        alert('Quote request sent! Our team will contact you within 30 minutes with detailed pricing.');
    }

    // Symptom Checker
    function showSymptomChecker() {
        alert('Symptom checker feature coming soon! This will guide patients to the appropriate scan based on their symptoms.');
    }

    function showComparison() {
        alert('Scan comparison feature coming soon! Compare MRI vs CT vs Ultrasound features side-by-side.');
    }
</script>
@endsection