<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $hotelIds = range(1, 51); // ID hotel yang tersedia, dari 1 hingga 51

        DB::table('schedule_trainings')->insert([
            [
                'data_price_id' => 1, // ID dari data_prices
                'trainer_id' => 1,   // ID dari trainers
                'training_material_id' => 1, // ID dari training_materials
                'schedule_date' => Carbon::parse('2024-10-01'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 2,
                'trainer_id' => 2,
                'training_material_id' => 2,
                'schedule_date' => Carbon::parse('2024-10-05'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 3,
                'trainer_id' => 3,
                'training_material_id' => 3,
                'schedule_date' => Carbon::parse('2024-10-10'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 4,
                'trainer_id' => 4,
                'training_material_id' => 4,
                'schedule_date' => Carbon::parse('2024-10-15'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 5,
                'trainer_id' => 5,
                'training_material_id' => 5,
                'schedule_date' => Carbon::parse('2024-10-20'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 6,
                'trainer_id' => 6,
                'training_material_id' => 6,
                'schedule_date' => Carbon::parse('2024-10-25'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 7,
                'trainer_id' => 7,
                'training_material_id' => 7,
                'schedule_date' => Carbon::parse('2024-11-01'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 8,
                'trainer_id' => 8,
                'training_material_id' => 8,
                'schedule_date' => Carbon::parse('2024-11-05'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 9,
                'trainer_id' => 9,
                'training_material_id' => 9,
                'schedule_date' => Carbon::parse('2024-11-10'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 1, // ID dari data_prices
                'trainer_id' => 1,   // ID dari trainers
                'training_material_id' => 1, // ID dari training_materials
                'schedule_date' => Carbon::parse('2024-10-01'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 2,
                'trainer_id' => 2,
                'training_material_id' => 2,
                'schedule_date' => Carbon::parse('2024-10-05'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 3,
                'trainer_id' => 3,
                'training_material_id' => 3,
                'schedule_date' => Carbon::parse('2024-10-10'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 4,
                'trainer_id' => 4,
                'training_material_id' => 4,
                'schedule_date' => Carbon::parse('2024-10-15'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 5,
                'trainer_id' => 5,
                'training_material_id' => 5,
                'schedule_date' => Carbon::parse('2024-10-20'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 6,
                'trainer_id' => 6,
                'training_material_id' => 6,
                'schedule_date' => Carbon::parse('2024-10-25'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 7,
                'trainer_id' => 7,
                'training_material_id' => 7,
                'schedule_date' => Carbon::parse('2024-11-01'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 8,
                'trainer_id' => 8,
                'training_material_id' => 8,
                'schedule_date' => Carbon::parse('2024-11-05'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 9,
                'trainer_id' => 9,
                'training_material_id' => 9,
                'schedule_date' => Carbon::parse('2024-11-10'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 1, // ID dari data_prices
                'trainer_id' => 1,   // ID dari trainers
                'training_material_id' => 1, // ID dari training_materials
                'schedule_date' => Carbon::parse('2024-10-01'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 2,
                'trainer_id' => 2,
                'training_material_id' => 2,
                'schedule_date' => Carbon::parse('2024-10-05'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 3,
                'trainer_id' => 3,
                'training_material_id' => 3,
                'schedule_date' => Carbon::parse('2024-10-10'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 4,
                'trainer_id' => 4,
                'training_material_id' => 4,
                'schedule_date' => Carbon::parse('2024-10-15'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 5,
                'trainer_id' => 5,
                'training_material_id' => 5,
                'schedule_date' => Carbon::parse('2024-10-20'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 6,
                'trainer_id' => 6,
                'training_material_id' => 6,
                'schedule_date' => Carbon::parse('2024-10-25'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 7,
                'trainer_id' => 7,
                'training_material_id' => 7,
                'schedule_date' => Carbon::parse('2024-11-01'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 8,
                'trainer_id' => 8,
                'training_material_id' => 8,
                'schedule_date' => Carbon::parse('2024-11-05'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
            [
                'data_price_id' => 9,
                'trainer_id' => 9,
                'training_material_id' => 9,
                'schedule_date' => Carbon::parse('2024-11-10'),
                'hotel_id' => $this->getRandomHotelId($hotelIds),
            ],
        ]);
    }

    private function getRandomHotelId($hotelIds)
    {
        // Mengembalikan ID hotel secara acak dari array $hotelIds
        return $hotelIds[array_rand($hotelIds)];
    }
}
