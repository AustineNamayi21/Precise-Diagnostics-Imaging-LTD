@extends('layouts.web')

@section('title', 'Book Appointment | Precise Diagnostics Imaging')

@section('content')

<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-6 max-w-3xl">

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h1 class="text-3xl font-heading font-bold text-center mb-6">
                Book an Appointment
            </h1>

            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 text-red-700">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('appointments.store') }}" class="space-y-5">
                @csrf

                <input type="text"
                       name="patient_name"
                       placeholder="Full Name"
                       value="{{ old('patient_name') }}"
                       required
                       class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">

                <input type="email"
                       name="patient_email"
                       placeholder="Email Address (optional)"
                       value="{{ old('patient_email') }}"
                       class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">

                <input type="text"
                       name="patient_phone"
                       placeholder="Phone Number"
                       value="{{ old('patient_phone') }}"
                       required
                       class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">

                <input type="date"
                       name="patient_dob"
                       value="{{ old('patient_dob') }}"
                       class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">

                <input type="text"
                       name="service_name"
                       placeholder="Service Required (e.g. MRI Scan)"
                       value="{{ old('service_name') }}"
                       required
                       class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="date"
                           name="appointment_date"
                           value="{{ old('appointment_date') }}"
                           required
                           class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">

                    <input type="time"
                           name="appointment_time"
                           value="{{ old('appointment_time') }}"
                           required
                           class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">
                </div>

                <textarea name="notes"
                          rows="4"
                          placeholder="Additional notes (optional)"
                          class="w-full p-4 border rounded-xl focus:ring-4 focus:ring-blue-100">{{ old('notes') }}</textarea>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold transition">
                    Confirm Appointment
                </button>
            </form>
        </div>

    </div>
</section>

@endsection
