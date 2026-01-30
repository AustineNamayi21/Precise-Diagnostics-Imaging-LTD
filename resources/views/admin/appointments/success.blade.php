@extends('layouts.web')

@section('title', 'Appointment Booked Successfully')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <div class="bg-white rounded-2xl shadow-xl p-10">
            <div class="text-green-500 text-6xl mb-6">
                <i class="fas fa-check-circle"></i>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Appointment Booked Successfully 🎉
            </h1>

            <p class="text-gray-600 mb-8">
                Thank you for choosing Precise Diagnostics Imaging Centre.
                Your appointment has been received and is currently pending confirmation.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                    Back to Home
                </a>

                @auth
                <a href="{{ route('appointments.my') }}"
                   class="px-6 py-3 rounded-xl bg-gray-100 text-gray-800 font-semibold hover:bg-gray-200 transition">
                    View My Appointments
                </a>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection
