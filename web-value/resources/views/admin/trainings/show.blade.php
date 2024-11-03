@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Pelatihan')

@section('header')
    Daftar Pelatihan
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ url('manage-posts') }}"
            class="inline-flex items-center justify-center mb-6 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar
        </a>

        <form method="GET"
            action="{{ $trainings->isNotEmpty() ? route('admin.trainings.show', $trainings->first()->post_id) : '#' }}"
            class="mb-6">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" placeholder="Cari nama peserta" value="{{ request('search') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out" />
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-150 ease-in-out">
                    Cari
                </button>
            </div>
        </form>

        @if ($trainings->isEmpty())
            <p class="text-gray-500 text-center">Tidak ada pelatihan yang terdaftar.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">No</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Trainee</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Post Title</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($trainings as $training)
                            <tr class="border-t">
                                <td class="py-3 px-4 border-b">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 border-b">{{ $training->trainee->name }}</td>
                                <td class="py-3 px-4 border-b">
                                    {{ $training->post->dataPrice->training_title }} -
                                    ${{ $training->post->dataPrice->price }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
