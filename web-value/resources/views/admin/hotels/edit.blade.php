@extends('admin.layouts.app-admin-website')

@section('title', 'Edit Hotel')

@section('header')
    Edit Data Hotel
@endsection

@section('content')
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <form action="{{ route('hotels.update', $hotel->id) }}" method="POST"
            class="space-y-6 bg-white p-6 border border-gray-200 rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $hotel->name) }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm transition-transform duration-200 ease-in-out hover:border-blue-400">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $hotel->phone) }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm transition-transform duration-200 ease-in-out hover:border-blue-400">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" id="location" value="{{ old('location', $hotel->location) }}"
                    required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm transition-transform duration-200 ease-in-out hover:border-blue-400">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7v14" />
                </svg>
                Simpan
            </button>
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
                <p class="mt-2 text-gray-700">Apakah Anda yakin ingin membatalkan pengeditan? Semua perubahan yang belum
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
            window.location.href = "{{ route('hotels.index') }}"; // Ganti dengan route yang sesuai
        });

        // Close modal if user clicks outside the modal box
        window.addEventListener('click', function(event) {
            if (event.target.id === 'cancelModal') {
                closeModal('cancelModal');
            }
        });
    </script>
@endsection
