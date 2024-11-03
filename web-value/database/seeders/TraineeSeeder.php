<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TraineeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat instance Faker
        $faker = Faker::create();

        // Buat array untuk menampung data trainees
        $trainees = [];

        // Generate 500 trainees
        for ($i = 0; $i < 257; $i++) {
            $trainees[] = [
                'email' => $faker->unique()->safeEmail,
                'name' => $faker->name,
                'personal_phone' => $faker->phoneNumber,
                'company' => $faker->company,
                'company_phone' => $faker->phoneNumber,
                'company_address' => $faker->address,
                'job_title' => $faker->jobTitle,
                'gender' => $faker->randomElement(['male', 'female']),
                'password' => Hash::make('password'), // Password default
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Sisipkan data ke tabel 'trainees'
        DB::table('trainees')->insert($trainees);
    }
}