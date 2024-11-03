@extends('admin.layouts.app-admin-website')

@section('title', 'Create Schedule')

@section('header')
    <h1 class="text-2xl font-semibold text-blue-800">Tambah Jadwal Pelatihan</h1>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        @if (session('warning'))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                <p>{{ session('warning') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('schedule.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="trainer" class="block text-gray-700">Pilih Pelatih</label>
                <select id="trainer" name="trainer_id"
                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Select Trainer</option>
                    @foreach ($trainers as $trainer)
                        <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="data_price" class="block text-gray-700">Pilih Judul Pelatihan</label>
                <select id="data_price" name="data_price_id"
                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Select Data Price</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="training_material" class="block text-gray-700">Pilih Materi Pelatihan</label>
                <select id="training_material" name="training_material_id"
                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Select Training Material</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="schedule_date" class="block text-gray-700">Pilih Jadwal Pelatihan</label>
                <input type="date" id="schedule_date" name="schedule_date"
                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="hotel" class="block text-gray-700">Pilih Lokasi Pelatihan</label>
                <select id="hotel" name="hotel_id"
                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Select Hotel</option>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
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
                <a href="{{ route('schedule.index') }}"
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
    <script>
        document.getElementById('trainer').addEventListener('change', function() {
            const trainerId = this.value;

            // Clear previous options
            const dataPriceSelect = document.getElementById('data_price');
            const trainingMaterialSelect = document.getElementById('training_material');
            dataPriceSelect.innerHTML = '<option value="">Select Data Price</option>';
            trainingMaterialSelect.innerHTML = '<option value="">Select Training Material</option>';

            if (trainerId) {
                // Fetch Data Prices
                fetch(`/api/data-prices/${trainerId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        data.forEach(dataPrice => {
                            const option = document.createElement('option');
                            option.value = dataPrice.id;
                            option.textContent = dataPrice.training_title;
                            dataPriceSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching data prices:', error);
                    });

                // Fetch Training Materials
                fetch(`/api/training-materials/${trainerId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        data.forEach(material => {
                            const option = document.createElement('option');
                            option.value = material.id;
                            option.textContent = material.material_file;
                            trainingMaterialSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching training materials:', error);
                    });
            }
        });
    </script>
@endsection
