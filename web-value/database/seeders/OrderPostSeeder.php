<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderPost;
use App\Models\Training;
use App\Models\PaymentMethod;
use App\Models\Post;
use App\Models\DataPrice;

class OrderPostSeeder extends Seeder
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
        
        // Ambil semua pendaftaran pelatihan (training)
        $trainings = Training::all();

        // Loop melalui setiap pendaftaran training
        foreach ($trainings as $training) {
            // Dapatkan post yang terkait dengan training ini
            $post = Post::find($training->post_id);

            // Jika post ditemukan
            if ($post) {
                // Dapatkan data harga yang terkait dengan post ini
                $dataPrice = DataPrice::find($post->data_price_id);

                // Jika data harga ditemukan
                if ($dataPrice) {
                    // Pilih metode pembayaran secara acak
                    $paymentMethod = $paymentMethods->random();

                    // Buat order post untuk setiap pendaftaran training
                    OrderPost::create([
                        'trainee_id' => $training->trainee_id,
                        'training_id' => $training->id,
                        'payment_method_id' => $paymentMethod->id,
                        'total_amount' => $dataPrice->price, // Total amount berdasarkan harga dari data_price
                        'status' => 'pending', // Set status sebagai pending
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
