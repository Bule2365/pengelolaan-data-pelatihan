@extends('admin.layouts.app-admin-website')

@section('title', 'Detail Trainers')

@section('header')
    Detail Data Pelatih
@endsection

@section('content')
    <div class="p-6 bg-white shadow rounded-lg">
        <div class="flex items-center space-x-4 mb-4">
            <div class="flex-shrink-0">
                <div class="h-16 w-16 bg-blue-600 text-white rounded-full flex items-center justify-center">
                    <span class="text-2xl font-semibold">{{ strtoupper(substr($trainer->name, 0, 1)) }}</span>
                </div>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-900">{{ $trainer->name }}</h2>
                <p class="text-gray-600">{{ $trainer->phone }}</p>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-sm text-gray-700"><strong>Biografi:</strong> {{ $trainer->biography }}</p>
            <p class="text-sm text-gray-700"><strong>Pengalaman:</strong> {{ $trainer->experience }} tahun</p>
        </div>

        <!-- Back to Index Button -->
        <div class="mt-3">
            <a href="{{ route('trainers.index') }}"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection
