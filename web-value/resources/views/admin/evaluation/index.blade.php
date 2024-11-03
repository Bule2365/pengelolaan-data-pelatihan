@extends('admin.layouts.app-admin-website')

@section('title', 'Evaluations List')

@section('header')
    List Evaluasi Peserta
@endsection


@section('content')
    <div class="container mx-auto p-6">
        {{-- buat evaluasi --}}
        <div class="mb-4 flex items-center space-x-4">
            {{-- <!-- Tombol Tambah Jadwal Pelatihan -->
            <a href="{{ route('admin.evaluation.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Pertanyaan Dalam Evaluasi
            </a> --}}

            <!-- Form Pencarian Berdasarkan Tanggal -->
            <form action="{{ route('admin.evaluation.index') }}" method="GET" class="flex items-center space-x-2">
                <input type="date" name="search_date" value="{{ $searchDate }}"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-150">
                    Search by Date
                </button>
            </form>
        </div>
        <!-- Tabel Daftar Evaluasi -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">#</th>
                        <th class="py-2 px-4 border-b text-left">Trainee Name</th>
                        <th class="py-2 px-4 border-b text-left">Training Name</th>
                        <th class="py-2 px-4 border-b text-left">Date</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($evaluations as $index => $evaluation)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border-b">{{ $evaluation->trainee->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $evaluation->training->post->dataPrice->training_title }}</td>
                            <td class="py-2 px-4 border-b">{{ $evaluation->created_at->format('d-m-Y') }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.evaluation.show', $evaluation->id) }}"
                                    class="text-blue-500 hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center text-gray-500">No evaluations found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $evaluations->links() }}
        </div>
    </div>
@endsection
