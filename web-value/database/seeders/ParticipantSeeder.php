<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $traineeIds = \App\Models\Trainee::pluck('id')->toArray(); // Mendapatkan semua ID trainee
        $eventIds = \App\Models\Event::pluck('id')->toArray(); // Mendapatkan semua ID event

        foreach ($eventIds as $eventId) {
            $numberOfParticipants = $faker->numberBetween(8, 20); // Jumlah peserta acak per event

            // Pilih peserta acak
            $participants = $faker->randomElements($traineeIds, $numberOfParticipants);

            foreach ($participants as $traineeId) {
                DB::table('participants')->updateOrInsert([
                    'trainee_id' => $traineeId,
                    'event_id' => $eventId,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
