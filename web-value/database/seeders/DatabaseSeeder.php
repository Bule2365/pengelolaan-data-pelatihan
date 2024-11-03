<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            TraineeSeeder::class,
            TrainerSeeder::class,
            PaymentSeeder::class,
            TypeTrainingSeeder::class,
            EvaluationItemsSeeder::class,
            CategoriesPostSeeder::class,
            HotelsSeeder::class,
            DataPriceSeeder::class,
            MaterialSeeder::class,
            // ScheduleSeeder::class,
            // PostSeeder::class,
            // EventSeeder::class
            // TrainingSeeder::class,
            // ParticipantSeeder::class,
            // OrderEventSeeder::class,
            // OrderPostSeeder::class,
            // CertificateSeeder::class,
            // PaymentOrderSeeder::class,
        ]);        
    }
}
