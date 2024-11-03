@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Postingan')

@section('header')
    Daftar Postingan
@endsection

@section('content')
    <div class="container mx-auto mt-8 px-4">

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
        <div class="mb-4">
            <a href="{{ route('manage-posts.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-2 inline-block">Tambah Postingan</a>
            <form method="GET" action="{{ route('manage-posts.index') }}">
                <input type="text" name="search" placeholder="Cari Judul Post" value="{{ request('search') }}"
                    class="border px-4 py-2 rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-6">Cari</button>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full mt-4 border border-gray-300 rounded-md">
                <thead class="text-blue-700 bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Pelatih</th>
                        <th class="py-2 px-4 border-b">Harga Pelatihan</th>
                        <th class="py-2 px-4 border-b">Judul Pelatihan</th>
                        <th class="py-2 px-4 border-b">Jadwal Pelatihan</th>
                        <th class="py-2 px-4 border-b">Kategori</th>
                        <th class="py-2 px-4 border-b">Tanggal Postingan</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $post->trainer->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $post->dataPrice->price ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $post->dataPrice->training_title ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $post->schedule->schedule_date ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $post->categoriesPost->category_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $post->post_date->format('d/m/Y') }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($post->status) }}</td>
                            <td class="px-2 py-4 flex space-x-2 md:space-x-4">
                                <a href="{{ route('manage-posts.edit', $post->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition-transform transform hover:scale-110">
                                    <!-- Edit Icon -->
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232a2.828 2.828 0 013.95 3.95L8 17H5v-3L15.232 5.232z"></path>
                                    </svg>
                                </a>
                                <!-- Trainings Button with Icon -->
                                <a href="{{ route('admin.trainings.show', $post->id) }}"
                                    class="text-green-600 hover:text-green-800 transition-transform transform hover:scale-110">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                            d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                    </svg>
                                </a>
                                <button onclick="openModal('delete-confirmation-modal-{{ $post->id }}')"
                                    class="text-red-600 hover:text-red-800 transition-transform transform hover:scale-110">
                                    <!-- Trash Icon -->
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L6 6M18 18L18 6M6 6L18 6M6 6L6 4a1 1 0 011-1h10a1 1 0 011 1v2M10 11v6M14 11v6">
                                        </path>
                                    </svg>
                                </button>
                            </td>
                            <!-- Delete Confirmation Modal -->
                            <div id="delete-confirmation-modal-{{ $post->id }}"
                                class="fixed inset-0 items-center justify-center bg-gray-500 bg-opacity-50 hidden z-50 transition-opacity duration-500 opacity-0">
                                <div
                                    class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto transition-transform duration-500 transform scale-95">
                                    <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h2>
                                    <p class="mt-2 text-gray-700">Apakah Anda yakin ingin menghapus postingan ini?</p>
                                    <div class="mt-4 flex space-x-4">
                                        <form action="{{ route('manage-posts.destroy', $post->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150">
                                                Hapus
                                            </button>
                                        </form>
                                        <button onclick="closeModal('delete-confirmation-modal-{{ $post->id }}')"
                                            class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-2 px-4 border-b text-center">No posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <Script>
        // Delete Modal
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

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-gray-500')) {
                const modals = document.querySelectorAll('[id^="delete-confirmation-modal-"]');
                modals.forEach(modal => modal.classList.add('hidden'));
            }
        });
    </Script>
@endsection
