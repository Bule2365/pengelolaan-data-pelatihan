@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Data Materials')

@section('header')
    Data Materi pelatihan
@endsection

@section('content')
    <div class="overflow-x-auto">
        <form method="GET" action="{{ route('training_materials.index') }}" class="flex space-x-2 mt-4 mb-8 ml-2">
            <input type="text" name="search" placeholder="Cari berdasarkan judul training" value="{{ request('search') }}"
                class="border border-gray-300 rounded-md p-3 w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
            <button type="submit"
                class="px-4 py-3 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
                Cari
            </button>
        </form>
        <div class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <table class="w-full min-w-[600px] bg-white border-collapse">
                <thead class="bg-blue-50 text-blue-800">
                    <tr class="hover:bg-gray-50 transition-colors duration-300">
                        <th class="px-4 py-2 text-xs md:text-sm lg:text-base text-left">No.</th>
                        <th class="px-4 py-2 text-xs md:text-sm lg:text-base text-left">Judul Pelatihan</th>
                        <th class="px-4 py-2 text-xs md:text-sm lg:text-base text-left">Pelatih</th>
                        <th class="px-4 py-2 text-xs md:text-sm lg:text-base text-left">File</th>
                        <th class="px-4 py-2 text-xs md:text-sm lg:text-base text-left">Waktu dikirim</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($trainingMaterials as $index => $material)
                        <tr class="hover:bg-gray-50 transition-colors duration-300">
                            <td class="px-4 py-4 text-xs md:text-sm lg:text-base">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 text-xs md:text-sm lg:text-base">{{ $material->dataPrice->training_title }}
                            </td>
                            <td class="px-4 py-4 text-xs md:text-sm lg:text-base">{{ $material->trainer->name }}</td>
                            <td class="px-4 py-4 text-xs md:text-sm lg:text-base">
                                <a href="{{ asset('storage/' . $material->material_file) }}"
                                    class="text-blue-500 hover:underline" target="_blank">View File</a>
                            </td>
                            <td class="px-4 py-4 text-xs md:text-sm lg:text-base">
                                {{ \Carbon\Carbon::parse($material->created_at)->format('H:i:s | d-m-Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
