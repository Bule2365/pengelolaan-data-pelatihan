@extends('admin.layouts.app-admin-website')

@section('title', 'Evaluation Details')

@section('header')
    Evaluation Details
@endsection

@section('content')
    <div class="container mx-auto p-6">

        <!-- Informasi Trainee dan Training -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold">Trainee Information</h2>
            <p><strong>Name:</strong> {{ $evaluation->trainee->name }}</p>
            <p><strong>Training Name:</strong> {{ $evaluation->training->post->dataPrice->training_title }}</p>
            <p><strong>Evaluation Date:</strong> {{ $evaluation->created_at->format('d-m-Y') }}</p>
        </div>

        <!-- Detail Evaluasi -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Section</th>
                        <th class="py-2 px-4 border-b text-left">Question</th>
                        <th class="py-2 px-4 border-b text-left">Score</th>
                        <th class="py-2 px-4 border-b text-left">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluation->evaluationResponses as $evaluationResponse)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $evaluationResponse->item->section }}</td>
                            <td class="py-2 px-4 border-b">{{ $evaluationResponse->item->question }}</td>
                            <td class="py-2 px-4 border-b">{{ $evaluationResponse->response }}</td>
                            <td class="py-2 px-4 border-b">{{ $evaluationResponse->comments ?? 'No comments' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Download PDF Button -->
        <div class="mt-3">
            <a href="{{ route('evaluation.downloadPdf', ['id' => $evaluation->id]) }}"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Download PDF
            </a>
        </div>        
        <!-- Back Button -->
        <div class="mt-3">
            <a href="{{ route('admin.evaluation.index') }}"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Index
            </a>
        </div>
    </div>
@endsection
