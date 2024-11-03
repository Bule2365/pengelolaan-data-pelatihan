@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Data Prices')

@section('header')
    Evaluation Create
@endsection

@section('content')
    <div class="max-w-4xl mx-auto mt-8">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.evaluation.store') }}" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="section" class="block text-gray-700 text-sm font-bold mb-2">Section</label>
                <input type="text" id="section" name="section"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>

            <div class="mb-6">
                <label for="question" class="block text-gray-700 text-sm font-bold mb-2">Question</label>
                <input type="text" id="question" name="question"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>

            <div class="flex flex-col gap-4 text-center mt-6">
                <button type="submit"
                    class="bg-blue-500 w-full rounded-lg hover:bg-blue-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline">
                    Save
                </button>
                <a href="{{ route('admin.evaluation.index') }}"
                    class="bg-gray-500 w-full rounded-lg hover:bg-gray-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline">
                    Back
                </a>
            </div>
        </form>
    </div>
@endsection
