@extends('trainee.layouts.app')

@section('title', 'Order Event Payment')

@section('content')
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200">

        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('trainee.my-events') }}"
                class="inline-flex items-center px-3 py-2 border border-transparent text-base font-medium rounded-md shadow-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition ease-in-out duration-150">
                <!-- Heroicon name: outline/arrow-left -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 mb-6 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 mb-6 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Pembayaran Event</h1>

        <!-- Detail Pesanan -->
        <div class="bg-white shadow-md rounded-lg border border-gray-200 mb-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Judul Event</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="py-4 px-6 text-sm text-gray-800">{{ $participant->event->event_title }}</td>
                        <td class="py-4 px-6 text-sm text-gray-600">Rp
                            {{ number_format($participant->event->price, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-sm text-gray-600">{{ ucfirst($orderEvent->status ?? 'pending') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Form Pembayaran -->
        @if ($orderEvent->status === 'pending')
            <form action="{{ route('trainee.order.event.store', $participant->id) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="payment_method_id" class="block text-sm font-medium text-gray-700 mb-2">Metode
                        Pembayaran:</label>
                    <select name="payment_method_id" id="payment_method_id" required
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        @foreach ($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->method_name }} | {{ $method->no }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="total_amount" class="block text-sm font-medium text-gray-700 mb-2">Total Pembayaran:</label>
                    <input type="number" name="total_amount" id="total_amount"
                        class="block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 cursor-not-allowed"
                        value="{{ $participant->event->price }}" readonly>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    Bayar Sekarang
                </button>
            </form>
        @else
            <div class="bg-gray-50 border border-gray-200 text-gray-800 p-4 mb-6 rounded-md">
                @if ($orderEvent->status === 'completed')
                    <p>Pembayaran Anda telah berhasil diproses dan statusnya adalah <strong>Completed</strong>. Terima
                        kasih!</p>
                @elseif ($orderEvent->status === 'canceled')
                    <p>Pembayaran Anda dibatalkan dengan status <strong>Cancelled</strong>. Silakan hubungi bantuan untuk
                        bantuan lebih lanjut.</p>
                @else
                    <p>Status pembayaran Anda adalah <strong>{{ ucfirst($orderEvent->status) }}</strong>.</p>
                @endif
            </div>
        @endif
    </div>
@endsection
