@extends('trainer.layouts.app')

@section('title', 'Trainer Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Send Training Material</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('training_materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="data_price_id" class="block text-sm font-medium text-gray-700">Data Price</label>
                <select id="data_price_id" name="data_price_id"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    @foreach ($dataPrices as $dataPrice)
                        <option value="{{ $dataPrice->id }}">{{ $dataPrice->training_title }}</option>
                    @endforeach
                </select>
                @error('data_price_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="material_file" class="block text-sm font-medium text-gray-700">Material File</label>
                <input type="file" id="material_file" name="material_file"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                @error('material_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
        </form>
    </div>
@endsection
