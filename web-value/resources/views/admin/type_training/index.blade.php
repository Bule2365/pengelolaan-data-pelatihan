@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Jenis Pelatihan')

@section('header', 'Daftar Jenis Pelatihan')

@section('content')
    <div class="mb-6 mt-4 flex justify-between items-center flex-wrap">
        <a href="{{ route('type_trainings.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Jenis Pelatihan
        </a>
    </div>

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
            <table class="w-full min-w-[600px] bg-white border-collapse">
                <thead class="bg-blue-50 text-blue-800">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs md:text-sm lg:text-base">No</th>
                        <th class="px-4 py-2 text-left text-xs md:text-sm lg:text-base">Nama Jenis Pelatihan</th>
                        <th class="px-4 py-2 text-left text-xs md:text-sm lg:text-base">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{-- @php $number = 1; @endphp --}}
                    @foreach ($types as $type)
                        <tr class="hover:bg-gray-50 transition-colors duration-300">
                            <td class="px-4 py-4 text-xs md:text-sm lg:text-base">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-xs md:text-sm lg:text-base">{{ $type->type_name }}</td>
                            <td class="px-4 py-4 flex space-x-2 md:space-x-4">
                                {{-- <a href="{{ route('type_trainings.edit', $type->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition-transform transform hover:scale-110">
                                    <!-- Edit Icon -->
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232a2.828 2.828 0 013.95 3.95L8 17H5v-3L15.232 5.232z"></path>
                                    </svg>
                                </a> --}}
                                <!-- Tombol Hapus untuk memicu modal -->
                                <button onclick="openModal('delete-modal-{{ $type->id }}')"
                                    class="text-red-600 hover:text-red-800 transition-transform transform hover:scale-110">
                                    <!-- Trash Icon -->
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L6 6M18 18L18 6M6 6L18 6M6 6L6 4a1 1 0 011-1h10a1 1 0 011 1v2M10 11v6M14 11v6">
                                        </path>
                                    </svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Konfirmasi Hapus -->
                        <div id="delete-modal-{{ $type->id }}"
                            class="fixed inset-0 hidden items-center justify-center bg-gray-500 bg-opacity-50 z-50 transition-opacity duration-500 opacity-0">
                            <div
                                class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto transition-transform duration-500 transform scale-95">
                                <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h2>
                                <p class="mt-2 text-gray-700">Apakah Anda yakin ingin menghapus jenis pelatihan ini?</p>
                                <div class="mt-4 flex justify-end space-x-4">
                                    <form action="{{ route('type_trainings.destroy', $type->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                    <button onclick="closeModal('delete-modal-{{ $type->id }}')"
                                        class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150">
                                        Batal
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
                const modals = document.querySelectorAll('[id^="delete-modal-"]');
                modals.forEach(modal => closeModal(modal.id));
            }
        });
    </script>
@endsection
