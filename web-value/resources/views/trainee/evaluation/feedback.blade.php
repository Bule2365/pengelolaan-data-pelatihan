@extends('trainee.layouts.app')

@section('title', 'Feedback Form')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">
            Feedback for Training:
            @if ($training->post && $training->post->dataPrice)
                <span class="text-blue-600">{{ $training->post->dataPrice->training_title }}</span>
            @else
                <span class="text-gray-500">Title not available</span>
            @endif
        </h1>

        <p class="mb-4 text-gray-700">
            Terima kasih telah berpartisipasi dalam pelatihan kami! Kami sangat menghargai waktu dan dedikasi Anda. Untuk
            membantu kami meningkatkan kualitas pelatihan di masa mendatang, kami meminta Anda untuk memberikan masukan
            tentang pengalaman Anda selama pelatihan ini.
        </p>

        <form action="{{ route('feedback.store', $training->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="form-group mb-4">
                <label for="score" class="block text-sm font-medium text-gray-700">Penilaian (1-5):</label>
                <input type="number" name="score" id="score" min="1" max="5"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required>
            </div>

            <div class="form-group mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Masukan atau Saran:</label>
                <textarea name="description" id="description"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    rows="5" placeholder="Bagikan pendapat Anda tentang pelatihan ini..."></textarea>
            </div>

            {{-- Tombol submit untuk mengirim evaluasi --}}
            <div class="mt-4 text-right">
                <button type="submit"
                    class="w-full bg-blue-500 text-white px-6 py-3 rounded-md shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 transition duration-150 ease-in-out">
                    Submit Feedback
                </button>
            </div>

            {{-- Tombol kembali untuk membatalkan form --}}
            <div class="mt-4 text-center">
                <a href="{{ route('trainings.list') }}"
                    class="w-full inline-block bg-blue-500 text-white px-6 py-3 rounded-md shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:ring-opacity-50 transition duration-150 ease-in-out">Back
                </a>
            </div>

        </form>
    </div>
@endsection
