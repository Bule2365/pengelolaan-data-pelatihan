@extends('admin.layouts.app-admin-website')

@section('title', 'Tambah Metode Pembayaran')

@section('header', 'Transaksi Event')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <a href="{{ route('admin.payments.index') }}"
            class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar
        </a>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('success'))
            <div id="success-alert" class="fixed inset-0 flex items-center justify-center z-50">
                <div
                    class="bg-green-100 text-green-800 p-4 rounded-lg shadow-lg transition-transform transform duration-300 ease-in-out max-w-md mx-auto w-full relative">
                    <!-- Ikon -->
                    <svg class="w-6 h-6 mr-3 inline-flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <!-- Pesan -->
                    <span class="flex-1">{{ session('success') }}</span>
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

        <table class="mt-6 min-w-full bg-white border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Trainee</th>
                    <th class="border px-4 py-2">Judul Event</th>
                    <th class="border px-4 py-2">Total Amount</th>
                    <th class="border px-4 py-2">Metode Pembayaran</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $order->id }}</td>
                        <td class="border px-4 py-2">{{ $order->trainee->name }}</td>
                        <td class="border px-4 py-2">{{ $order->participant->event->event_title }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>

                        <!-- Cek apakah payment_method ada sebelum mengakses method_name -->
                        <td class="border px-4 py-2">
                            {{ $order->payment_method ? $order->payment_method->method_name : 'Belum dipilih' }}
                        </td>

                        <td class="border px-4 py-2">{{ ucfirst($order->status) }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('admin.order.event.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="mr-2">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled
                                    </option>
                                </select>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
    <script>
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(event) {
                const select = form.querySelector('select[name="status"]');
                if (select.value === 'pending') {
                    event.preventDefault(); // Hentikan pengiriman form
                    alert('Order masih pending, tidak dapat diupdate.');
                }
            });
        });
    </script>
@endsection
