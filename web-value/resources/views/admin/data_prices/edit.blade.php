@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Data Prices')

@section('header')
    Edit Harga
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        <form action="{{ route('data-prices.update', $dataPrice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="training_title" class="block text-sm font-medium text-gray-700">Judul Pelatihan</label>
                <input type="text" id="training_title" name="training_title" value="{{ $dataPrice->training_title }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="price" name="price" value="{{ $dataPrice->price }}" step="0.01"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="type_training_id" class="block text-sm font-medium text-gray-700">Jenis Pelatihan</label>
                <select id="type_training_id" name="type_training_id"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    @foreach ($typeTrainings as $typeTraining)
                        <option value="{{ $typeTraining->id }}"
                            {{ $dataPrice->type_training_id == $typeTraining->id ? 'selected' : '' }}>
                            {{ $typeTraining->type_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="trainer_id" class="block text-sm font-medium text-gray-700">Pilih Pelatih</label>
                <select id="trainer_id" name="trainer_id"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    @foreach ($trainers as $trainer)
                        <option value="{{ $trainer->id }}" {{ $dataPrice->trainer_id == $trainer->id ? 'selected' : '' }}>
                            {{ $trainer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7v14" />
                </svg>
                Simpan
            </button>
            <div class="mt-3">
                <a href="{{ url('/data-prices') }}"
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
