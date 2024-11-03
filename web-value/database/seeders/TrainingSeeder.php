<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\ScheduleTraining;
use App\Models\Trainee;
use App\Models\Training;
use Faker\Factory as Faker;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua data Post dan Trainee yang sudah ada
        $posts = Post::all();
        $trainees = Trainee::all();

        // Pilih beberapa schedule training secara opsional (jika ada)
        $scheduleTrainings = ScheduleTraining::all();

        // Loop untuk tiap Trainee
        foreach ($trainees as $trainee) {
            // Setiap trainee dapat mendaftar ke beberapa post secara acak
            $postsToRegister = $posts->random($faker->numberBetween(1, 3)); // Setiap trainee akan mendaftar ke 1-3 post

            foreach ($postsToRegister as $post) {
                // Pilih schedule training secara opsional (nullable)
                $scheduleTraining = $scheduleTrainings->random() ?? null;

                // Buat entry dalam tabel trainings
                Training::create([
                    'post_id' => $post->id,
                    'schedule_training_id' => $scheduleTraining ? $scheduleTraining->id : null, // Bisa null jika tidak ada
                    'trainee_id' => $trainee->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
