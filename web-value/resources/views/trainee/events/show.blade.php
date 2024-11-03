@extends('trainee.layouts.app')

@section('title', 'Event Details')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('trainee.events.index') }}"
                class="inline-flex items-center px-3 py-2 border border-transparent text-base font-medium rounded-md shadow-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition ease-in-out duration-150">
                <!-- Heroicon name: outline/arrow-left -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-4xl font-extrabold text-gray-900 ml-4">{{ $event->event_title }}</h1>
        </div>

        @php
            use Carbon\Carbon;
            $eventHasEnded = Carbon::now()->greaterThan($event->event_time);
        @endphp

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            @if ($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_title }}"
                    class="w-full h-72 object-cover object-center">
            @endif

            <div class="p-6">
                <p class="text-gray-800 text-lg mb-3"><strong>Trainer:</strong> {{ $event->trainer->name }}</p>
                <p class="text-gray-700 text-base mb-4">{{ $event->event_description }}</p>

                <p class="text-gray-900 text-lg font-semibold mb-2"><strong>Date & Time:</strong>
                    {{ $event->event_time->format('F j, Y, g:i a') }}
                </p>

                <p class="text-gray-900 text-base mb-4"><strong>Type:</strong> {{ ucfirst($event->event_type) }}</p>
                <p class="text-gray-900 text-base mb-6"><strong>Price:</strong> Rp{{ number_format($event->price, 2) }}</p>

                <div class="flex space-x-4">
                    @if ($eventHasEnded)
                        <p class="text-red-600 text-base">Event has ended. Registration is closed.</p>
                    @else
                        @if ($isRegistered)
                            @if ($orderStatus !== 'completed')
                                <form action="{{ route('trainee.events.unregister', $event->id) }}" method="POST"
                                    class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-500 focus:ring-opacity-50 transition ease-in-out duration-150">
                                        Unregister
                                    </button>
                                </form>
                            @else
                                <p class="text-red-600 text-base">You cannot unregister from a completed event.</p>
                            @endif
                        @else
                            <form action="{{ route('trainee.events.register', $event->id) }}" method="POST"
                                class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 transition ease-in-out duration-150">
                                    Register
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
