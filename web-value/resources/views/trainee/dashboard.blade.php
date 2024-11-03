@extends('trainee.layouts.app')

@section('title', 'Trainee Dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-extrabold mb-6 text-blue-500">Welcome, {{ $trainee->name }}!</h1>

        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Your Certificates</h2>

        @if ($certificates->isEmpty())
            <p class="text-gray-600">You have no certificates yet.</p>
        @else
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Issue Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Certificate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300">
                        @foreach ($certificates as $certificate)
                            <tr class="hover:bg-gray-100 transition-colors duration-300">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $certificate->issue_date }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <img src="{{ asset('images/' . $certificate->certificate_image) }}"
                                        alt="Certificate Image" class="w-24 h-auto rounded-lg shadow-sm">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <!-- Button for Viewing the Certificate -->
                                    <button onclick="openModal('modal-{{ $certificate->id }}')"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-150">
                                        View
                                    </button>

                                    <!-- Download Button -->
                                    <a href="{{ route('trainee.certificates.download', $certificate->id) }}"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-150">
                                        Download
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal for Viewing the Certificate -->
                            <div id="modal-{{ $certificate->id }}"
                                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                                <div
                                    class="bg-white rounded-lg overflow-hidden shadow-lg transform transition-all sm:w-full sm:max-w-6xl">
                                    <div class="flex justify-between items-center px-6 py-4 bg-blue-500">
                                        <h3 class="text-lg leading-6 font-medium text-white">Certificate Details</h3>
                                        <button onclick="closeModal('modal-{{ $certificate->id }}')"
                                            class="text-white text-2xl">&times;</button>
                                    </div>
                                    <div class="p-6">
                                        <img src="{{ asset('images/' . $certificate->certificate_image) }}"
                                            alt="Certificate Image" class="w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).classList.add('flex');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('flex');
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
