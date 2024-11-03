@extends('trainee.layouts.app')

@section('title', 'Order Payment')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg border border-gray-200">

        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('trainee.orders.index') }}"
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

        @if ($order)
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Order Details</h1>
            <div class="space-y-4 mb-6">
                <p class="text-lg font-medium text-gray-700"><strong>Order ID:</strong> {{ $order->id }}</p>
                <p class="text-lg font-medium text-gray-700"><strong>Total Amount:</strong> Rp
                    {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                <p class="text-lg font-medium text-gray-700"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

                @if ($order->training)
                    <p class="text-lg font-medium text-gray-700"><strong>Training Title:</strong>
                        {{ $order->training->post->dataPrice->training_title }}</p>
                    <p class="text-lg font-medium text-gray-700"><strong>Price:</strong> Rp
                        {{ number_format($order->training->post->dataPrice->price, 0, ',', '.') }}</p>
                @endif
            </div>

            @if ($order->status === 'pending')
                <form action="{{ route('trainee.payment.process', $order->training_id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="payment_method_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Metode
                            Pembayaran</label>
                        <select name="payment_method_id" id="payment_method_id" required
                            class="block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                            @foreach ($paymentMethods as $method)
                                <option value="{{ $method->id }}">{{ $method->method_name }} | {{ $method->no }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="total_amount" class="block text-sm font-medium text-gray-700 mb-2">Total Amount:</label>
                        <input type="text" name="total_amount" id="total_amount"
                            value="{{ $order->training->post->dataPrice->price }}" readonly
                            class="block w-full border border-gray-300 rounded-md p-2 bg-gray-100 text-gray-700 cursor-not-allowed">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Pay Now
                    </button>
                </form>
            @else
                <div class="bg-gray-50 border border-gray-200 text-gray-800 p-4 rounded-md">
                    @if ($order->status === 'completed')
                        <p>Pembayaran Anda telah berhasil diproses dan statusnya adalah <strong>Completed</strong>. Terima
                            kasih!</p>
                    @elseif ($order->status === 'canceled')
                        <p>Pembayaran anda telah di <strong>Cancelled</strong>. Silakan hubungi dukungan untuk bantuan lebih
                            lanjut.</p>
                    @else
                        <p>The status of your payment is <strong>{{ ucfirst($order->status) }}</strong>.</p>
                    @endif
                </div>
            @endif
        @else
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-md">
                <p>No order found. Please make sure you have a valid order.</p>
            </div>
        @endif
    </div>
@endsection
