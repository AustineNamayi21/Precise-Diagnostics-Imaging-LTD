{{-- resources/views/web/services.blade.php --}}
@extends('layouts.web')

@section('title', 'Our Imaging Services | Precise Diagnostics')

@section('content')

<!-- HERO -->
<section class="medical-gradient text-white relative overflow-hidden py-20">
    <!-- Decorative bubbles -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute top-20 right-10 w-52 h-52 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-10 left-1/3 w-44 h-44 bg-white/10 rounded-full blur-2xl"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center reveal">
            <h1 class="font-heading text-5xl md:text-6xl font-extrabold mb-6">
                Advanced Diagnostic Imaging
            </h1>
            <p class="text-xl mb-10 text-white/90">
                State-of-the-art imaging technology with precision, clarity, and expert interpretation for accurate diagnoses.
            </p>

            <!-- Smart Guide -->
            <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-2xl p-6 md:p-8 shadow-xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="text-left">
                        <h2 class="text-2xl md:text-3xl font-extrabold">
                            <i class="fas fa-search-medical mr-2"></i> Find Your Scan
                        </h2>
                        <p class="text-white/90 mt-2">
                            Not sure which scan you need? Explore recommendations and compare options.
                        </p>
                    </div>

                    <a href="{{ route('appointments') }}"
                       class="bg-white text-blue-900 px-6 py-3 rounded-xl font-extrabold hover:bg-gray-100 transition inline-flex items-center justify-center shadow-lg">
                        <i class="fas fa-calendar-check mr-2"></i> Book Appointment
                    </a>
                </div>

                <!-- Tabs -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                    <button type="button"
                            class="scan-tab bg-white/15 border border-white/15 hover:bg-white/20 px-5 py-3 rounded-xl font-bold transition inline-flex items-center justify-center"
                            data-tab="bodymap">
                        <i class="fas fa-user-md mr-2"></i> Interactive Body Map
                    </button>
                    <button type="button"
                            class="scan-tab bg-transparent border border-white/15 hover:bg-white/10 px-5 py-3 rounded-xl font-bold transition inline-flex items-center justify-center"
                            data-tab="compare">
                        <i class="fas fa-balance-scale mr-2"></i> Compare Scans
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TAB PANELS WRAPPER -->
<section class="bg-slate-50 py-16">
    <div class="container mx-auto px-6">

        <!-- Body Map Panel -->
        <div id="tab-bodymap" class="reveal">
            <div class="text-center mb-10">
                <h2 class="font-heading text-4xl font-extrabold text-slate-900">Interactive Body Map</h2>
                <p class="text-slate-600 mt-2 max-w-2xl mx-auto">
                    Click an area to view recommended imaging services.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
                <!-- Selector -->
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button type="button" class="body-btn w-full text-left" data-part="head">
                            <span class="icon"><i class="fas fa-brain text-white"></i></span>
                            <span>
                                <div class="label text-slate-900">Head / Brain</div>
                                <div class="text-slate-600 text-sm">Neurology, trauma, stroke checks</div>
                            </span>
                        </button>

                        <button type="button" class="body-btn w-full text-left" data-part="chest">
                            <span class="icon"><i class="fas fa-heart text-white"></i></span>
                            <span>
                                <div class="label text-slate-900">Chest / Heart</div>
                                <div class="text-slate-600 text-sm">Lungs, chest pain, heart rhythm</div>
                            </span>
                        </button>

                        <button type="button" class="body-btn w-full text-left" data-part="abdomen">
                            <span class="icon"><i class="fas fa-liver text-white"></i></span>
                            <span>
                                <div class="label text-slate-900">Abdomen</div>
                                <div class="text-slate-600 text-sm">Liver, kidney, gallbladder</div>
                            </span>
                        </button>

                        <button type="button" class="body-btn w-full text-left" data-part="limbs">
                            <span class="icon"><i class="fas fa-bone text-white"></i></span>
                            <span>
                                <div class="label text-slate-900">Joints / Bones</div>
                                <div class="text-slate-600 text-sm">Fractures, ligaments, sports injuries</div>
                            </span>
                        </button>
                    </div>

                    <div class="mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-5 text-slate-700">
                        <div class="font-extrabold text-slate-900 mb-1">
                            Tip
                        </div>
                        If you already have a doctor’s request, you can skip this and book directly.
                    </div>
                </div>

                <!-- Recommendations -->
                <div id="recommendedScans" class="space-y-4">
                    <div class="bg-white rounded-3xl p-10 shadow-xl border border-slate-100 text-center">
                        <i class="fas fa-mouse-pointer text-4xl text-slate-300 mb-4"></i>
                        <h3 class="text-xl font-extrabold text-slate-700">Select a Body Area</h3>
                        <p class="text-slate-500 mt-1">Recommendations will appear here.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compare Panel -->
        <div id="tab-compare" class="hidden reveal">
            <div class="text-center mb-10">
                <h2 class="font-heading text-4xl font-extrabold text-slate-900">Compare Scans</h2>
                <p class="text-slate-600 mt-2 max-w-2xl mx-auto">
                    Quick guide to help you understand what each scan is best for.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl p-7 shadow-xl border border-slate-100">
                    <div class="text-3xl mb-3 text-blue-600"><i class="fas fa-mri"></i></div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">MRI</h3>
                    <ul class="text-slate-700 space-y-2">
                        <li><strong>Best for:</strong> brain, spine, joints, soft tissues</li>
                        <li><strong>Radiation:</strong> none</li>
                        <li><strong>Time:</strong> 30–60 mins</li>
                    </ul>
                </div>

                <div class="bg-white rounded-3xl p-7 shadow-xl border border-slate-100">
                    <div class="text-3xl mb-3 text-teal-600"><i class="fas fa-ct-scan"></i></div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">CT</h3>
                    <ul class="text-slate-700 space-y-2">
                        <li><strong>Best for:</strong> trauma, lungs, abdomen, urgent checks</li>
                        <li><strong>Radiation:</strong> yes (controlled dose)</li>
                        <li><strong>Time:</strong> 10–30 mins</li>
                    </ul>
                </div>

                <div class="bg-white rounded-3xl p-7 shadow-xl border border-slate-100">
                    <div class="text-3xl mb-3 text-indigo-600"><i class="fas fa-ultrasound"></i></div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Ultrasound</h3>
                    <ul class="text-slate-700 space-y-2">
                        <li><strong>Best for:</strong> pregnancy, abdomen, some heart checks</li>
                        <li><strong>Radiation:</strong> none</li>
                        <li><strong>Time:</strong> 15–45 mins</li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 bg-white rounded-3xl p-8 shadow-xl border border-slate-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Still unsure?</h3>
                        <p class="text-slate-600 mt-1">Talk to our team and we’ll guide you based on your doctor’s request.</p>
                    </div>
                    <a href="{{ route('contact') }}"
                       class="bg-blue-600 text-white px-6 py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-phone-alt mr-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ALL SERVICES -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12 reveal">
            <h2 class="font-heading text-4xl font-extrabold text-slate-900">Our Comprehensive Imaging Services</h2>
            <p class="text-slate-600 max-w-3xl mx-auto mt-2">
                Advanced technology, expert radiologists, and compassionate care for accurate diagnoses.
            </p>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-3 mb-10 reveal">
            <button class="category-filter active" data-category="all" type="button">All Services</button>
            <button class="category-filter" data-category="neurological" type="button">Neurological</button>
            <button class="category-filter" data-category="cardiac" type="button">Cardiac</button>
            <button class="category-filter" data-category="musculoskeletal" type="button">Musculoskeletal</button>
            <button class="category-filter" data-category="abdominal" type="button">Abdominal</button>
            <button class="category-filter" data-category="general" type="button">General Imaging</button>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- MRI -->
            <div class="service-card reveal" data-categories="neurological musculoskeletal abdominal">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-mri text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-slate-900 font-extrabold text-lg">MRI Scanning</div>
                            <div class="text-slate-500 text-sm font-semibold">Most advanced soft-tissue imaging</div>
                        </div>
                    </div>
                    <span class="text-xs font-extrabold bg-blue-600 text-white px-3 py-1 rounded-full">ADVANCED</span>
                </div>

                <p class="text-slate-700 leading-relaxed">
                    Magnetic resonance imaging creates detailed images using magnetic fields and radio waves (no radiation).
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-clock mr-2 text-blue-600"></i> 30–60 mins
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-radiation mr-2 text-green-600"></i> No radiation
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-cube mr-2 text-purple-600"></i> 3D imaging
                    </span>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-semibold">Estimated range</div>
                        <div class="text-blue-700 font-extrabold text-xl">KES 15,000 – 45,000</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-full text-sm font-extrabold">
                        <i class="fas fa-shield-alt mr-1"></i> Insurance
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('appointments') }}?service={{ urlencode('MRI Scanning') }}"
                       class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book
                    </a>
                    <button type="button" data-details="mri"
                            class="px-5 py-3 border border-blue-600 text-blue-700 rounded-xl font-extrabold hover:bg-blue-50 transition">
                        <i class="fas fa-info-circle mr-2"></i> Details
                    </button>
                </div>

                <div class="mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-4">
                    <div class="text-slate-700 italic">“The MRI was painless and the staff was incredibly supportive.”</div>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <span class="text-yellow-500 font-extrabold">★★★★★</span>
                        <span class="text-slate-600 font-semibold">John M., Nairobi</span>
                    </div>
                </div>
            </div>

            <!-- MR Spectroscopy -->
            <div class="service-card reveal" data-categories="neurological">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center">
                            <i class="fas fa-brain text-purple-600 text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-slate-900 font-extrabold text-lg">MR Spectroscopy</div>
                            <div class="text-slate-500 text-sm font-semibold">Biochemical brain analysis</div>
                        </div>
                    </div>
                </div>

                <p class="text-slate-700 leading-relaxed">
                    A noninvasive diagnostic test for measuring biochemical changes in the brain.
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-clock mr-2 text-blue-600"></i> 45–75 mins
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-atom mr-2 text-purple-600"></i> Brain chemistry
                    </span>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-semibold">Estimated range</div>
                        <div class="text-purple-700 font-extrabold text-xl">KES 25,000 – 35,000</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-full text-sm font-extrabold">
                        <i class="fas fa-shield-alt mr-1"></i> Insurance
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('appointments') }}?service={{ urlencode('MR Spectroscopy') }}"
                       class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book
                    </a>
                    <button type="button" data-details="mrs"
                            class="px-5 py-3 border border-blue-600 text-blue-700 rounded-xl font-extrabold hover:bg-blue-50 transition">
                        <i class="fas fa-info-circle mr-2"></i> Details
                    </button>
                </div>
            </div>

            <!-- CT -->
            <div class="service-card reveal" data-categories="neurological cardiac abdominal musculoskeletal general">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-teal-50 flex items-center justify-center">
                            <i class="fas fa-ct-scan text-teal-600 text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-slate-900 font-extrabold text-lg">CT Scanning</div>
                            <div class="text-slate-500 text-sm font-semibold">Fast 3D reconstruction</div>
                        </div>
                    </div>
                    <span class="text-xs font-extrabold bg-teal-600 text-white px-3 py-1 rounded-full">FAST</span>
                </div>

                <p class="text-slate-700 leading-relaxed">
                    A painless, noninvasive way to detect diseases and injuries by producing cross-sectional images.
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-clock mr-2 text-blue-600"></i> 10–30 mins
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-bolt mr-2 text-yellow-600"></i> 128-slice
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-cube mr-2 text-red-600"></i> 3D
                    </span>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-semibold">Estimated range</div>
                        <div class="text-teal-700 font-extrabold text-xl">KES 8,000 – 25,000</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-full text-sm font-extrabold">
                        <i class="fas fa-shield-alt mr-1"></i> Insurance
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('appointments') }}?service={{ urlencode('CT Scanning') }}"
                       class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book
                    </a>
                    <button type="button" data-details="ct"
                            class="px-5 py-3 border border-blue-600 text-blue-700 rounded-xl font-extrabold hover:bg-blue-50 transition">
                        <i class="fas fa-info-circle mr-2"></i> Details
                    </button>
                </div>

                <div class="mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-4">
                    <div class="text-slate-700 italic">“Quick and efficient. I had my results within 2 hours.”</div>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <span class="text-yellow-500 font-extrabold">★★★★★</span>
                        <span class="text-slate-600 font-semibold">Sarah K., Mombasa</span>
                    </div>
                </div>
            </div>

            <!-- Ultrasound -->
            <div class="service-card reveal" data-categories="abdominal cardiac general">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-ultrasound text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-slate-900 font-extrabold text-lg">Ultrasound Scan</div>
                            <div class="text-slate-500 text-sm font-semibold">Safe, real-time imaging</div>
                        </div>
                    </div>
                </div>

                <p class="text-slate-700 leading-relaxed">
                    Uses high-frequency sound waves to capture live images from inside your body (no radiation).
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-clock mr-2 text-blue-600"></i> 15–45 mins
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-baby mr-2 text-pink-600"></i> Pregnancy safe
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-video mr-2 text-green-600"></i> Live imaging
                    </span>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-semibold">Estimated range</div>
                        <div class="text-blue-700 font-extrabold text-xl">KES 5,000 – 15,000</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-full text-sm font-extrabold">
                        <i class="fas fa-shield-alt mr-1"></i> Insurance
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('appointments') }}?service={{ urlencode('Ultrasound Scan') }}"
                       class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book
                    </a>
                    <button type="button" data-details="ultrasound"
                            class="px-5 py-3 border border-blue-600 text-blue-700 rounded-xl font-extrabold hover:bg-blue-50 transition">
                        <i class="fas fa-info-circle mr-2"></i> Details
                    </button>
                </div>
            </div>

            <!-- Fluoroscopy -->
            <div class="service-card reveal" data-categories="general">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center">
                            <i class="fas fa-x-ray text-red-600 text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-slate-900 font-extrabold text-lg">Fluoroscopy</div>
                            <div class="text-slate-500 text-sm font-semibold">Real-time X-ray</div>
                        </div>
                    </div>
                </div>

                <p class="text-slate-700 leading-relaxed">
                    Continuous X-ray images on a monitor, like an X-ray movie, used for real-time visualization.
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-clock mr-2 text-blue-600"></i> 20–60 mins
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-film mr-2 text-red-600"></i> Real-time
                    </span>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-semibold">Estimated range</div>
                        <div class="text-red-700 font-extrabold text-xl">KES 10,000 – 30,000</div>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('appointments') }}?service={{ urlencode('Fluoroscopy') }}"
                       class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book
                    </a>
                    <button type="button" data-details="fluoro"
                            class="px-5 py-3 border border-blue-600 text-blue-700 rounded-xl font-extrabold hover:bg-blue-50 transition">
                        <i class="fas fa-info-circle mr-2"></i> Details
                    </button>
                </div>
            </div>

            <!-- ECG -->
            <div class="service-card reveal" data-categories="cardiac general">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center">
                            <i class="fas fa-heartbeat text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-slate-900 font-extrabold text-lg">ECG Scan</div>
                            <div class="text-slate-500 text-sm font-semibold">Immediate results</div>
                        </div>
                    </div>
                </div>

                <p class="text-slate-700 leading-relaxed">
                    Electrocardiogram checks your heart’s rhythm and electrical activity. Simple and painless.
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-clock mr-2 text-blue-600"></i> 5–10 mins
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-bolt mr-2 text-yellow-600"></i> Immediate
                    </span>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-semibold">Estimated range</div>
                        <div class="text-green-700 font-extrabold text-xl">KES 3,000 – 5,000</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-full text-sm font-extrabold">
                        <i class="fas fa-shield-alt mr-1"></i> Insurance
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('appointments') }}?service={{ urlencode('ECG Scan') }}"
                       class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book
                    </a>
                    <button type="button" data-details="ecg"
                            class="px-5 py-3 border border-blue-600 text-blue-700 rounded-xl font-extrabold hover:bg-blue-50 transition">
                        <i class="fas fa-info-circle mr-2"></i> Details
                    </button>
                </div>

                <div class="mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-4">
                    <div class="text-slate-700 italic">“Quick ECG that detected my irregular heartbeat.”</div>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <span class="text-yellow-500 font-extrabold">★★★★★</span>
                        <span class="text-slate-600 font-semibold">Michael O., Kisumu</span>
                    </div>
                </div>
            </div>

            <!-- X-Ray -->
            <div class="service-card reveal" data-categories="musculoskeletal general">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center">
                            <i class="fas fa-x-ray text-slate-700 text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-slate-900 font-extrabold text-lg">General X-Ray</div>
                            <div class="text-slate-500 text-sm font-semibold">Fast digital imaging</div>
                        </div>
                    </div>
                </div>

                <p class="text-slate-700 leading-relaxed">
                    Used for initial assessment of bones and joints (fractures, arthritis) and post-surgical follow-up.
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-clock mr-2 text-blue-600"></i> 5–15 mins
                    </span>
                    <span class="text-sm bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-slate-700">
                        <i class="fas fa-image mr-2 text-slate-600"></i> Digital
                    </span>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-semibold">Estimated range</div>
                        <div class="text-slate-800 font-extrabold text-xl">KES 2,000 – 8,000</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-full text-sm font-extrabold">
                        <i class="fas fa-shield-alt mr-1"></i> Insurance
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('appointments') }}?service={{ urlencode('General X-Ray') }}"
                       class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i> Book
                    </a>
                    <button type="button" data-details="xray"
                            class="px-5 py-3 border border-blue-600 text-blue-700 rounded-xl font-extrabold hover:bg-blue-50 transition">
                        <i class="fas fa-info-circle mr-2"></i> Details
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- INSURANCE + QUOTE -->
<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="reveal">
                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-slate-900 mb-6">Insurance & Payment</h2>

                <div class="space-y-6">
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center">
                                <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                            </div>
                            <div>
                                <div class="text-xl font-extrabold text-slate-900">Insurance Partners</div>
                                <p class="text-slate-600 mt-1">
                                    We work with major providers including NHIF, Jubilee, APA, AAR, and more.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-credit-card text-blue-600 text-2xl"></i>
                            </div>
                            <div>
                                <div class="text-xl font-extrabold text-slate-900">Flexible Payment Options</div>
                                <p class="text-slate-600 mt-1">
                                    Cash, M-Pesa, debit/credit cards, and payment plans available.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center">
                                <i class="fas fa-file-medical text-indigo-600 text-2xl"></i>
                            </div>
                            <div>
                                <div class="text-xl font-extrabold text-slate-900">Doctor’s Request</div>
                                <p class="text-slate-600 mt-1">
                                    Bring your request form (if available) to speed up your visit and reporting.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal bg-white rounded-3xl p-8 shadow-xl border border-slate-100">
                <h3 class="text-2xl font-extrabold text-slate-900 mb-2">Instant Quote Request</h3>
                <p class="text-slate-600 mb-6">Pick a service and we’ll guide you to booking.</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-slate-700 mb-2 font-bold">Select Service</label>
                        <select id="quoteService" class="w-full p-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100">
                            <option>MRI Scanning</option>
                            <option>MR Spectroscopy</option>
                            <option>CT Scanning</option>
                            <option>Ultrasound Scan</option>
                            <option>ECG Scan</option>
                            <option>General X-Ray</option>
                            <option>Fluoroscopy</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-700 mb-2 font-bold">Insurance Provider</label>
                        <select class="w-full p-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100">
                            <option>NHIF</option>
                            <option>Jubilee Insurance</option>
                            <option>APA Insurance</option>
                            <option>AAR Insurance</option>
                            <option>Other</option>
                            <option>No Insurance</option>
                        </select>
                    </div>

                    <button id="quoteBtn" type="button"
                            class="w-full bg-blue-600 text-white p-4 rounded-xl font-extrabold hover:bg-blue-700 transition">
                        <i class="fas fa-calculator mr-2"></i> Continue
                    </button>

                    <div id="quoteResult" class="hidden mt-4 bg-blue-50 border border-blue-100 rounded-2xl p-5">
                        <div class="text-slate-900 font-extrabold">Next step</div>
                        <p class="text-slate-600 mt-1">
                            You can book the selected service online now.
                        </p>
                        <a id="quoteBookLink" href="{{ route('appointments') }}"
                           class="mt-3 inline-flex items-center justify-center w-full bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition">
                            <i class="fas fa-calendar-check mr-2"></i> Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="medical-gradient text-white py-20">
    <div class="container mx-auto px-6 text-center reveal">
        <h2 class="font-heading text-4xl font-extrabold mb-6">Ready for Your Diagnostic Scan?</h2>
        <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
            Book your appointment online or speak with our imaging specialists for guidance.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('appointments') }}"
               class="bg-white text-blue-900 px-8 py-4 rounded-xl font-extrabold hover:bg-gray-100 transition-all inline-flex items-center justify-center">
                <i class="fas fa-calendar-alt mr-2"></i> Book Appointment Online
            </a>
            <a href="tel:+254207856359"
               class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-extrabold hover:bg-white/10 transition-all inline-flex items-center justify-center">
                <i class="fas fa-phone-alt mr-2"></i> Call: +254 207 856 359
            </a>
        </div>
    </div>
