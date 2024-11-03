@extends('trainee.layouts.app')

@section('title', 'Available Posts')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Form Pencarian dan Dropdown Kategori -->
        <form action="{{ route('trainee.posts.index') }}" method="GET"
            class="flex flex-col sm:flex-row sm:items-center sm:justify-center mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 w-full max-w-3xl mx-auto">

                <!-- Input Pencarian -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..."
                    class="border border-gray-300 rounded-md px-4 py-2 mb-2 sm:mb-0 w-full sm:w-64">

                <!-- Dropdown Kategori -->
                <select name="category" class="border border-gray-300 rounded-md px-4 py-2 mb-2 sm:mb-0 sm:w-64">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-150 ease-in-out">
                    Search
                </button>
            </div>
        </form>

        @if ($posts->isEmpty())
            <p class="text-gray-500 text-center">Saat ini tidak ada postingan yang tersedia.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white shadow-md mt-10 rounded-lg overflow-hidden border border-gray-200">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-40 object-cover">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Image" alt="No Image"
                                class="w-full h-40 object-cover">
                        @endif

                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $post->dataPrice->training_title }}</h2>
                            <p class="text-gray-600 text-sm mb-2">
                                {{ \Illuminate\Support\Str::limit($post->description, 100, '...') }}</p>
                            <div class="text-gray-500 text-xs mb-2">
                                <p>Trainer: <span class="font-semibold">{{ $post->trainer->name }}</span></p>
                                <p>Price: <span
                                        class="font-semibold">Rp{{ number_format($post->dataPrice->price, 2) }}</span></p>
                                <p>Category: <span class="font-semibold">{{ $post->categoriesPost->category_name }}</span>
                                </p>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('posts.show', $post->id) }}"
                                    class="text-blue-500 text-sm hover:underline">Detail Training</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
