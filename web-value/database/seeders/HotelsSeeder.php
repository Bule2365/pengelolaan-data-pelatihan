<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->insert([
            [
                'name' => 'Jakarta Hotels',
                'phone' => '0812923724872',
                'location' => 'Jakarta Barat'
            ],
            [
                'name' => 'Bandung Hotels',
                'phone' => '0829318928931',
                'location' => 'Bandung'
            ],
            [
                'name' => 'Java Hotels',
                'phone' => '0821788238728',
                'location' => 'Jakarta Selatan'
            ],
            [
                'name' => 'Jogoja Hotels',
                'phone' => '0812837218209',
                'location' => 'Yogyakarta'
            ],
            [
                'name' => 'Gedung DPRD Depok',
                'phone' => '082132918273',
                'location' => 'Depok'
            ],
            [
                'name' => 'Mampang City Hotels',
                'phone' => '0821783612781',
                'location' => 'Kota Depok'
            ],
            [
                'name' => 'The Ritz-Carlton Jakarta',
                'phone' => '02130019888',
                'location' => 'Jakarta Selatan'
            ],
            [
                'name' => 'Grand Hyatt Jakarta',
                'phone' => '02129928888',
                'location' => 'Jakarta Pusat'
            ],
            [
                'name' => 'Hotel Mulia Senayan',
                'phone' => '0215743338',
                'location' => 'Jakarta Selatan'
            ],
            [
                'name' => 'Hotel Borobudur Jakarta',
                'phone' => '0213805555',
                'location' => 'Jakarta Pusat'
            ],
            [
                'name' => 'Pullman Bandung Grand Central',
                'phone' => '0228882020',
                'location' => 'Bandung'
            ],
            [
                'name' => 'Sheraton Bandung Hotel & Towers',
                'phone' => '0222506000',
                'location' => 'Bandung'
            ],
            [
                'name' => 'The Trans Luxury Hotel Bandung',
                'phone' => '0228730888',
                'location' => 'Bandung'
            ],
            [
                'name' => 'Hotel Tentrem Yogyakarta',
                'phone' => '0274478888',
                'location' => 'Yogyakarta'
            ],
            [
                'name' => 'Hyatt Regency Yogyakarta',
                'phone' => '0274484888',
                'location' => 'Yogyakarta'
            ],
            [
                'name' => 'The Phoenix Hotel Yogyakarta',
                'phone' => '0274417181',
                'location' => 'Yogyakarta'
            ],
            [
                'name' => 'Aston Pasteur Hotel Bandung',
                'phone' => '0222030920',
                'location' => 'Bandung'
            ],
            [
                'name' => 'Holiday Inn Express Jakarta Thamrin',
                'phone' => '02131903900',
                'location' => 'Jakarta Pusat'
            ],
            [
                'name' => 'Novotel Jakarta Mangga Dua Square',
                'phone' => '0216266666',
                'location' => 'Jakarta Utara'
            ],
            [
                'name' => 'Alila Villas Uluwatu Bali',
                'phone' => '0361900999',
                'location' => 'Bali'
            ],
            [
                'name' => 'The St. Regis Bali Resort',
                'phone' => '0361738188',
                'location' => 'Bali'
            ],
            [
                'name' => 'Grand Mirage Resort & Thalasso Bali',
                'phone' => '0361947800',
                'location' => 'Bali'
            ],
            [
                'name' => 'Aston Bali Beach Resort & Spa',
                'phone' => '0361967999',
                'location' => 'Bali'
            ],
            [
                'name' => 'Hotel Aryaduta Jakarta',
                'phone' => '02129662100',
                'location' => 'Jakarta Pusat'
            ],
            [
                'name' => 'Grand Sahid Jaya Hotel',
                'phone' => '0215709000',
                'location' => 'Jakarta Pusat'
            ],
            [
                'name' => 'The Westin Resort Nusa Dua Bali',
                'phone' => '0361719111',
                'location' => 'Bali'
            ],
            [
                'name' => 'InterContinental Jakarta MidPlaza',
                'phone' => '0212510888',
                'location' => 'Jakarta Pusat'
            ],
            [
                'name' => 'Hotel Santika Premiere Slipi Jakarta',
                'phone' => '0215366000',
                'location' => 'Jakarta Barat'
            ],
            [
                'name' => 'The Hermitage, a Tribute Portfolio Hotel',
                'phone' => '02131921388',
                'location' => 'Jakarta Pusat'
            ],
            [
                'name' => 'Pullman Ciawi Vimala Hills Resort',
                'phone' => '0251822020',
                'location' => 'Bogor'
            ],
            [
                'name' => 'Novotel Bogor Golf Resort & Convention Center',
                'phone' => '0251804050',
                'location' => 'Bogor'
            ],
            [
                'name' => 'Radisson Blu Bali Uluwatu',
                'phone' => '0361921000',
                'location' => 'Bali'
            ],
            [
                'name' => 'Fairmont Jakarta',
                'phone' => '02129703333',
                'location' => 'Jakarta Selatan'
            ],
            [
                'name' => 'Swiss-Belhotel Pondok Indah',
                'phone' => '02175910088',
                'location' => 'Jakarta Selatan'
            ],
            [
                'name' => 'Harris Hotel & Conventions Malang',
                'phone' => '0341457555',
                'location' => 'Malang'
            ],
            [
                'name' => 'G Hotel Gurney',
                'phone' => '+604 238 0000',
                'location' => 'Penang, Malaysia'
            ],
            [
                'name' => 'Grand Hyatt Kuala Lumpur',
                'phone' => '+603 2182 1234',
                'location' => 'Kuala Lumpur, Malaysia'
            ],
            [
                'name' => 'Hotel Majestic Kuala Lumpur',
                'phone' => '+603 2785 8000',
                'location' => 'Kuala Lumpur, Malaysia'
            ],
            [
                'name' => 'Shangri-La Hotel Singapore',
                'phone' => '+65 6737 3644',
                'location' => 'Singapore'
            ],
            [
                'name' => 'Marina Bay Sands',
                'phone' => '+65 6688 8888',
                'location' => 'Singapore'
            ],
            [
                'name' => 'Raffles Hotel Singapore',
                'phone' => '+65 6337 1886',
                'location' => 'Singapore'
            ],
            [
                'name' => 'Conrad Bali',
                'phone' => '0361706666',
                'location' => 'Bali'
            ],
            [
                'name' => 'The Legian Bali',
                'phone' => '0361735800',
                'location' => 'Bali'
            ],
            [
                'name' => 'W Bali - Seminyak',
                'phone' => '0361738399',
                'location' => 'Bali'
            ],
            [
                'name' => 'Six Senses Uluwatu Bali',
                'phone' => '0361955500',
                'location' => 'Bali'
            ],
            [
                'name' => 'InterContinental Bali Resort',
                'phone' => '0361711000',
                'location' => 'Bali'
            ],
            [
                'name' => 'The Stones Hotel - Legian Bali',
                'phone' => '0361735123',
                'location' => 'Bali'
            ],
            [
                'name' => 'Puri Santrian Bali',
                'phone' => '0361287777',
                'location' => 'Bali'
            ],
            [
                'name' => 'Anantara Uluwatu Bali Resort',
                'phone' => '0361955000',
                'location' => 'Bali'
            ],
            [
                'name' => 'The Royal Purnama Bali',
                'phone' => '0361956999',
                'location' => 'Bali'
            ],
            [
                'name' => 'The Seminyak Beach Resort & Spa',
                'phone' => '0361738939',
                'location' => 'Bali'
            ],
        ]);
    }
}
