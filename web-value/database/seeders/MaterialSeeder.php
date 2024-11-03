<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        // Daftar nama file materi yang tersedia
        $materials = [
            'Business Writing skill Training.Peserta-1724657926.docx',
            'CV-Daffa-1725244862.docx',
            'Daftar Hadir (4)-1725511127.doc',
            'Daftar Hadir (4)-1725605193.doc',
            'Daftar Hadir (4)-1725612830.doc',
            'Daftar Hadir (4)-1725710270.doc',
            'Daftar Hadir (4)-1725710663.doc',
            'Daftar Hadir (4)-1725710664.doc',
            'Daftar Hadir (4)-1725853474.doc',
            'Daftar Hadir (4)-1725936889.doc',
            'Daftar Hadir (4)-1726033584.doc',
            'Daftar Hadir (5)-1725604622.doc',
            'Daftar Hadir (5)-1725607696.doc',
            'Daftar Hadir (5)-1725706201.doc',
            'Daftar Hadir (5)-1725854916.doc',
            'Daftar Hadir (5)-1725935360.doc',
            'Daftar Hadir (5)-1725943761.doc',
            'Daftar Hadir (5)-1725950878.doc',
            'Daftar Hadir (5)-1726028718.doc',
            'Daftar Hadir (5)-1726143538.doc',
            'Daftar Hadir (5)-1726194914.doc',
            'Daftar Hadir (5)-1726196819.doc',
            'Daftar Hadir (5)-1726209933.doc',
            'Daftar Hadir (5)-1726213597.doc',
            'Daftar Hadir (5)-1726316818.doc',
            'Daftar Hadir (5)-1726543645.doc',
            'Daftar Hadir (6)-1726214594.doc',
            'Database Peserta-1724899764.doc',
            'Database Peserta-1724899799.doc',
            'Database Peserta-1724899835.doc',
            'Database Peserta-1724986150.doc',
            'Database Peserta-1725246344.doc',
            'Database Peserta-1725349380.doc',
            'Database Peserta-1725416611.doc',
            'Database Peserta-1725422722.doc',
            'Database Peserta-1725431433.doc',
            'Database Peserta-1725852479.doc',
            'Database Peserta-1725852664.doc',
            'Database Peserta-1725936900.doc',
            'DVjC0kBfUj0Hb2hbCgyJJF3WjnqaCWjzXcbd6duB.docx',
            'qz94Sk54B0tcH86Xvtwtiut7EypdZoX87AcJE3D3.docx',
            'resume_bule-1725246414.docx',
            'table dan record-1724986424.docx',
            'table dan record-1725246392.docx',
            'table dan record-1725422701.docx',
            'table dan record-1725434798.docx',
            'table dan record-1725438822.docx',
            'table dan record-1725852857.docx',
            'table dan record-1725935388.docx',
            'table dan record-1725950901.docx',
        ];

        // Ambil semua trainer
        $trainers = \App\Models\Trainer::all();

        foreach ($trainers as $trainer) {
            // Pilih antara 2 hingga 5 materi secara acak
            $numberOfMaterials = rand(2, 5);
            $selectedMaterials = Arr::random($materials, $numberOfMaterials);

            foreach ($selectedMaterials as $materialFile) {
                DB::table('training_materials')->insert([
                    'data_price_id' => rand(1, 25), // Atur dengan ID yang sesuai jika diperlukan
                    'trainer_id' => $trainer->id,
                    'material_file' => 'training_materials/' . $materialFile,
                ]);
            }
        }
    }
}
