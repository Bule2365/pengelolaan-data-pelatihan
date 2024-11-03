<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evaluation_items')->insert([
            // Evaluasi Trainer
            [
                'section' => 'Trainer',
                'question' => 'Bagaimana penilaian Anda terhadap pengetahuan trainer mengenai materi pelatihan?',
            ],
            [
                'section' => 'Trainer',
                'question' => 'Seberapa jelas trainer menyampaikan materi pelatihan?',
            ],
            [
                'section' => 'Trainer',
                'question' => 'Bagaimana sikap profesional trainer selama pelatihan?',
            ],
            [
                'section' => 'Trainer',
                'question' => 'Apakah trainer mampu menjawab pertanyaan dan memberikan penjelasan dengan baik?',
            ],
            [
                'section' => 'Trainer',
                'question' => 'Bagaimana penilaian Anda terhadap kemampuan trainer dalam berkomunikasi?',
            ],
            
            // Evaluasi Hotel
            [
                'section' => 'Hotel',
                'question' => 'Bagaimana penilaian Anda terhadap kebersihan hotel?',
            ],
            [
                'section' => 'Hotel',
                'question' => 'Seberapa nyaman fasilitas di hotel selama Anda menginap?',
            ],
            [
                'section' => 'Hotel',
                'question' => 'Bagaimana kualitas pelayanan dari staf hotel?',
            ],
            [
                'section' => 'Hotel',
                'question' => 'Apakah lokasi hotel memadai dan mudah diakses?',
            ],
            [
                'section' => 'Hotel',
                'question' => 'Bagaimana penilaian Anda terhadap fasilitas pendukung seperti Wi-Fi, AC, dll?',
            ],

            // Evaluasi Pelatihan
            [
                'section' => 'Training',
                'question' => 'Seberapa relevan materi pelatihan dengan kebutuhan Anda?',
            ],
            [
                'section' => 'Training',
                'question' => 'Bagaimana penilaian Anda terhadap struktur dan organisasi materi pelatihan?',
            ],
            [
                'section' => 'Training',
                'question' => 'Apakah tujuan pelatihan tercapai dengan baik?',
            ],
            [
                'section' => 'Training',
                'question' => 'Seberapa efektif metode pengajaran yang digunakan dalam pelatihan?',
            ],
            [
                'section' => 'Training',
                'question' => 'Bagaimana kualitas materi dan alat bantu yang digunakan selama pelatihan?',
            ],
            
            // Evaluasi Umum
            [
                'section' => 'General',
                'question' => 'Bagaimana pengalaman keseluruhan Anda dengan pelatihan ini?',
            ],
            [
                'section' => 'General',
                'question' => 'Apakah Anda merasa bahwa pelatihan ini memberikan nilai tambah bagi Anda?',
            ],
            [
                'section' => 'General',
                'question' => 'Seberapa mungkin Anda merekomendasikan pelatihan ini kepada rekan atau kolega?',
            ],
            [
                'section' => 'General',
                'question' => 'Apakah ada saran atau masukan untuk perbaikan pelatihan di masa depan?',
            ],
        ]);
    }
}
