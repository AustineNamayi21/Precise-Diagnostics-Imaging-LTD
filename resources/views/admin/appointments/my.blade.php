@extends('layouts.web')

@section('title', 'My Appointments')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            My Appointments
        </h1>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <table class="min-w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Appointment #</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Service</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Date</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Time</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($appointments as $appointment)
                        <tr>
                            <td class="px-6 py-4">{{ $appointment->appointment_number }}</td>
                            <td class="px-6 py-4">{{ $appointment->service_name }}</td>
                            <td class="px-6 py-4">{{ $appointment->appointment_date }}</td>
                            <td class="px-6 py-4">{{ $appointment->appointment_time }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($appointment->status === 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($appointment->status === 'completed') bg-green-100 text-green-800
                                    @else bg-gray-200 text-gray-700 @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                You have no appointments yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
