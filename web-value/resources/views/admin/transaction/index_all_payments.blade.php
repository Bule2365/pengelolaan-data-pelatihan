@extends('admin.layouts.app-admin-website')

@section('title', 'Daftar Pembayaran')

@section('header')
    Daftar Transaksi
@endsection

@section('content')
    <div class="container mx-auto px-4">

        <!-- Form Pencarian -->
        <div class="container mx-auto p-6">
            <div class="bg-gray-100 p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl text-blue-700 font-semibold mb-4">Pencarian Pembayaran</h2>
                <form method="GET" action="{{ route('admin.payments.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 placeholder-gray-400"
                            placeholder="Cari berdasarkan nama trainee...">

                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">

                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
                    </div>
                    <button type="submit"
                        class="w-full px-6 py-3 bg-blue-600 text-white text-lg font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        @if (isset($message))
            <div id="success-alert" class="fixed inset-0 flex items-center justify-center z-50">
                <div
                    class="bg-green-100 text-green-800 p-4 rounded-lg shadow-lg transition-transform transform duration-300 ease-in-out max-w-md mx-auto w-full relative">
                    <!-- Ikon -->
                    {{-- <svg class="w-6 h-6 mr-3 inline-flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg> --}}
                    <!-- Pesan -->
                    <span class="flex-1">{{ $message }}</span>
                    <!-- Tombol Tutup -->
                    <button onclick="document.getElementById('success-alert').style.display='none'"
                        class="absolute top-2 right-2 text-green-600 hover:text-green-800 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <a href="{{ route('admin.orders.events') }}"
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Cek pembayaran Event</a>
        <a href="{{ route('admin.orders.posts') }}"
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Cek pembayaran Post</a>
        <table class="min-w-full bg-white border border-gray-200 text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Trainee</th>
                    <th class="py-2 px-4 border-b">Order Type</th>
                    <th class="py-2 px-4 border-b">Total Amount</th>
                    <th class="py-2 px-4 border-b">Payment Method</th>
                    <th class="py-2 px-4 border-b">Transaction Date</th>
                    <th class="py-2 px-4 border-b">Status</th> <!-- Kolom Status -->
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($payments as $payment)
                    <tr>
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $payment->trainee->name }}</td>
                        <td class="py-2 px-4">
                            Payable Type: {{ $payment->payable_type }} <!-- Debug tipe payable -->
                            Payable ID: {{ $payment->payable_id }} <!-- Debug ID payable -->
                            {{-- @if ($payment->payable)
                                {{ get_class($payment->payable) }}
                                @if ($payment->payable instanceof \App\Models\OrderPost)
                                    Post
                                @elseif ($payment->payable instanceof \App\Models\OrderEvent)
                                    Event
                                @else
                                    Unknown
                                @endif --}}
                            {{-- @else --}}
                                {{-- No Payable Found --}}
                            {{-- @endif --}}
                        </td>
                        <td class="py-2 px-4">{{ $payment->total_amount }}</td>
                        <td class="py-2 px-4">{{ $payment->paymentMethod->method_name }}</td>
                        <td class="py-2 px-4">{{ $payment->transaction_date }}</td>
                        <td class="py-2 px-4">{{ ucfirst($payment->status) }}</td> <!-- Menampilkan status -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            @if ($payments instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $payments->links() }}
            @endif
        </div>
    </div>
@endsection
