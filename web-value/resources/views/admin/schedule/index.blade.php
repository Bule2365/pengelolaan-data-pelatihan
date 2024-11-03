@extends('admin.layouts.app-admin-website')

@section('title', 'Schedule List')

@section('header')
    Jadwal Pelatihan
@endsection

@section('content')
    <div class="mb-6 mt-4 flex justify-between items-center flex-wrap">
        <a href="{{ route('schedule.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Jadwal Pelatihan
        </a>
    </div>

    <form method="GET" action="{{ route('schedule.index') }}" class="flex flex-col space-y-4 mb-4">
        <!-- Dropdown untuk memilih kriteria pencarian -->
        <div>
            <label for="search_by" class="block text-sm font-medium text-gray-700">Cari berdasarkan</label>
            <select id="search_by" name="search_by" onchange="toggleSearchInputs()"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="training_title" {{ request('search_by') == 'training_title' ? 'selected' : '' }}>Judul
                    Training</option>
                <option value="trainer_name" {{ request('search_by') == 'trainer_name' ? 'selected' : '' }}>Nama Trainer
                </option>
                <option value="schedule_date" {{ request('search_by') == 'schedule_date' ? 'selected' : '' }}>Tanggal
                    Schedule</option>
            </select>
        </div>

        <!-- Input untuk pencarian berdasarkan kata kunci (training_title atau trainer_name) -->
        <div id="text_search" class="block">
            <label for="search" class="block text-sm font-medium text-gray-700">Kata Kunci</label>
            <input type="text" name="search" id="search" placeholder="Masukkan kata kunci"
                value="{{ request('search') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Input untuk pencarian berdasarkan tanggal (schedule_date) -->
        <div id="date_search" class="hidden">
            <label class="block text-sm font-medium text-gray-700">Range Tanggal</label>
            <div class="mt-1 flex space-x-4">
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                    class="block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                    class="block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <!-- Tombol Submit -->
        <button type="submit"
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Cari
        </button>
    </form>

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto">
        <div class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <table class="min-w-full bg-white border border-gray-300 rounded-md">
                <thead class="bg-blue-50 text-blue-800">
                    <tr>
                        <th class="py-2 px-2 border-b text-left">No</th>
                        <th class="py-2 px-2 border-b text-left">Pelatih</th>
                        <th class="py-2 px-2 border-b text-left">Harga</th>
                        <th class="py-2 px-2 border-b text-left">Judul Materi</th>
                        <th class="py-2 px-2 border-b text-left">Jadwal Pelatihan</th>
                        <th class="py-2 px-2 border-b text-left">Lokasi</th>
                        <th class="py-2 px-2 border-b text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($schedules as $schedule)
                        <tr class="hover:bg-gray-50 transition ease-in-out duration-200">
                            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $schedule->trainer->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $schedule->dataPrice->training_title }} -
                                {{ $schedule->dataPrice->price }}</td>
                            <td class="py-2 px-4 border-b">{{ $schedule->trainingMaterial->material_file }}</td>
                            <td class="py-2 px-4 border-b">{{ $schedule->schedule_date }}</td>
                            <td class="py-2 px-4 border-b">{{ $schedule->hotel->name }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex items-center space-x-2">
                                    <button onclick="openModal('delete-confirmation-modal-{{ $schedule->id }}')"
                                        class="text-red-600 hover:text-red-800 transition-transform transform hover:scale-110">
                                        <!-- Trash Icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L6 6M18 18L18 6M6 6L18 6M6 6L6 4a1 1 0 011-1h10a1 1 0 011 1v2M10 11v6M14 11v6">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Delete Confirmation Modal -->
                        <div id="delete-confirmation-modal-{{ $schedule->id }}"
                            class="fixed inset-0 items-center justify-center bg-gray-500 bg-opacity-50 hidden z-50 transition-opacity duration-500 opacity-0">
                            <div
                                class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto transition-transform duration-500 transform scale-95">
                                <h2 class="text-lg font-semibold text-gray-900">Confirm Delete</h2>
                                <p class="mt-2 text-gray-700">Are you sure you want to delete this schedule?</p>
                                <div class="mt-4 flex space-x-4">
                                    <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150">
                                            Delete
                                        </button>
                                    </form>
                                    <button onclick="closeModal('delete-confirmation-modal-{{ $schedule->id }}')"
                                        class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md shadow hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Delete Modal
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden'); // Show modal
            setTimeout(() => {
                modal.classList.remove('opacity-0'); // Fade-in effect
                modal.classList.add('opacity-100', 'flex');
                modal.querySelector('div').classList.add('scale-100'); // Grow-in animation
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('opacity-100'); // Fade-out effect
            modal.classList.add('opacity-0');
            modal.querySelector('div').classList.remove('scale-100'); // Shrink-out animation
            setTimeout(() => {
                modal.classList.remove('flex'); // Hide modal after transition
                modal.classList.add('hidden');
            }, 500); // Timing should match CSS transition duration
        }

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-gray-500')) {
                const modals = document.querySelectorAll('[id^="delete-confirmation-modal-"]');
                modals.forEach(modal => modal.classList.add('hidden'));
            }
        });

        // Filter search
        function toggleSearchInputs() {
            var searchBy = document.getElementById('search_by').value;
            var textSearch = document.getElementById('text_search');
            var dateSearch = document.getElementById('date_search');

            if (searchBy === 'schedule_date') {
                textSearch.classList.add('hidden');
                dateSearch.classList.remove('hidden');
            } else {
                textSearch.classList.remove('hidden');
                dateSearch.classList.add('hidden');
            }
        }

        // Jalankan fungsi ini saat halaman dimuat untuk menyesuaikan tampilan input sesuai pilihan yang sudah ada
        document.addEventListener('DOMContentLoaded', function() {
            toggleSearchInputs();
        });
    </script>
@endsection
