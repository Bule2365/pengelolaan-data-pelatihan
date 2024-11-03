@extends('trainee.layouts.app')

@section('title', 'Daftar Pendaftaran Pelatihan')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Daftar Pelatihan</h1>

        @if ($trainings->isEmpty())
            <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 p-4 rounded-lg shadow-md">
                <p class="text-base">Anda belum terdaftar untuk pelatihan apapun.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table
                    class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md divide-y divide-gray-200 text-center">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">No</th>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">Judul Pelatihan
                            </th>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">Harga</th>
                            <th class="py-4 px-6 text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($trainings as $training)
                            <tr>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $training->post->dataPrice->training_title }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-600">Rp
                                    {{ number_format($training->post->dataPrice->price, 0, ',', '.') }}</td>
                                <td class="py-4 px-6 text-sm">
                                    <a href="{{ route('trainee.payment.post', $training->id) }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition duration-150 ease-in-out">
                                        Cek Pembayaran Pelatihan
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
