<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $trainees = \App\Models\Trainee::pluck('id')->toArray(); // Mendapatkan semua ID trainee
        $certificateImages = [
            '1724639556.png',
            '1724642498.png',
            '1726309372.png',
            '1726314311.png',
            '1726470734.png',
            '1726546331.png',
            '1726555264.png'
        ];

        foreach ($trainees as $traineeId) {
            $numberOfCertificates = $faker->numberBetween(2, 3); // 2 hingga 3 sertifikat per trainee

            for ($i = 0; $i < $numberOfCertificates; $i++) {
                DB::table('certificate_trainees')->insert([
                    'issue_date' => $faker->dateTimeBetween('2015-01-01', '2024-12-31')->format('Y-m-d'),
                    'trainee_id' => $traineeId,
                    'certificate_image' => $faker->randomElement($certificateImages), // Update path image jika perlu
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
