<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\OrderEvent;
use App\Models\PaymentMethod;
use App\Models\Event;

class OrderEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua metode pembayaran yang tersedia
        $paymentMethods = PaymentMethod::all();

        // Ambil semua peserta (participant) yang sudah terdaftar di event
        $participants = Participant::all();

        // Loop melalui setiap participant
        foreach ($participants as $participant) {
            // Dapatkan event yang diikuti oleh participant ini
            $event = Event::find($participant->event_id);

            // Jika event ditemukan, buat order
            if ($event) {
                // Pilih metode pembayaran secara acak
                $paymentMethod = $paymentMethods->random();

                // Buat order event untuk setiap peserta
                OrderEvent::create([
                    'trainee_id' => $participant->trainee_id,
                    'participant_id' => $participant->id,
                    'payment_method_id' => $paymentMethod->id,
                    'total_amount' => $event->price, // Total amount berdasarkan harga event
                    'status' => 'pending', // Set status sebagai pending
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
