{{-- resources/views/appointments/book.blade.php --}}
@extends('layouts.web')

@section('title', 'Book Appointment | Precise Diagnostics Imaging')

@push('styles')
<style>
    /* ===== Page-specific helpers (kept consistent with web layout palette) ===== */

    /* Hero background that always stays dark enough for white text */
    .pd-hero-booking{
        position: relative;
        overflow: hidden;
        color: #fff;
        background: radial-gradient(1000px 520px at 12% -10%, rgba(14,165,233,.35), transparent 55%),
                    radial-gradient(900px 480px at 90% 0%, rgba(34,197,94,.18), transparent 55%),
                    linear-gradient(135deg, #0b1220 0%, #0b2a4a 35%, #035b9e 100%);
    }
    .pd-hero-booking::after{
        content:"";
        position:absolute;
        inset:0;
        background: linear-gradient(180deg, rgba(2,6,23,.40), rgba(2,6,23,.62));
        pointer-events:none;
    }
    .pd-hero-booking > *{ position:relative; z-index:1; }

    /* Glass card */
    .pd-glass{
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.14);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 30px 80px rgba(2,6,23,.25);
    }

    /* Form card */
    .pd-form-card{
        background: #fff;
        border: 1px solid rgba(15,23,42,.08);
        box-shadow: 0 24px 70px rgba(2,6,23,.10);
        border-radius: 1.5rem;
    }

    /* Inputs */
    .pd-input{
        width:100%;
        padding: 0.95rem 1rem;
        border-radius: 0.95rem;
        border: 1px solid rgba(148,163,184,.55);
        background: #fff;
        outline: none;
        transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease;
    }
    .pd-input:focus{
        border-color: rgba(14,165,233,.85);
        box-shadow: 0 0 0 4px rgba(14,165,233,.14);
        transform: translateY(-1px);
    }
    .pd-label{
        font-weight: 800;
        color: #0f172a;
        font-size: .9rem;
        display:block;
        margin-bottom: .45rem;
    }
    .pd-help{
        font-size: .82rem;
        color: #64748b;
        margin-top: .35rem;
    }

    /* Pills */
    .pd-pill{
        display:inline-flex;
        align-items:center;
        gap:.5rem;
        padding:.55rem .9rem;
        border-radius: 9999px;
        font-weight: 800;
        font-size: .85rem;
        border: 1px solid rgba(255,255,255,.18);
        background: rgba(255,255,255,.08);
    }

    /* Primary button */
    .pd-btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:.6rem;
        width:100%;
        padding: 1rem 1.1rem;
        border-radius: 1rem;
        font-weight: 900;
        color:#fff;
        background: linear-gradient(135deg, #0284c7, #0ea5e9);
        box-shadow: 0 18px 45px rgba(2,132,199,.25);
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        border: none;
    }
    .pd-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 22px 60px rgba(2,132,199,.33);
        filter: brightness(1.02);
    }
    .pd-btn:active{ transform: translateY(0); }

    /* Secondary button */
    .pd-btn-ghost{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:.6rem;
        width:100%;
        padding: 1rem 1.1rem;
        border-radius: 1rem;
        font-weight: 900;
        color:#0f172a;
        background:#fff;
        border: 1px solid rgba(148,163,184,.55);
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .pd-btn-ghost:hover{
        transform: translateY(-1px);
        box-shadow: 0 18px 40px rgba(2,6,23,.08);
        background: #f8fafc;
    }

    /* Contact preference tiles */
    .pd-toggle{
        position: relative;
        border: 1px solid rgba(148,163,184,.55);
        border-radius: 1rem;
        padding: .9rem 1rem;
        display:flex;
        align-items:center;
        justify-content:space-between;
        background:#fff;
        transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease;
        cursor:pointer;
        user-select:none;
    }
    .pd-toggle:hover{
        transform: translateY(-1px);
        box-shadow: 0 18px 40px rgba(2,6,23,.08);
    }
    .pd-toggle.active{
        border-color: rgba(14,165,233,.85);
        box-shadow: 0 0 0 4px rgba(14,165,233,.14);
    }
    .pd-switch{
        width: 46px;
        height: 26px;
        border-radius: 9999px;
        background: rgba(148,163,184,.45);
        position: relative;
        flex-shrink:0;
        transition: background .2s ease;
    }
    .pd-switch::after{
        content:"";
        width: 20px;
        height: 20px;
        border-radius: 9999px;
        background:#fff;
        position:absolute;
        top:3px; left:3px;
        box-shadow: 0 8px 18px rgba(2,6,23,.20);
        transition: left .2s ease;
    }
    .pd-toggle.active .pd-switch{ background: rgba(14,165,233,.85); }
    .pd-toggle.active .pd-switch::after{ left: 23px; }

    /* Error box */
    .pd-error{
        border-radius: 1rem;
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color:#9f1239;
        padding: 1rem 1.1rem;
    }

    /* Tiny “step” dots */
    .pd-steps{
        display:flex;
        align-items:center;
        justify-content:center;
        gap:.55rem;
        margin-top: 1rem;
    }
    .pd-steps span{
        width: 10px;
        height: 10px;
        border-radius: 9999px;
        background: rgba(255,255,255,.25);
    }
    .pd-steps span.active{ background: rgba(34,197,94,.90); }

    @media (prefers-reduced-motion: reduce){
        .pd-btn, .pd-btn-ghost, .pd-input, .pd-toggle{ transition:none; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="pd-hero-booking py-16 md:py-20">
    <div class="pd-container">
        <div class="max-w-4xl mx-auto text-center reveal">
            <div class="inline-flex items-center justify-center gap-3 mb-6">
                <span class="pd-pill">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    Fast booking • Clear prep guidance
                </span>
            </div>

            <h1 class="font-heading text-4xl md:text-6xl font-extrabold leading-tight drop-shadow-sm">
                Book an Appointment
            </h1>
            <p class="text-white/85 text-lg md:text-xl mt-4 max-w-2xl mx-auto">
                Choose a scan, select a date & time, and tell us how you prefer to be contacted.
            </p>

            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl mx-auto">
                <a href="{{ route('services') }}"
                   class="pd-btn-ghost">
                    <i class="fas fa-th-large"></i>
                    View Services
                </a>
                <a href="{{ route('contact') }}"
                   class="pd-btn"
                   style="width:100%;">
                    <i class="fas fa-headset"></i>
                    Need Help?
                </a>
            </div>

            <div class="pd-steps">
                <span class="active"></span><span></span><span></span>
            </div>
        </div>
    </div>
</section>

{{-- FORM --}}
<section class="py-14 md:py-16 bg-slate-50">
    <div class="pd-container">
        <div class="max-w-3xl mx-auto">

            {{-- Errors --}}
            @if ($errors->any())
                <div class="pd-error mb-6 reveal">
                    <div class="font-extrabold mb-2">Please fix the following:</div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="pd-form-card p-6 md:p-10 reveal">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                    <div>
                        <h2 class="font-heading text-2xl md:text-3xl font-extrabold text-slate-900">
                            Appointment Details
                        </h2>
                        <p class="text-slate-600 mt-1">
                            Fill in the details below. We’ll confirm and share preparation instructions.
                        </p>
                    </div>

                    <div class="text-sm text-slate-500 font-semibold">
                        <i class="fas fa-shield-alt text-emerald-600 mr-2"></i>
                        Secure & confidential
                    </div>
                </div>

                <form id="bookingForm" method="POST" action="{{ route('appointments.store') }}" class="space-y-6">
                    @csrf

                    {{-- If you come from Services page with ?service=... --}}
                    @php
                        $prefillService = request('service') ?? old('service');
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="pd-label" for="name">Full Name *</label>
                            <input id="name" type="text" name="name" required
                                   value="{{ old('name') }}"
                                   placeholder="e.g. John Doe"
                                   class="pd-input">
                        </div>

                        <div>
                            <label class="pd-label" for="phone">Phone Number *</label>
                            <input id="phone" type="tel" name="phone" required
                                   value="{{ old('phone') }}"
                                   placeholder="e.g. 07xx xxx xxx"
                                   class="pd-input">
                            <div class="pd-help">We’ll use this to confirm your appointment.</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="pd-label" for="email">Email Address (optional)</label>
                            <input id="email" type="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="e.g. you@example.com"
                                   class="pd-input">
                        </div>

                        <div>
                            <label class="pd-label" for="dob">Date of Birth (optional)</label>
                            <input id="dob" type="date" name="dob"
                                   value="{{ old('dob') }}"
                                   class="pd-input">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="pd-label" for="service">Service / Scan *</label>
                            <input id="service" type="text" name="service" required
                                   value="{{ $prefillService }}"
                                   placeholder="e.g. MRI Scanning"
                                   class="pd-input">
                            <div class="pd-help">Tip: You can pick from our Services page and it will auto-fill here.</div>
                        </div>

                        <div>
                            <label class="pd-label" for="insurance">Insurance Provider (optional)</label>
                            <select id="insurance" name="insurance" class="pd-input">
                                <option value="" selected>— Select (optional) —</option>
                                <option value="NHIF" @selected(old('insurance') === 'NHIF')>NHIF</option>
                                <option value="Jubilee Insurance" @selected(old('insurance') === 'Jubilee Insurance')>Jubilee Insurance</option>
                                <option value="APA Insurance" @selected(old('insurance') === 'APA Insurance')>APA Insurance</option>
                                <option value="AAR Insurance" @selected(old('insurance') === 'AAR Insurance')>AAR Insurance</option>
                                <option value="Other" @selected(old('insurance') === 'Other')>Other</option>
                                <option value="No Insurance" @selected(old('insurance') === 'No Insurance')>No Insurance</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="pd-label" for="appointment_date">Preferred Date *</label>
                            <input id="appointment_date" type="date" name="appointment_date" required
                                   value="{{ old('appointment_date') }}"
                                   class="pd-input">
                        </div>

                        <div>
                            <label class="pd-label" for="appointment_time">Preferred Time *</label>
                            <input id="appointment_time" type="time" name="appointment_time" required
                                   value="{{ old('appointment_time') }}"
                                   class="pd-input">
                        </div>
                    </div>

                    <div>
                        <label class="pd-label" for="reason">Reason / Notes *</label>
                        <textarea id="reason" name="reason" rows="4" required
                                  placeholder="Briefly describe what you need help with (e.g. knee pain, doctor requested CT chest)..."
                                  class="pd-input">{{ old('reason') }}</textarea>
                    </div>

                    {{-- Contact preferences (consistent with your controller fields) --}}
                    <div class="pt-2">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <div>
                                <div class="font-extrabold text-slate-900">Contact Preferences</div>
                                <div class="text-sm text-slate-600">Choose how you’d like us to reach you.</div>
                            </div>
                            <span class="text-xs font-extrabold text-slate-500">Optional</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="pd-toggle" data-toggle="contact_whatsapp" role="button" tabindex="0" aria-pressed="false">
                                <div class="flex items-center gap-3">
                                    <i class="fab fa-whatsapp text-emerald-600 text-xl"></i>
                                    <div>
                                        <div class="font-extrabold text-slate-900">WhatsApp</div>
                                        <div class="text-xs text-slate-500">Fast chat updates</div>
                                    </div>
                                </div>
                                <div class="pd-switch"></div>
                                <input type="hidden" name="contact_whatsapp" id="contact_whatsapp" value="{{ old('contact_whatsapp', 'false') }}">
                            </div>

                            <div class="pd-toggle" data-toggle="contact_sms" role="button" tabindex="0" aria-pressed="false">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-sms text-sky-600 text-xl"></i>
                                    <div>
                                        <div class="font-extrabold text-slate-900">SMS</div>
                                        <div class="text-xs text-slate-500">Text reminders</div>
                                    </div>
                                </div>
                                <div class="pd-switch"></div>
                                <input type="hidden" name="contact_sms" id="contact_sms" value="{{ old('contact_sms', 'false') }}">
                            </div>

                            <div class="pd-toggle" data-toggle="contact_email" role="button" tabindex="0" aria-pressed="false">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-envelope text-amber-600 text-xl"></i>
                                    <div>
                                        <div class="font-extrabold text-slate-900">Email</div>
                                        <div class="text-xs text-slate-500">Detailed info</div>
                                    </div>
                                </div>
                                <div class="pd-switch"></div>
                                <input type="hidden" name="contact_email" id="contact_email" value="{{ old('contact_email', 'false') }}">
                            </div>
                        </div>

                        <div class="pd-help mt-3">
                            If you don’t select a preference, we’ll contact you via phone by default.
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="pd-btn">
                            <i class="fas fa-calendar-check"></i>
                            Confirm Appointment
                        </button>

                        <div class="mt-4 text-center text-sm text-slate-500 font-semibold">
                            By submitting, you agree to be contacted for appointment confirmation.
                        </div>
                    </div>
                </form>
            </div>

            {{-- Small reassurance row --}}
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 reveal">
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-sky-50 flex items-center justify-center">
                            <i class="fas fa-stopwatch text-sky-600"></i>
                        </div>
                        <div>
                            <div class="font-extrabold text-slate-900">Quick Process</div>
                            <div class="text-sm text-slate-600">Takes under 2 minutes</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <i class="fas fa-user-md text-emerald-600"></i>
                        </div>
                        <div>
                            <div class="font-extrabold text-slate-900">Expert Team</div>
                            <div class="text-sm text-slate-600">Guided recommendations</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center">
                            <i class="fas fa-file-medical text-indigo-600"></i>
                        </div>
                        <div>
                            <div class="font-extrabold text-slate-900">Prep Guidance</div>
                            <div class="text-sm text-slate-600">Sent after confirmation</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Make date min today
    const dateEl = document.getElementById('appointment_date');
    if (dateEl) {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        dateEl.min = `${yyyy}-${mm}-${dd}`;
    }

    // Contact preference toggles -> hidden inputs send "true"/"false" strings (matches your controller filter_var)
    const toggles = document.querySelectorAll('.pd-toggle');

    function setToggleState(tile, isOn){
        const inputId = tile.dataset.toggle;
        const hidden = document.getElementById(inputId);
        if (!hidden) return;

        tile.classList.toggle('active', isOn);
        tile.setAttribute('aria-pressed', isOn ? 'true' : 'false');
        hidden.value = isOn ? 'true' : 'false';
    }

    toggles.forEach(tile => {
        const inputId = tile.dataset.toggle;
        const hidden = document.getElementById(inputId);

        // init from old() values
        const initial = (hidden && String(hidden.value).toLowerCase() === 'true');
        setToggleState(tile, initial);

        const toggle = () => {
            const current = tile.classList.contains('active');
            setToggleState(tile, !current);
        };

        tile.addEventListener('click', toggle);
        tile.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggle();
            }
        });
    });

    // Gentle phone formatting (Kenya) without being aggressive
    const phone = document.getElementById('phone');
    phone?.addEventListener('blur', () => {
        const raw = (phone.value || '').trim();
        if (!raw) return;

        // keep digits plus leading +
        let digits = raw.replace(/[^\d+]/g, '');
        // If starts with 07/01 etc -> convert to +2547...
        if (digits.startsWith('0') && digits.length >= 10) {
            digits = '+254' + digits.slice(1);
        }
        phone.value = digits;
    });
});
</script>
@endpush
