@extends('admin.layouts.app-admin-website')

@section('title', 'Upload Sertifikat')

@section('header')
    Upload Sertifikat
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">

        <!-- Form -->
        <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-md rounded-lg p-6 space-y-6">
            @csrf

            <!-- Trainee Selection -->
            <div class="flex flex-col space-y-4">
                <label for="trainee_id" class="text-sm font-medium text-gray-700">Pilih peserta:</label>
                <select name="trainee_id" id="trainee_id"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    @foreach ($trainees as $trainee)
                        <option value="{{ $trainee->id }}">{{ $trainee->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Issue Date -->
            <div class="flex flex-col space-y-4">
                <label for="issue_date" class="text-sm font-medium text-gray-700">Tanggal Penerbitan:</label>
                <input type="date" name="issue_date" id="issue_date"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                    required>
            </div>

            <!-- Certificate Image -->
            <div class="flex flex-col space-y-4">
                <label for="certificate_image" class="text-sm font-medium text-gray-700">Upload Sertifikat:</label>
                <input type="file" name="certificate_image" id="certificate_image"
                    class="block w-full border border-gray-300 rounded-md shadow-sm file:bg-blue-50 file:border file:border-gray-300 file:text-gray-700 file:py-2 file:px-4 file:rounded-md hover:file:bg-blue-100 transition duration-150 ease-in-out"
                    required>
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
            <div class="mt-3">
                <a href="{{ route('admin.certificates.index') }}"
                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </form>
    </div>
@endsection
