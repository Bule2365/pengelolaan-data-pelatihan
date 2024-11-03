@extends('admin.layouts.app-admin-website')

@section('title', 'Create Trainers')

@section('header')
    Tambah Data Pelatih
@endsection

@section('content')
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('trainers.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Email -->
            <div class="flex flex-col space-y-1">
                <label for="email" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8"></path>
                    </svg>
                    <span>Email</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
            </div>

            <!-- Name -->
            <div class="flex flex-col space-y-1">
                <label for="name" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7v14" />
                    </svg>
                    <span>Nama</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full mt-6 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
            </div>

            <!-- Phone -->
            <div class="flex flex-col space-y-1">
                <label for="phone" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12h20M12 2v20" />
                    </svg>
                    <span>Nomor Telepon</span>
                </label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
            </div>

            <!-- Biography -->
            <div class="flex flex-col space-y-1">
                <label for="biography" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6h12v12H6z" />
                    </svg>
                    <span>Biografi</span>
                </label>
                <textarea name="biography" id="biography"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">{{ old('biography') }}</textarea>
            </div>

            <!-- Experience -->
            <div class="flex flex-col space-y-1">
                <label for="experience" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
                    </svg>
                    <span>Pengalaman (Tahun)</span>
                </label>
                <input type="number" name="experience" id="experience" value="{{ old('experience') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
            </div>

            <!-- Password -->
            <div class="flex flex-col space-y-1">
                <label for="password" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m0 0H8m4 0h4" />
                    </svg>
                    <span>Kata Sandi</span>
                </label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
            </div>

            <!-- Confirm Password -->
            <div class="flex flex-col space-y-1">
                <label for="password_confirmation" class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m0 0H8m4 0h4" />
                    </svg>
                    <span>Konfirmasi Kata Sandi</span>
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
            </div>

            <!-- Submit Button -->
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
            window.location.href = "{{ route('trainers.index') }}"; // Ganti dengan route yang sesuai
        });

        // Close modal if user clicks outside the modal box
        window.addEventListener('click', function(event) {
            if (event.target.id === 'cancelModal') {
                closeModal('cancelModal');
            }
        });
    </script>
@endsection
