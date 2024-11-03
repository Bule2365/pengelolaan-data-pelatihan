@extends('admin.layouts.app-admin-website')

@section('title', 'Detail Sertifikat')

@section('header')
    Sertifikat {{ $certificate->trainee->name }}
@endsection

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="space-y-6">
            <!-- Certificate Details -->
            <div class="space-y-2">
                <p class="text-lg font-semibold"><strong>ID:</strong> {{ $certificate->id }}</p>
                <p class="text-lg font-semibold"><strong>Nama Peserta:</strong> {{ $certificate->trainee->name }}</p>
                <p class="text-lg font-semibold"><strong>Tanggal Penerbitan:</strong> {{ $certificate->issue_date }}</p>
            </div>

            <!-- Certificate Image -->
            <div class="flex flex-col items-center">
                <p class="text-lg font-semibold">Sertifikat</p>
                <img src="{{ asset('images/' . $certificate->certificate_image) }}" alt="Certificate Image"
                    class="w-full max-w-md rounded-lg shadow-md mt-6">
            </div>

            <!-- Back to Index Button -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('admin.certificates.index') }}"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
@endsection
