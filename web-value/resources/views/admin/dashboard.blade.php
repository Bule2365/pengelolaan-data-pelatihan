@extends('admin.layouts.app-admin-website')

@section('title', 'Dashboard')

@section('header', 'Dashboard Admin Website')

@section('content')
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Trainees Card -->
            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Peserta</h2>
                <div class="relative w-48 h-48">
                    <canvas id="traineeChart"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <p class="text-4xl font-bold text-blue-600">{{ $totalTrainees }}</p>
                    </div>
                    @if ($totalTrainees > 100)
                        <div class="absolute bottom-0 right-0 text-red-600 text-xl font-bold">
                            {{ intval($totalTrainees / 100) }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Total Trainers Card -->
            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Pelatih</h2>
                <div class="relative w-48 h-48">
                    <canvas id="trainerChart"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <p class="text-4xl font-bold text-green-600">{{ $totalTrainers }}</p>
                    </div>
                    @if ($totalTrainers > 100)
                        <div class="absolute bottom-0 right-0 text-red-600 text-xl font-bold">
                            {{ intval($totalTrainers / 100) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctxTrainee = document.getElementById('traineeChart').getContext('2d');
            var traineeChart = new Chart(ctxTrainee, {
                type: 'doughnut',
                data: {
                    labels: ['Trainees'],
                    datasets: [{
                        label: 'Number of Trainees',
                        data: [{{ $totalTrainees }}, 100 - {{ $totalTrainees }}],
                        backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(54, 162, 235, 0.1)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 0.1)'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    }
                }
            });

            var ctxTrainer = document.getElementById('trainerChart').getContext('2d');
            var trainerChart = new Chart(ctxTrainer, {
                type: 'doughnut',
                data: {
                    labels: ['Trainers'],
                    datasets: [{
                        label: 'Number of Trainers',
                        data: [{{ $totalTrainers }}, 100 - {{ $totalTrainers }}],
                        backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(75, 192, 192, 0.1)'],
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(75, 192, 192, 0.1)'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    }
                }
            });
        });
    </script>
@endpush
