<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypeTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_trainings')->insert([
            [
                'type_name' => 'Online',
            ],
            [
                'type_name' =>'Offline',
            ]
        ]);
    }
}
