@extends('trainee.layouts.app')

@section('title', 'Events List')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Events List</h1>

        @if ($events->isEmpty())
            <p class="text-gray-500">No events available.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_title }}"
                                class="w-full h-40 object-cover">
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->event_title }}</h2>
                            <p class="text-gray-600 text-sm mb-2">{{ $event->event_description }}</p>
                            <div class="text-gray-500 text-xs mb-2">
                                <p>Date & Time: {{ $event->event_time->format('F j, Y, g:i a') }}</p>
                                <p>Type: <span class="font-semibold capitalize">{{ $event->event_type }}</span></p>
                                <p>Price: <span class="font-semibold">Rp{{ number_format($event->price, 2) }}</span></p>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('trainee.events.show', $event) }}"
                                    class="text-blue-500 text-sm hover:underline">Learn More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
