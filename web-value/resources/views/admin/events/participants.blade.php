@extends('admin.layouts.app-admin-website')

@section('title', 'Event Participants')

@section('header')
    Daftar Peserta Event {{ $event->event_title }}
@endsection

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <a href="{{ route('events.index') }}"
            class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Index
        </a>
        @if ($participants->isEmpty())
            <p class="text-gray-500">No participants registered for this event.</p>
        @else
            <table class="min-w-full bg-white mt-6 border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-gray-700">Trainee Name</th>
                        <th class="py-3 px-6 text-left text-gray-700">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 px-4">{{ $participant->trainee->name }}</td>
                            <td class="py-2 px-4">{{ $participant->trainee->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
