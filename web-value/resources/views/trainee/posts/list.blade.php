@extends('trainee.layouts.app')

@section('title', 'Daftar Pendaftaran Pelatihan')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Evaluasi Pelatihan</h1>

        @if (session('success'))
            <div id="success-alert" class="fixed inset-0 flex items-center justify-center z-50">
                <div
                    class="bg-green-100 text-green-800 p-4 rounded-lg shadow-lg transition-transform transform duration-300 ease-in-out max-w-md mx-auto w-full relative">
                    <!-- Ikon -->
                    <svg class="w-6 h-6 mr-3 inline-flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <!-- Pesan -->
                    <span class="flex-1">{{ session('success') }}</span>
                    <!-- Tombol Tutup -->
                    <button onclick="document.getElementById('success-alert').style.display='none'"
                        class="absolute top-2 right-2 text-green-600 hover:text-green-800 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Modal Error -->
        @if (session('error'))
            <div id="error-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 transform transition-all scale-100">
                    <!-- Header Modal -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-red-600">Noted</h2>
                        <!-- Tombol Close -->
                        <button onclick="document.getElementById('error-modal').style.display='none'"
                            class="text-gray-400 hover:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Body Modal -->
                    <div class="mb-6">
                        <p class="text-gray-700">{{ session('error') }}</p>
                    </div>

                    <!-- Footer Modal dengan Tombol Close -->
                    <div class="text-right">
                        <button onclick="document.getElementById('error-modal').style.display='none'"
                            class="bg-red-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 transition ease-in-out duration-150">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if ($trainings->isEmpty())
            <p class="text-gray-500">Anda belum terdaftar untuk pelatihan apapun.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="text-center">
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Judul Pelatihan</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($trainings as $training)
                        @php
                            $currentDate = Carbon\Carbon::now()->format('Y-m-d');
                            $scheduleDate = Carbon\Carbon::parse(
                                $training->post->scheduleTraining->schedule_date,
                            )->format('Y-m-d');
                            $hasEvaluated = $evaluations->has($training->id);
                        @endphp
                        <tr>
                            <td class="py-2 px-4 border-b">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                {{ $training->post->dataPrice->training_title }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                {{-- Evaluasi --}}
                                @if ($currentDate >= $scheduleDate)
                                    @if ($hasEvaluated)
                                        <a href="{{ route('evaluation.edit', $evaluations[$training->id]) }}"
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Evaluasi</a>
                                    {{-- @else
                                        <a href="{{ route('evaluation.form', $training->id) }}"
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit
                                            Evaluasi Pelatihan</a> --}}
                                    @endif
                                @else
                                Evaluasi akan tersedia di {{ $scheduleDate }} |
                                @endif
                                {{-- Feedback --}}
                                @if ($currentDate >= $scheduleDate)
                                    <a href="{{ route('feedback.form', $training->id) }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        Feedback</a>
                                @else
                                Feedback akan tersedia di {{ $scheduleDate }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
