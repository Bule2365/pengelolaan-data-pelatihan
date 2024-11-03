@extends('trainee.layouts.app')

@section('title', 'Post Details')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('trainee.posts.index') }}"
                class="inline-flex items-center px-3 py-2 border border-transparent text-base font-medium rounded-md shadow-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition ease-in-out duration-150">
                <!-- Heroicon name: outline/arrow-left -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-4xl font-extrabold text-gray-900 ml-4">{{ $post->dataPrice->training_title }}</h1>
        </div>

        @php
            use Carbon\Carbon;
            $postHasEnded = Carbon::now()->greaterThan($post->schedule->schedule_date);
        @endphp

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/1200x600?text=No+Image' }}"
                alt="{{ $post->title }}" class="w-full h-72 object-cover object-center">

            <div class="p-6">
                <p class="text-gray-800 text-lg mb-3"><strong>Trainer:</strong> {{ $post->trainer->name }}</p>
                <p class="text-gray-700 text-base mb-4">{{ $post->description }}</p>
                <p class="text-gray-900 text-lg font-semibold mb-2">Price: ${{ $post->dataPrice->price }}</p>
                <p class="text-gray-900 text-base mb-4"><strong>Schedule:</strong> {{ $post->schedule->schedule_date }}</p>
                <p class="text-gray-900 text-base mb-6"><strong>Category:</strong>
                    {{ $post->categoriesPost->category_name }}</p>

                <div class="flex space-x-4">
                    @if (Auth::check())
                        @if ($postHasEnded)
                            <p class="text-red-600 text-base">Pelatihan ini telah berakhir. Anda tidak dapat mendaftar silakan pilih pelatihan yang lain.
                            </p>
                        @else
                            @if ($isRegistered)
                                {{-- Cek jika status order adalah 'canceled' --}}
                                @if ($orderStatus === 'canceled')
                                    <form action="{{ route('trainee.unregister', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-500 focus:ring-opacity-50 transition ease-in-out duration-150">
                                            Unregister
                                        </button>
                                    </form>
                                @elseif ($orderStatus === 'pending')
                                    <p class="text-red-600 text-base">Anda tidak dapat membatalkan pendaftaran saat pembayaran sedang tertunda.</p>
                                @elseif ($orderStatus === 'completed')
                                    <p class="text-red-600 text-base">Anda tidak dapat membatalkan pendaftaran dari pelatihan yang telah selesai.</p>
                                @endif
                            @else
                            @if ($canRegister)
                                <form action="{{ route('trainee.register', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition ease-in-out duration-150">
                                        Register
                                    </button>
                                </form>
                            @else
                                <p class="text-red-600 text-base">Registrasi telah ditutup. Pendaftaran dapat dilakukan
                                    hingga 1 hari sebelum pelatihan.</p>
                            @endif
                        @endif
                    @endif
                @else
                    <p class="text-gray-500 text-base">Please log in to register for this post.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
