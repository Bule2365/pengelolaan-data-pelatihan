<?php

namespace Database\Seeders;

use App\Models\OrderPost;
use App\Models\OrderEvent;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PaymentOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua data dari order_posts
        $orderPosts = OrderPost::all();

        // Ambil semua data dari order_events
        $orderEvents = OrderEvent::all();

        // Jalankan dalam transaksi database
        DB::transaction(function () use ($orderPosts, $orderEvents, $faker) {
            // Loop untuk order_posts dan pindahkan data ke tabel payments
            foreach ($orderPosts as $orderPost) {
                // Insert atau update data ke tabel payments
                Payment::updateOrCreate(
                    [
                        'payable_id' => $orderPost->id,
                        'payable_type' => OrderPost::class,
                    ],
                    [
                        'trainee_id' => $orderPost->trainee_id,
                        'payment_method_id' => $orderPost->payment_method_id,
                        'total_amount' => $orderPost->total_amount,
                        'transaction_date' => $faker->dateTimeBetween('-1 year', 'now'),
                        'status' => $faker->randomElement(['completed', 'canceled']),
                    ]
                );

                // Hapus data dari order_posts setelah dipindahkan
                $orderPost->delete();
            }

            // Loop untuk order_events dan pindahkan data ke tabel payments
            foreach ($orderEvents as $orderEvent) {
                // Insert atau update data ke tabel payments
                Payment::updateOrCreate(
                    [
                        'payable_id' => $orderEvent->id,
                        'payable_type' => OrderEvent::class,
                    ],
                    [
                        'trainee_id' => $orderEvent->trainee_id,
                        'payment_method_id' => $orderEvent->payment_method_id,
                        'total_amount' => $orderEvent->total_amount,
                        'transaction_date' => $faker->dateTimeBetween('-1 year', 'now'),
                        'status' => $faker->randomElement(['completed', 'canceled']),
                    ]
                );

                // Hapus data dari order_events setelah dipindahkan
                $orderEvent->delete();
            }
        });
    }
}