</section>

<!-- DETAILS MODAL -->
<div id="serviceModal" class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-3xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="p-8">
            <div class="flex justify-between items-start gap-6 mb-6">
                <div>
                    <h3 id="modalTitle" class="text-2xl md:text-3xl font-extrabold text-slate-900">Service Details</h3>
                    <p class="text-slate-600 mt-1">Useful info and prep guidance.</p>
                </div>
                <button id="closeModalBtn" type="button" class="text-slate-500 hover:text-slate-700 text-3xl leading-none">&times;</button>
            </div>

            <div id="modalContent" class="prose max-w-none text-slate-700"></div>

            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <a id="modalBookLink" href="{{ route('appointments') }}"
                   class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-extrabold hover:bg-blue-700 transition inline-flex items-center justify-center">
                    <i class="fas fa-calendar-check mr-2"></i> Book This Service
                </a>
                <button id="modalClose2" type="button"
                        class="flex-1 border border-slate-300 text-slate-700 py-3 rounded-xl font-extrabold hover:bg-slate-50 transition">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal animations (works with layouts/web.blade.php)
    const revealEls = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => io.observe(el));

    // Tabs (Body Map / Compare)
    const tabs = document.querySelectorAll('.scan-tab');
    const panels = {
        bodymap: document.getElementById('tab-bodymap'),
        compare: document.getElementById('tab-compare')
    };

    tabs.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.tab;

            tabs.forEach(b => {
                b.classList.remove('bg-white/15');
                b.classList.add('bg-transparent');
            });
            btn.classList.add('bg-white/15');
            btn.classList.remove('bg-transparent');

            Object.keys(panels).forEach(k => panels[k].classList.add('hidden'));
            panels[target].classList.remove('hidden');

            // smooth scroll to the panel on mobile
            panels[target].scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Body map recommendations (buttons)
    const bodyPartServices = {
        head: [
            { key: 'mri', name: 'MRI Scanning', desc: 'Detailed brain imaging for neurological conditions', icon: 'fas fa-mri' },
            { key: 'ct', name: 'CT Scanning', desc: 'Fast scan for trauma or stroke assessment', icon: 'fas fa-ct-scan' },
            { key: 'mrs', name: 'MR Spectroscopy', desc: 'Biochemical analysis of brain tissue', icon: 'fas fa-brain' },
        ],
        chest: [
            { key: 'ct', name: 'CT Scanning', desc: 'Detailed lung and chest imaging', icon: 'fas fa-ct-scan' },
            { key: 'ecg', name: 'ECG Scan', desc: 'Heart rhythm and electrical activity', icon: 'fas fa-heartbeat' },
            { key: 'ultrasound', name: 'Ultrasound Scan', desc: 'Heart structure assessment (Echo)', icon: 'fas fa-ultrasound' },
        ],
        abdomen: [
            { key: 'ultrasound', name: 'Ultrasound Scan', desc: 'Liver, kidney, gallbladder assessment', icon: 'fas fa-ultrasound' },
            { key: 'ct', name: 'CT Scanning', desc: 'Comprehensive abdominal imaging', icon: 'fas fa-ct-scan' },
            { key: 'mri', name: 'MRI Scanning', desc: 'Detailed soft tissue abdominal imaging', icon: 'fas fa-mri' },
        ],
        limbs: [
            { key: 'xray', name: 'General X-Ray', desc: 'Bone fractures and joint assessment', icon: 'fas fa-x-ray' },
            { key: 'mri', name: 'MRI Scanning', desc: 'Soft tissue injuries and joint details', icon: 'fas fa-mri' },
            { key: 'ultrasound', name: 'Ultrasound Scan', desc: 'Muscle and tendon assessment', icon: 'fas fa-ultrasound' },
        ],
    };

    const rec = document.getElementById('recommendedScans');
    document.querySelectorAll('.body-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const part = btn.dataset.part;
            const list = bodyPartServices[part] || [];

            const title = part.charAt(0).toUpperCase() + part.slice(1);
            let html = `
                <div class="bg-white rounded-3xl p-7 shadow-xl border border-slate-100">
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-2">Recommended for ${title}</h3>
                    <p class="text-slate-600 mb-6">Tap a service to book or view details.</p>
                    <div class="space-y-4">
            `;

            list.forEach(s => {
                html += `
                    <div class="border border-slate-200 rounded-2xl p-4 hover:shadow-md transition bg-white">
                        <div class="flex items-start gap-3">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                                <i class="${s.icon} text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-extrabold text-slate-900">${s.name}</div>
                                <div class="text-sm text-slate-600">${s.desc}</div>
                            </div>
                        </div>
                        <div class="mt-3 grid grid-cols-2 gap-2">
                            <a class="bg-blue-600 text-white py-2 rounded-xl font-extrabold hover:bg-blue-700 transition text-center"
                               href="{{ route('appointments') }}?service=${encodeURIComponent(s.name)}">
                               Book
                            </a>
                            <button type="button" data-details="${s.key}"
                                class="border border-blue-600 text-blue-700 py-2 rounded-xl font-extrabold hover:bg-blue-50 transition">
                                Details
                            </button>
                        </div>
                    </div>
                `;
            });

            html += `</div></div>`;
            rec.innerHTML = html;

            // Bind details buttons generated dynamically
            rec.querySelectorAll('[data-details]').forEach(b => {
                b.addEventListener('click', () => openDetails(b.dataset.details));
            });
        });
    });

    // Category filtering
    const filterBtns = document.querySelectorAll('.category-filter');
    const cards = document.querySelectorAll('.service-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const cat = btn.dataset.category;
            cards.forEach(card => {
                const cats = (card.dataset.categories || '');
                const show = (cat === 'all') || cats.includes(cat);
                card.classList.toggle('hidden', !show);
            });
        });
    });

    // Details modal
    const modal = document.getElementById('serviceModal');
    const closeBtn = document.getElementById('closeModalBtn');
    const closeBtn2 = document.getElementById('modalClose2');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    const modalBookLink = document.getElementById('modalBookLink');

    const details = {
        mri: {
            title: 'MRI Scanning',
            body: `
                <div class="space-y-4">
                    <p><strong>What it is:</strong> MRI uses magnetic fields and radio waves to create detailed images (no radiation).</p>
                    <p><strong>Best for:</strong> brain, spine, joints, soft tissues, certain abdominal assessments.</p>
                    <p><strong>Preparation:</strong> remove metal objects; tell staff about implants; some abdominal scans may require fasting.</p>
                </div>
            `
        },
        mrs: {
            title: 'MR Spectroscopy',
            body: `
                <div class="space-y-4">
                    <p><strong>What it is:</strong> Specialized MRI technique that measures chemical changes in the brain.</p>
                    <p><strong>Best for:</strong> evaluating tumors, metabolic disorders, and certain neurological conditions.</p>
                    <p><strong>Preparation:</strong> same MRI safety rules (no metal; inform staff about implants).</p>
                </div>
            `
        },
        ct: {
            title: 'CT Scanning',
            body: `
                <div class="space-y-4">
                    <p><strong>What it is:</strong> CT uses X-rays to create cross-sectional images and 3D reconstructions.</p>
                    <p><strong>Best for:</strong> trauma, lungs, abdomen, urgent checks, bone detail.</p>
                    <p><strong>Preparation:</strong> you may need contrast; inform staff about allergies and kidney issues.</p>
                </div>
            `
        },
        ultrasound: {
            title: 'Ultrasound Scan',
            body: `
                <div class="space-y-4">
                    <p><strong>What it is:</strong> Uses sound waves to create live images (no radiation).</p>
                    <p><strong>Best for:</strong> pregnancy, abdomen, soft tissues, some heart checks.</p>
                    <p><strong>Preparation:</strong> some scans require a full bladder; others require fasting (you’ll be advised).</p>
                </div>
            `
        },
        fluoro: {
            title: 'Fluoroscopy',
            body: `
                <div class="space-y-4">
                    <p><strong>What it is:</strong> Real-time X-ray imaging to visualize movement and function.</p>
                    <p><strong>Best for:</strong> swallowing studies, GI studies, catheter guidance and more.</p>
                    <p><strong>Preparation:</strong> depends on the study; you’ll receive specific instructions.</p>
                </div>
            `
        },
        ecg: {
            title: 'ECG Scan',
            body: `
                <div class="space-y-4">
                    <p><strong>What it is:</strong> Records your heart’s electrical activity.</p>
                    <p><strong>Best for:</strong> rhythm checks, chest discomfort triage, monitoring.</p>
                    <p><strong>Preparation:</strong> no special prep; wear a top that allows chest access.</p>
                </div>
            `
        },
        xray: {
            title: 'General X-Ray',
            body: `
                <div class="space-y-4">
                    <p><strong>What it is:</strong> Fast imaging commonly used for bones, joints, and chest checks.</p>
                    <p><strong>Best for:</strong> fractures, chest assessment, joint degeneration.</p>
                    <p><strong>Preparation:</strong> remove jewelry/metal from the area being scanned.</p>
                </div>
            `
        },
    };

    function openDetails(id){
        const d = details[id];
        if (!d) return;
        modalTitle.textContent = d.title;
        modalContent.innerHTML = d.body;
        modalBookLink.href = `{{ route('appointments') }}?service=${encodeURIComponent(d.title)}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    document.querySelectorAll('[data-details]').forEach(btn => {
        btn.addEventListener('click', () => openDetails(btn.dataset.details));
    });

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    closeBtn?.addEventListener('click', closeModal);
    closeBtn2?.addEventListener('click', closeModal);
    modal?.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

    // Quote
    const quoteBtn = document.getElementById('quoteBtn');
    const quoteResult = document.getElementById('quoteResult');
    const quoteBookLink = document.getElementById('quoteBookLink');

    quoteBtn?.addEventListener('click', () => {
        const svc = document.getElementById('quoteService')?.value || '';
        if (quoteBookLink) quoteBookLink.href = `{{ route('appointments') }}?service=${encodeURIComponent(svc)}`;
        quoteResult?.classList.remove('hidden');
        quoteResult?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
});
</script>
@endpush

@push('styles')
<style>
/* Filters */
.category-filter{
    border:1px solid #e2e8f0;
    background:#fff;
    color:#0f172a;
    padding:.55rem 1rem;
    border-radius:9999px;
    font-weight:800;
    transition:all .2s ease;
}
.category-filter:hover{ background:#f8fafc; border-color:#cbd5e1; }
.category-filter.active{
    background:#1d4ed8; border-color:#1d4ed8; color:#fff;
}

/* Service cards */
.service-card{
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:1.5rem;
    padding:1.5rem;
    box-shadow:0 12px 28px rgba(2,6,23,.06);
    transition:transform .2s ease, box-shadow .2s ease;
}
.service-card:hover{
    transform: translateY(-4px);
    box-shadow:0 18px 40px rgba(2,6,23,.10);
}

/* Body map buttons */
.body-btn{
    display:flex;
    align-items:flex-start;
    gap:.75rem;
    padding:1rem;
    border-radius:1rem;
    border:1px solid rgba(15,23,42,.10);
    background: #ffffff;
    transition:all .2s ease;
    box-shadow:0 10px 22px rgba(2,6,23,.05);
}
.body-btn:hover{ transform: translateY(-2px); box-shadow:0 14px 30px rgba(2,6,23,.08); }

.body-btn .icon{
    width:44px;height:44px;border-radius:14px;
    background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
    display:flex;align-items:center;justify-content:center;
    flex-shrink:0;
}
.body-btn .label{ font-weight:900; }

/* Reveal helpers (if layout doesn't already define) */
.reveal{ opacity:0; transform:translateY(18px); transition:all .7s ease; }
.is-visible{ opacity:1; transform:translateY(0); }
</style>
@endpush
