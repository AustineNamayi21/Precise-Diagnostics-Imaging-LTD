@extends('layouts.web')

@section('title', 'Contact Us | Precise Diagnostics Imaging')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden medical-gradient py-24 text-white">
    <!-- BLUE CONTRAST OVERLAY -->
    <div class="absolute inset-0 bg-gradient-to-b from-sky-900/80 via-sky-800/85 to-sky-900/90"></div>

    <!-- Decorative blobs (kept but subdued) -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-sky-400/15 rounded-full blur-3xl"></div>
        <div class="absolute top-24 right-10 w-56 h-56 bg-cyan-400/15 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-1/3 w-44 h-44 bg-teal-400/15 rounded-full blur-2xl"></div>
    </div>

    <!-- CONTENT -->
    <div class="relative z-10 container mx-auto px-6 text-center">
        <h1 class="font-heading text-5xl md:text-6xl font-extrabold mb-6 tracking-tight reveal">
            Connect With <span class="text-cyan-300">Precision</span>
        </h1>

        <p class="text-xl md:text-2xl text-white/95 max-w-3xl mx-auto reveal">
            Reach our medical imaging specialists quickly, clearly, and securely.
        </p>
    </div>
</section>

<!-- CONTACT METHODS -->
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- WhatsApp -->
            <div class="bg-white rounded-2xl p-8 shadow-xl border-t-4 border-green-500 reveal">
                <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-green-500 text-white flex items-center justify-center text-2xl">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3 class="text-2xl font-bold text-center mb-3 text-slate-900">
                    WhatsApp Chat
                </h3>
                <p class="text-slate-600 text-center mb-6 leading-relaxed">
                    Fastest way to get assistance from our medical team.
                </p>
                <a href="https://wa.me/254791903552"
                   target="_blank"
                   class="block text-center bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-bold transition">
                    Start Chat
                </a>
            </div>

            <!-- Phone -->
            <div class="bg-white rounded-2xl p-8 shadow-xl border-t-4 border-blue-500 reveal">
                <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-blue-500 text-white flex items-center justify-center text-2xl">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3 class="text-2xl font-bold text-center mb-3 text-slate-900">
                    Call Us
                </h3>
                <p class="text-slate-600 text-center mb-6 leading-relaxed">
                    Speak directly with our imaging specialists.
                </p>
                <a href="tel:+254207856359"
                   class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-bold transition">
                    +254 207 856 359
                </a>
            </div>

            <!-- Email -->
            <div class="bg-white rounded-2xl p-8 shadow-xl border-t-4 border-amber-500 reveal">
                <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="text-2xl font-bold text-center mb-3 text-slate-900">
                    Email Us
                </h3>
                <p class="text-slate-600 text-center mb-6 leading-relaxed">
                    Send detailed inquiries or medical reports.
                </p>
                <a href="mailto:info@precisediagnostic.co.ke"
                   class="block text-center bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-xl font-bold transition">
                    Send Email
                </a>
            </div>

        </div>
    </div>
</section>

<!-- CONTACT FORM -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="bg-slate-50 rounded-2xl shadow-xl p-10 reveal">
            <h2 class="text-3xl font-bold mb-8 text-center text-slate-900">
                Send Us a Message
            </h2>

            <form class="space-y-5">
                <input type="text" placeholder="Full Name"
                       class="w-full p-4 border border-slate-300 rounded-xl focus:ring-4 focus:ring-sky-200 focus:outline-none">

                <input type="email" placeholder="Email Address"
                       class="w-full p-4 border border-slate-300 rounded-xl focus:ring-4 focus:ring-sky-200 focus:outline-none">

                <textarea rows="4" placeholder="Your Message"
                          class="w-full p-4 border border-slate-300 rounded-xl focus:ring-4 focus:ring-sky-200 focus:outline-none"></textarea>

                <button type="submit"
                        class="w-full bg-sky-600 hover:bg-sky-700 text-white py-4 rounded-xl font-bold transition">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
