@extends('trainer.layouts.app')

@section('title', 'Trainer Dashboard')

@section('content')
    <div class="p-4 md:p-6 bg-white rounded-lg shadow-md">
        <!-- Greeting Section -->
        <div class="bg-green-600 text-white p-4 md:p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::guard('trainer')->user()->name }}</h2>
            <p class="text-base md:text-lg">Ini adalah dashboard Anda di mana Anda dapat menemukan semua informasi penting dan
                pembaruan yang terkait dengan sesi latihan dan aktivitas Anda.
            </p>
        </div>

        <!-- Additional Info Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- Upcoming Sessions -->
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md border w-full border-gray-200">
                <h3 class="text-xl md:text-2xl font-semibold mb-4">Upcoming Sessions</h3>
                <!-- Jika ada session yang tersedia -->
                @if ($upcomingSessions->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left table-auto" id="upcoming-sessions-table">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-2 py-2 md:px-4 md:py-2">No</th>
                                    <th class="px-2 py-2 md:px-4 md:py-2">Training Title</th>
                                    <th class="px-2 py-2 md:px-4 md:py-2">Material</th>
                                    <th class="px-2 py-2 md:px-4 md:py-2">Schedule Date</th>
                                    <th class="px-2 py-2 md:px-4 md:py-2">Hotel</th>
                                </tr>
                            </thead>
                            <tbody id="upcoming-sessions-body">
                                @foreach ($upcomingSessions as $session)
                                    <tr class="hover:bg-gray-50 transition ease-in-out duration-200">
                                        <td class="border px-2 py-2 md:px-4 md:py-2">{{ $loop->iteration }}</td>
                                        <td class="border px-2 py-2 md:px-4 md:py-2">
                                            {{ $session->dataPrice->training_title }}</td>
                                        <td class="border px-2 py-2 md:px-4 md:py-2">
                                            {{ $session->trainingMaterial->material_file }}</td>
                                        <td class="border px-2 py-2 md:px-4 md:py-2">
                                            {{ \Carbon\Carbon::parse($session->schedule_date)->format('d M Y') }}</td>
                                        <td class="border px-2 py-2 md:px-4 md:py-2">{{ $session->hotel->name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Script untuk membalik urutan -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var tableBody = document.getElementById('upcoming-sessions-body');
                            var rows = Array.from(tableBody.querySelectorAll('tr')).reverse();
                            tableBody.innerHTML = '';
                            rows.forEach(function(row) {
                                tableBody.appendChild(row);
                            });
                        });
                    </script>
                @else
                    <p class="text-gray-700">No sessions found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
