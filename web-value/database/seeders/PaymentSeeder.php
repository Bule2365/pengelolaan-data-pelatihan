<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'method_name' => 'BCA',
                'no' => '082183798'
            ],
            [
                'method_name' => 'Dana',
                'no' => '072319827'
            ]
        ]);
    }
}
