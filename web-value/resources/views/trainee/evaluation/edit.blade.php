@extends('trainee.layouts.app')

@section('title', 'Edit Evaluation Form')

@section('content')
    @if ($evaluationItems && $training)
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-2xl font-bold mb-6">Evaluasi Pelatihan: {{ $training->post->title }}</h1>

            {{-- Form untuk mengedit evaluasi --}}
            <form action="{{ route('evaluation.update', $evaluation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b text-left">Question</th>
                                <th class="py-3 px-4 border-b text-left">Score (1-5)</th>
                                <th class="py-3 px-4 border-b text-left">Comments (Optional)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluationItems as $item)
                                @php
                                    $response = $evaluationResponses->where('item_id', $item->id)->first();
                                @endphp
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $item->section }}: {{ $item->question }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <input type="number" name="responses[{{ $item->id }}][score]" min="1"
                                            max="5" value="{{ $response->response ?? '' }}"
                                            class="border border-gray-300 rounded-md px-2 py-1 w-full" required>
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        <textarea name="responses[{{ $item->id }}][comment]" placeholder="Add comments (optional)"
                                            class="border border-gray-300 rounded-md px-2 py-1 w-full" rows="3">{{ $response->comments ?? '' }}</textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- Tombol submit untuk mengirim evaluasi --}}
                <div class="mt-4 text-right">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white px-6 py-3 rounded-md shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        Submit Evaluation
                    </button>
                </div>

                {{-- Tombol kembali untuk membatalkan form --}}
                <div class="mt-4 text-center">
                    <a href="{{ route('trainings.list') }}"
                        class="w-full inline-block bg-blue-500 text-white px-6 py-3 rounded-md shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        Cancel & Back to Training List
                    </a>
                </div>

            </form>
        </div>
    @else
        <div class="container mx-auto px-4 py-6">
            <p class="text-gray-500">Training or evaluation items not available.</p>
        </div>
    @endif
@endsection
