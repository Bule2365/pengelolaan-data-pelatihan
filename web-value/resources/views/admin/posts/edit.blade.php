@extends('admin.layouts.app-admin-website')

@section('title', 'Edit Postingan')

@section('header')
    Edit Postingan
@endsection

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="post-form" action="{{ route('manage-posts.update', $post->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Form Fields -->

                <div class="mb-4">
                    <label for="trainer_id" class="block text-gray-700">Trainer:</label>
                    <select name="trainer_id" id="trainer_id" class="w-full mt-2 p-2 border rounded" required>
                        @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ $post->trainer_id == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="data_price_id" class="block text-gray-700">Harga:</label>
                    <select name="data_price_id" id="data_price_id" class="w-full mt-2 p-2 border rounded" required>
                        @foreach ($dataPrices as $dataPrice)
                            <option value="{{ $dataPrice->id }}"
                                {{ $post->data_price_id == $dataPrice->id ? 'selected' : '' }}>
                                {{ $dataPrice->training_title }} - {{ $dataPrice->price }}
                            </option>
                        @endforeach
                    </select>
                </div>                

                <div class="mb-4">
                    <label for="schedule_id" class="block text-gray-700">Jadwal:</label>
                    <select name="schedule_id" id="schedule_id" class="w-full mt-2 p-2 border rounded" required>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}"
                                {{ $post->schedule_id == $schedule->id ? 'selected' : '' }}>
                                {{ $schedule->schedule_date }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="categories_post_id" class="block text-gray-700">Kategori:</label>
                    <select name="categories_post_id" id="categories_post_id" class="w-full mt-2 p-2 border rounded"
                        required>
                        @foreach ($categoriesPosts as $categoriesPost)
                            <option value="{{ $categoriesPost->id }}"
                                {{ $post->categories_post_id == $categoriesPost->id ? 'selected' : '' }}>
                                {{ $categoriesPost->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Deskripsi:</label>
                    <textarea name="description" id="description" class="w-full mt-2 p-2 border rounded" rows="4">{{ old('description', $post->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Gambar:</label>
                    <input type="file" name="image" id="image" class="w-full mt-2 p-2 border rounded">
                    @if ($post->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                class="w-20 h-20 object-cover">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="post_date" class="block text-gray-700">Tanggal Posting:</label>
                    <input type="date" name="post_date" id="post_date" class="w-full mt-2 p-2 border rounded"
                        value="{{ old('post_date', $post->post_date ? $post->post_date->format('Y-m-d') : '') }}" required
                        readonly>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status:</label>
                    <select name="status" id="status" class="w-full mt-2 p-2 border rounded">
                        <option value="active" {{ $post->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $post->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
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
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const trainerSelect = document.getElementById('trainer_id');
                const dataPriceSelect = document.getElementById('data_price_id');
                const scheduleSelect = document.getElementById('schedule_id');

                trainerSelect.addEventListener('change', function() {
                    const trainerId = this.value;

                    fetch(`/api/data-prices/${trainerId}`)
                        .then(response => response.json())
                        .then(dataPrices => {
                            dataPriceSelect.innerHTML = '<option value="">Pilih Data Price</option>';
                            dataPrices.forEach(dataPrice => {
                                dataPriceSelect.innerHTML +=
                                    `<option value="${dataPrice.id}">${dataPrice.price}</option>`;
                            });
                        });

                    fetch(`/api/schedules/${trainerId}`)
                        .then(response => response.json())
                        .then(schedules => {
                            scheduleSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
                            schedules.forEach(schedule => {
                                scheduleSelect.innerHTML +=
                                    `<option value="${schedule.id}">${schedule.schedule_date}</option>`;
                            });
                        });
                });

                const preselectedTrainerId = trainerSelect.value;
                if (preselectedTrainerId) {
                    trainerSelect.dispatchEvent(new Event('change'));
                }
            });

            // Edit Modal
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
                window.location.href = "{{ route('manage-posts.index') }}"; // Ganti dengan route yang sesuai
            });

            // Close modal if user clicks outside the modal box
            window.addEventListener('click', function(event) {
                if (event.target.id === 'cancelModal') {
                    closeModal('cancelModal');
                }
            });
        </script>
    @endpush
@endsection
