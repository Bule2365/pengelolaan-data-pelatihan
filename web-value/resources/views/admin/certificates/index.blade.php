@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Sertifikat')

@section('header')
    Data Sertifikat Peserta
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.certificates.create') }}"
                class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                Upload Sertifikat
            </a>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('admin.certificates.index') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search trainee name..."
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:border-blue-500">

                <button type="submit"
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-110">
                    Search
                </button>
            </div>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if ($certificates->isEmpty())
            <p class="text-center text-gray-500">Tidak ada sertifikat yang tersedia.</p>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Peserta</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Penerbitan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sertifikat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($certificates as $certificate)
                            <tr class="hover:bg-gray-50 transition duration-300 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $certificate->trainee->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $certificate->issue_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <img src="{{ asset('images/' . $certificate->certificate_image) }}"
                                        class="w-28 h-18 object-cover rounded" alt="Certificate Image">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-4"> <!-- Flexbox & Space -->
                                        <!-- Link to Detail -->
                                        <a href="{{ url('certificates-detail', $certificate->id) }}"
                                            class="text-blue-600 hover:text-blue-800 transition-transform transform hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18c-6 0-10-8-10-8s4-8 10-8 10 8 10 8-4 8-10 8zM10 7a3 3 0 100 6 3 3 0 000-6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <button onclick="openModal('delete-confirmation-modal-{{ $certificate->id }}')"
                                            class="text-red-600 hover:text-red-800 transition-transform transform hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L6 6M18 18L18 6M6 6L18 6M6 6L6 4a1 1 0 011-1h10a1 1 0 011 1v2M10 11v6M14 11v6">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <!-- Delete Confirmation Modal -->
                                <div id="delete-confirmation-modal-{{ $certificate->id }}"
                                    class="fixed inset-0 items-center justify-center bg-gray-500 bg-opacity-50 hidden z-50 transition-opacity duration-500 opacity-0">
                                    <div
                                        class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto transition-transform duration-500 transform scale-95">
                                        <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h2>
                                        <p class="mt-2 text-gray-700">Apakah Anda yakin ingin menghapus sertifikat peserta
                                            ini?</p>
                                        <div class="mt-4 flex space-x-4">
                                            <form action="{{ route('admin.certificates.destroy', $certificate->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150">
                                                    Hapus
                                                </button>
                                            </form>
                                            <button
                                                onclick="closeModal('delete-confirmation-modal-{{ $certificate->id }}')"
                                                class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-3">
                    {{ $certificates->links() }} <!-- Pagination -->
                </div>
            </div>
        @endif
    </div>
    <script>
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
    </script>
@endsection
