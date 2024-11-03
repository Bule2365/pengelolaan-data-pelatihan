@extends('trainee.layouts.app')

@section('title', 'My Events')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Daftar Event</h1>

        @if ($events->isEmpty())
            <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 p-4 rounded-lg shadow-md">
                <p class="text-base">Anda belum terdaftar untuk event apapun.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table
                    class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md divide-y divide-gray-200 text-center">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">No</th>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">Event Title</th>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">Price</th>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($events as $participant)
                            @if ($participant->event)
                                <tr>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $participant->event->event_title }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-600">Rp
                                        {{ number_format($participant->event->price, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6 text-sm">
                                        <a href="{{ route('trainee.order.create', $participant->orderEvent->id) }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-150 ease-in-out">
                                            Cek Pembayaran Event
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
