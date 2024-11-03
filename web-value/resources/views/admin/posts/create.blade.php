@extends('admin.layouts.app-admin-website')

@section('title', 'Tambah Postingan')

@section('header')
    Tambah Postingan
@endsection

@section('content')
    <div class="container mx-auto mt-8">
        <form action="{{ route('manage-posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Trainer Dropdown -->
            <div>
                <label for="trainer_id" class="block text-sm font-medium text-gray-700">Pelatih</label>
                <select id="trainer_id" name="trainer_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih Pelatih</option>
                    @foreach ($trainers as $trainer)
                        <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                    @endforeach
                </select>
                @error('trainer_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Data Price Dropdown -->
            <div>
                <label for="data_price_id" class="block text-sm font-medium text-gray-700">Harga Pelatihan</label>
                <select id="data_price_id" name="data_price_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    disabled>
                    <option value="">Pilih Harga Pelatihan</option>
                </select>
                @error('data_price_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Schedule Dropdown -->
            <div>
                <label for="schedule_id" class="block text-sm font-medium text-gray-700">Pilih Jadwal Pelatihan</label>
                <select id="schedule_id" name="schedule_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    disabled>
                    <option value="">Pilih jadwal</option>
                </select>
                @error('schedule_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Other Fields -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Postingan</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Upload Gambar</label>
                <input id="image" name="image" type="file"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="categories_post_id" class="block text-sm font-medium text-gray-700">Kategori Pelatihan</label>
                <select id="categories_post_id" name="categories_post_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih kategori</option>
                    @foreach ($categoriesPosts as $categoriesPost)
                        <option value="{{ $categoriesPost->id }}">{{ $categoriesPost->category_name }}</option>
                    @endforeach
                </select>
                @error('categories_post_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="post_date" class="block text-gray-700">Tanggal upload</label>
                <input type="date" name="post_date" id="post_date" class="w-full mt-2 p-2 border rounded" value="{{ old('post_date', now()->format('Y-m-d')) }}" readonly>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('manage-posts.index') }}" class="ml-4 text-gray-700">Kembali ke Daftar</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('trainer_id').addEventListener('change', function() {
            const trainerId = this.value;
            const dataPriceSelect = document.getElementById('data_price_id');
            const scheduleSelect = document.getElementById('schedule_id');

            // Reset dropdowns
            dataPriceSelect.innerHTML = '<option value="">Pilih Data Price</option>';
            scheduleSelect.innerHTML = '<option value="">Pilih Schedule</option>';

            // Disable dropdowns if no trainer selected
            dataPriceSelect.disabled = !trainerId;
            scheduleSelect.disabled = !trainerId;

            if (trainerId) {
                // Fetch Data Prices
                fetch(`/api/dataPrices/${trainerId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok.');
                        return response.json();
                    })
                    .then(dataPrices => {
                        dataPrices.forEach(price => {
                            dataPriceSelect.innerHTML +=
                                `<option value="${price.id}">${price.training_title} - ${price.price}</option>`;
                        });
                        dataPriceSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching data prices:', error);
                        dataPriceSelect.disabled = true;
                    });

                // Fetch Schedules
                fetch(`/api/schedules/${trainerId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok.');
                        return response.json();
                    })
                    .then(schedules => {
                        schedules.forEach(schedule => {
                            scheduleSelect.innerHTML +=
                                `<option value="${schedule.id}">${schedule.schedule_date}</option>`;
                        });
                        scheduleSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching schedules:', error);
                        scheduleSelect.disabled = true;
                    });
            }
        });
    </script>
@endsection
