<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\OrderPost;
use App\Models\Participant;
use App\Models\OrderEvent;
use App\Models\Payment;
use DB;
use App\Models\Training;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Admin Functions
    public function indexPostOrders()
    {
        $orders = OrderPost::with('trainee', 'training.post', 'paymentMethod')
            ->where('status', 'pending')
            ->paginate(10); // Menampilkan 10 data per halaman
    
        return view('admin.transaction.index_post', compact('orders'));
    }

    public function updatePostOrderStatus($orderId, Request $request)
    {
        $order = OrderPost::findOrFail($orderId);
        
        $request->validate([
            'status' => 'required|in:pending,completed,canceled',
        ]);

        // Cek jika status masih 'pending' dan user mencoba untuk mengubahnya
        if ($order->status == 'pending' && $request->status != 'pending') {
            // Perbolehkan update status dari 'pending' ke yang lain
            $order->update(['status' => $request->status]);

            // Update atau buat entri pembayaran
            Payment::updateOrCreate(
                [
                    'payable_id' => $order->id,
                    'payable_type' => OrderPost::class,
                ],
                [
                    'trainee_id' => $order->trainee_id,
                    'payment_method_id' => $order->payment_method_id,
                    'total_amount' => $order->total_amount,
                    'transaction_date' => now(),
                    'status' => $request->status // Simpan status transaksi
                ]
            );

            return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
        } 

        // Jika status masih pending, tolak update
        return back()->withErrors(['error' => 'Order masih pending, tidak dapat diupdate.']);
    }

    public function indexEventOrders()
    {
        $orders = OrderEvent::with('trainee', 'participant.event')
            ->where('status', 'pending')
            ->paginate(10); // Menampilkan 10 data per halaman
    
        return view('admin.transaction.index_event', compact('orders'));
    }

    public function updateEventOrderStatus($orderId, Request $request)
    {
        $order = OrderEvent::findOrFail($orderId);
        
        // Validasi input status
        $request->validate([
            'status' => 'required|in:pending,completed,canceled',
        ]);

        // Cek jika status masih 'pending' dan user mencoba untuk mengubahnya
        if ($order->status == 'pending' && $request->status != 'pending') {
            // Perbolehkan update status dari 'pending' ke yang lain
            $order->update(['status' => $request->status]);

            // Update atau buat entri pembayaran
            Payment::updateOrCreate(
                [
                    'payable_id' => $order->id,
                    'payable_type' => OrderEvent::class,
                ],
                [
                    'trainee_id' => $order->trainee_id,
                    'payment_method_id' => $order->payment_method_id,
                    'total_amount' => $order->total_amount,
                    'transaction_date' => now(),
                    'status' => $request->status // Simpan status transaksi
                ]
            );

            return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
        } 

        // Jika status masih pending, tolak update
        return back()->withErrors(['error' => 'Order masih pending, tidak dapat diupdate.']);
    }

    public function indexAllPayments(Request $request)
    {
        // Ambil query pencarian dan rentang tanggal dari input user
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Mengubah format tanggal untuk mencakup seluruh hari
        $startDate = $startDate ? \Carbon\Carbon::parse($startDate)->startOfDay() : null;
        $endDate = $endDate ? \Carbon\Carbon::parse($endDate)->endOfDay() : null;

        // Query untuk mendapatkan semua pembayaran dengan pencarian dan rentang tanggal
        $query = Payment::with(['payable', 'paymentMethod', 'trainee'])
            ->when($search, function ($query, $search) {
                $query->whereHas('trainee', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('transaction_date', [$startDate, $endDate]);
            });

        // Cek apakah ada pencarian, jika tidak, paginasi 100 data per halaman
        if ($search || ($startDate && $endDate)) {
            $payments = $query->get(); // Ambil semua data
        } else {
            $payments = $query->paginate(100); // Ambil data dengan pagination
        }

        // Return ke view dengan data payments dan input search
        return view('admin.transaction.index_all_payments', compact('payments', 'search', 'startDate', 'endDate'));
    }

    // List all payment methods
    public function indexPayment()
    {
        $methods = PaymentMethod::all();
        return view('admin.transaction.index', compact('methods'));
    }

    // Show form to create a new payment method
    public function createPayment()
    {
        return view('admin.transaction.create');
    }

    // Store a new payment method
    public function storePayment(Request $request)
    {
        $validated = $request->validate([
            'method_name' => 'required|string|max:255',
            'no' => 'required|numeric|max:10', // Validasi sebagai angka
        ], [
            'no.max' => 'The No field may not be greater than :max characters.',
        ]);

        PaymentMethod::create($validated);

        return redirect()->route('admin.payment.index')->with('success', 'Metode Pembayaran berhasil ditambahkan');
    }

    // Delete a payment method
    public function deletePayment($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->delete();

        return redirect()->route('admin.payment.index')->with('success', 'Metode Pembayaran berhasil dihapus.');
    }

        // Menampilkan daftar pelatihan yang diikuti dan form pembayaran
        public function index()
        {
            $traineeId = auth()->user()->id;
            $trainings = Training::with('post.dataPrice')->where('trainee_id', $traineeId)->get();
    
            return view('trainee.orders.index', compact('trainings'));
        }
    
    // Menampilkan form pembayaran untuk pelatihan tertentu
    public function showPaymentForm($trainingId)
    {
        // Cari order berdasarkan pelatihan dan trainee
        $order = OrderPost::where('training_id', $trainingId)
                        ->where('trainee_id', auth()->user()->id)
                        ->first();

        // Jika order tidak ditemukan, kembalikan error (harusnya tidak terjadi jika logika register berjalan benar)
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Ambil semua metode pembayaran yang tersedia
        $paymentMethods = PaymentMethod::all();

        return view('trainee.orders.payment', compact('order', 'paymentMethods'));
    }
    
    // Menyimpan pembayaran
    public function storePaymentPost(Request $request, $trainingId)
    {
        // Validasi input pembayaran
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        // Ambil data pelatihan terkait
        $training = Training::with('post.dataPrice')->findOrFail($trainingId);

        // Ambil harga dari pelatihan
        $price = $training->post->dataPrice->price;

        // Pastikan trainee melakukan pembayaran dengan jumlah yang sesuai
        if ($request->total_amount != $price) {
            return redirect()->back()->with('error', 'The payment amount is incorrect.');
        }

        // Update order yang ada dengan metode pembayaran dan jumlah pembayaran
        $order = OrderPost::where('training_id', $trainingId)
                        ->where('trainee_id', auth()->user()->id)
                        ->first();

        // Update order
        $order->update([
            'payment_method_id' => $request->payment_method_id,
            'total_amount' => $request->total_amount,
            'status' => 'pending',  // atau 'processing' tergantung logika bisnis Anda
        ]);

        return redirect()->route('trainee.orders.index')->with('success', 'Payment successful. Your order is now pending.');
    }

    // Menampilkan form pembayaran untuk event
    public function createPaymentEvent($participantId)
    {
        // Ambil participant dengan event terkait, pastikan participant milik trainee yang login
        $participant = Participant::with(['event', 'orderEvent'])
                      ->where('id', $participantId)
                      ->where('trainee_id', auth()->user()->id)
                      ->first();
    
        // Jika participant tidak ditemukan atau tidak milik trainee yang login, kembalikan error
        if (!$participant) {
            return redirect()->back()->with('error', 'Unauthorized access or participant not found.');
        }
    
        // Cek apakah orderEvent sudah ada
        $orderEvent = $participant->orderEvent ?: $participant->orderEvent()->create([
            'trainee_id' => auth()->user()->id,
            'participant_id' => $participant->id,
            'total_amount' => $participant->event->price,
            'status' => 'pending', // Status default pending
        ]);
    
        // Ambil metode pembayaran yang tersedia
        $paymentMethods = PaymentMethod::all();
    
        return view('trainee.orders.create', compact('orderEvent', 'participant', 'paymentMethods'));
    }
    
    public function storePaymentEvent(Request $request, $participantId)
    {
        // Validasi input pembayaran
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);
    
        // Mulai transaksi untuk memastikan konsistensi data
        DB::transaction(function () use ($request, $participantId) {
            // Cari peserta event dan pastikan participant milik trainee yang login
            $participant = Participant::with('orderEvent')
                                      ->where('id', $participantId)
                                      ->where('trainee_id', auth()->user()->id)
                                      ->first();
    
            // Jika participant atau orderEvent tidak ditemukan, beri pesan error
            if (!$participant || !$participant->orderEvent) {
                return redirect()->back()->with('error', 'Unauthorized access or order not found.');
            }
    
            // Update order event
            $participant->orderEvent->update([
                'payment_method_id' => $request->payment_method_id,
                'total_amount' => $request->total_amount,
                'status' => 'pending', // Tetap pending hingga diverifikasi admin
            ]);
        });
    
        return redirect()->route('trainee.my-events')->with('success', 'Payment successful. Status is still pending for verification.');
    }    
}
