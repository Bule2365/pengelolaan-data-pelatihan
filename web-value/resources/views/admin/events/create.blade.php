@extends('admin.layouts.app-admin-website')

@section('title', 'Create Event')

@section('header')
    Buat Event Baru
@endsection

@section('content')
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Event Title -->
            <div>
                <label for="event_title" class="block text-gray-700 text-sm font-medium mb-2">Judul Event</label>
                <input type="text" name="event_title" id="event_title"
                    class="form-input w-full border-gray-300 rounded-md shadow-sm" value="{{ old('event_title') }}"
                    required>
                @error('event_title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Event Description -->
            <div>
                <label for="event_description" class="block text-gray-700 text-sm font-medium mb-2">Deskripsi Event</label>
                <textarea name="event_description" id="event_description" rows="4"
                    class="form-textarea w-full border-gray-300 rounded-md shadow-sm">{{ old('event_description') }}</textarea>
                @error('event_description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Event Time -->
            <div>
                <label for="event_time" class="block text-gray-700 text-sm font-medium mb-2">Waktu Acara</label>
                <input type="datetime-local" name="event_time" id="event_time"
                    class="form-input w-full border-gray-300 rounded-md shadow-sm" value="{{ old('event_time') }}" required>
                @error('event_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Event Price -->
            <div>
                <label for="price" class="block text-gray-700 text-sm font-medium mb-2">Harga</label>
                <input type="number" name="price" id="price"
                    class="form-input w-full border-gray-300 rounded-md shadow-sm" value="{{ old('price') }}" required>
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Event Type -->
            <div>
                <label for="event_type" class="block text-gray-700 text-sm font-medium mb-2">Jenis Event</label>
                <select name="event_type" id="event_type" class="form-select w-full border-gray-300 rounded-md shadow-sm"
                    required onchange="toggleHotelField()">
                    <option value="online" {{ old('event_type') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ old('event_type') == 'offline' ? 'selected' : '' }}>Offline</option>
                </select>
                @error('event_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Hotel (Conditional) -->
            <div>
                <label for="hotel_id" class="block text-gray-700 text-sm font-medium mb-2">Hotel</label>
                <select name="hotel_id" id="hotel_id" class="form-select w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Choose a Hotel --</option>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                            {{ $hotel->name }}
                        </option>
                    @endforeach
                </select>
                @error('hotel_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Trainer -->
            <div>
                <label for="trainer_id" class="block text-gray-700 text-sm font-medium mb-2">Pelatih</label>
                <select name="trainer_id" id="trainer_id" class="form-select w-full border-gray-300 rounded-md shadow-sm"
                    required>
                    @foreach ($trainers as $trainer)
                        <option value="{{ $trainer->id }}" {{ old('trainer_id') == $trainer->id ? 'selected' : '' }}>
                            {{ $trainer->name }}
                        </option>
                    @endforeach
                </select>
                @error('trainer_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-gray-700 text-sm font-medium mb-2">Gambar</label>
                <input type="file" name="image" id="image"
                    class="form-input w-full border-gray-300 rounded-md shadow-sm">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <button type="submit"
                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7v14" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>

        <!-- Tombol untuk Kembali -->
        <div class="mt-3">
            <button id="cancelEditBtn"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar
            </button>
        </div>

        <!-- Modal Konfirmasi Pembatalan -->
        <div id="cancelModal"
            class="fixed inset-0 items-center justify-center bg-gray-500 bg-opacity-50 hidden z-50 transition-opacity duration-500 opacity-0">
            <div
                class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto transition-transform duration-500 transform scale-95">
                <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Pembatalan</h2>
                <p class="mt-2 text-gray-700">Apakah Anda yakin ingin membatalkan pembuatan? Semua perubahan yang belum
                    disimpan akan hilang.</p>
                <div class="mt-4 flex space-x-4">
                    <button id="confirmCancelBtn"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150">
                        Ya, Batalkan
                    </button>
                    <button id="closeModalBtn" onclick="closeModal('cancelModal')"
                        class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150">
                        Tidak, Tetap di Sini
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to open the modal
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden'); // Tampilkan modal
            setTimeout(() => {
                modal.classList.remove('opacity-0'); // Fade-in
                modal.classList.add('opacity-100', 'flex');
                modal.querySelector('div').classList.add('scale-100'); // Grow-in animation
            }, 10); // Timeout agar transisi terlihat
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('opacity-100'); // Fade-out
            modal.classList.add('opacity-0');
            modal.querySelector('div').classList.remove('scale-100'); // Shrink-out animation
            setTimeout(() => {
                modal.classList.remove('flex'); // Sembunyikan modal setelah transisi selesai
                modal.classList.add('hidden');
            }, 500); // Timeout harus sesuai dengan durasi transisi di CSS
        }

        // Handle opening the modal on button click
        document.getElementById('cancelEditBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah navigasi langsung
            openModal('cancelModal');
        });

        // Handle confirm cancel (navigate to route)
        document.getElementById('confirmCancelBtn').addEventListener('click', function() {
            window.location.href = "{{ route('events.index') }}"; // Ganti dengan route yang sesuai
        });

        // Close modal if user clicks outside the modal box
        window.addEventListener('click', function(event) {
            if (event.target.id === 'cancelModal') {
                closeModal('cancelModal');
            }
        });

        // Function Hotel
        function toggleHotelField() {
            const eventType = document.getElementById('event_type').value;
            const hotelField = document.getElementById('hotel_id');

            if (eventType === 'offline') {
                hotelField.removeAttribute('disabled');
                hotelField.setAttribute('required', 'required');
            } else {
                hotelField.setAttribute('disabled', 'disabled');
                hotelField.removeAttribute('required');
                hotelField.value = ''; // Reset pilihan hotel saat event online
            }
        }

        // Set initial state on page load
        document.addEventListener('DOMContentLoaded', toggleHotelField);
    </script>
@endsection
