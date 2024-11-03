@extends('admin.layouts.app-admin-website')

@section('title', 'Tambah Metode Pembayaran')

@section('header', 'Tambah Metode Pembayaran')

@section('content')
    @if ($errors->any())
        <div class="mb-4">
            @foreach ($errors->all() as $error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.payment.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="method_name" class="block text-gray-700">Nama Metode:</label>
            <input type="text" name="method_name" id="method_name" class="w-full border-gray-300 rounded mt-1" required>
        </div>

        <div class="mb-4">
            <label for="no" class="block text-gray-700">No:</label>
            <input type="number" step="0.01" name="no" id="no" class="w-full border-gray-300 rounded mt-1"
                required maxlength="10">
        </div>

        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">Simpan</button>
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
            window.location.href = "{{ route('admin.payment.index') }}"; // Ganti dengan route yang sesuai
        });

        // Close modal if user clicks outside the modal box
        window.addEventListener('click', function(event) {
            if (event.target.id === 'cancelModal') {
                closeModal('cancelModal');
            }
        });
    </script>
@endsection
