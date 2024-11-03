<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('posts')->insert([
    //         [
    //             'trainer_id' => 1,  // Sesuaikan dengan ID trainer yang valid
    //             'data_price_id' => 2,  // Sesuaikan dengan ID data_price yang valid
    //             'description' => 'Pelatihan web developer yang mencakup semua aspek penting dari pemrograman web modern.',
    //             'image' => 'images/0ENIB047yOLuMEjaE0g4Jpeaai5cjjzAn1mDqjMd.png',
    //             'schedule_id' => 1,  // Sesuaikan dengan ID schedule yang valid
    //             'categories_post_id' => 1,  // Sesuaikan dengan ID categories_post yang valid
    //             'post_date' => now(),
    //             'status' => 'active',
    //         ],
    //         [
    //             'trainer_id' => 2,  // Sesuaikan dengan ID trainer yang valid
    //             'data_price_id' => 5,  // Sesuaikan dengan ID data_price yang valid
    //             'description' => 'Pelatihan digital marketing untuk membantu Anda memahami strategi pemasaran online yang efektif.',
    //             'image' => 'images/3xK2B2umtrvDtWMG5dD36X05epfcPX31L6Dco9o8.png',
    //             'schedule_id' => 2,  // Sesuaikan dengan ID schedule yang valid
    //             'categories_post_id' => 3,  // Sesuaikan dengan ID categories_post yang valid
    //             'post_date' => now(),
    //             'status' => 'active',
    //         ],
    //         [
    //             'trainer_id' => 3,  // Sesuaikan dengan ID trainer yang valid
    //             'data_price_id' => 8,  // Sesuaikan dengan ID data_price yang valid
    //             'description' => 'Pelatihan soft skills untuk meningkatkan keterampilan interpersonal dan komunikasi.',
    //             'image' => 'images/6pEtKA8Ylwo2DeY2sEDdgjkYHkogqKCLhvcZ7WLK.png',
    //             'schedule_id' => 3,  // Sesuaikan dengan ID schedule yang valid
    //             'categories_post_id' => 4,  // Sesuaikan dengan ID categories_post yang valid
    //             'post_date' => now(),
    //             'status' => 'inactive',
    //         ],
    //     ]);
    // }

    public function run()
    {
        $trainerIds = DB::table('trainers')->pluck('id')->toArray(); // Ambil ID trainer dari database
        $dataPriceIds = DB::table('data_prices')->pluck('id')->toArray(); // Ambil ID data_price dari database
        $categoryPostIds = DB::table('categories_posts')->pluck('id')->toArray(); // Ambil ID categories_post dari database
        $scheduleIds = DB::table('schedule_trainings')->pluck('id')->toArray(); // Ambil ID schedule dari database

        // Validasi untuk menghindari error jika ID kosong
        if (empty($trainerIds) || empty($dataPriceIds) || empty($categoryPostIds) || empty($scheduleIds)) {
            throw new \Exception('Data referensi tidak ditemukan. Pastikan tabel referensi sudah diisi.');
        }

        $imageFiles = [
            '0ENIB047yOLuMEjaE0g4Jpeaai5cjjzAn1mDqjMd.png',
            '3xK2B2umtrvDtWMG5dD36X05epfcPX31L6Dco9o8.png',
            '6pEtKA8Ylwo2DeY2sEDdgjkYHkogqKCLhvcZ7WLK.png',
            '8rJ2YeoTfibaODP7G8OK4HSuB34ZiQIQrhZqVzQh.png',
            '9kVLElNfgmQSgVfSLAEfM6bxjdDC2q4fRxnzaozR.png',
            '77nWzCrSwTI8nrJEdB0yV3Po7zlSNTyuZymZV1O3.png',
            'a3y3Dv8UJJNpndw0Bhe8HIlVAyqnrWeuQ7C6lETb.png',
            'A4YXE7wl6GuOECvDoVCpQ9mohAKLlbimXWrEQCpX.png',
            'AGBmFsxPrDN8Pbqzs8YRZX3yrH627IDx5Vu520G0.png',
            'Am9FA49YwgCBLIKNbywwTreHHtURZmRhWjMGWt4F.png',
            'AzR8j7W6s61ziKjDtNNydtFahyUlSXRhFx9fR5HO.png',
            'BbuhgLcViNj8yfPLsVDfjtHMVv8Mmjc43NiQJMSy.png',
            'BO3paHU9km67vsMHxhWkIyUPUFvYbDNyCGVzFXFV.png',
            'buLzaKvhBuhQJeGtHtCjdMbsfoTHbzXBB8dyu3sx.png',
            'DxOcZbCAm9nj9bn3ccvZuQAZTGEGkJNd65ZFIfna.png',
            'FdN3UkvyjMyKiD9Hl3imAlsjaVRGx32kUiQlt7Bb.png',
            'G6IxwHhEFlnZRja1BeErJ7OUqkQ0F8rmwpsgHnbI.png',
            'h0vt6xLxuOCBanwCElnF7oRhwtwo7xLsHRD7b4Sq.png',
            'HVe3iqRNMmyaR8o5RETzU0ycWKeUwr1r8BVNA3Gp.png',
            'IDxCWUp6PuffHNWRpegUtTJlYNnyPX8Lgz2DS6pc.png',
            'ja6p5YZmcOiyynXmFEb4cIyVtsNFDzNtPjmtVhoB.png',
            'JWxEzVNkEoktGAUX0Mde1qnP9dPxv8iOrPAzkCJk.png',
            'JXMZ71DfeFjFavzGhGZKJq2Ok2OX1J4qJGA4SwCe.png',
            'kW4mZvLvqiceCQBO3xPfc4KGVRxliPHPRynCJNsr.png',
            'lIX3P2dxiTy5ylwNJbfmIMXzoXPOqFq9dAx0nQ59.png',
            'Lu06ibRMfsNI9mFfYC50QqbrgO9VeKC4hv9qz2F1.png',
            'MjILF51dkwjlRxE8jEHhOvXHC8zArfDlvMlhTzqi.png',
            'mk3lVzCcbKh7Ke7Ol1kYk7yS65txR6ryzqJYD4FV.png',
            'Mksq31ut3aSEit28utabFliIhQOmYvwhCDknLQVH.png',
            'msPRJgWfvYxr76aHwFufNQZwRktUd8Rwm7YjuSBN.png',
            'OZFxgbNKRRiJZmD3ZnoM6qJAE9VXDZ7ANnmnpmkw.png',
            'P8oYaxmloPvIBwnngnh5AHzTzrnMZLt8fqF0fUM8.png',
            'Pw6OLJyouVnl0fSiQvSOZKtoalZjtlsWc4ULoUsR.png',
            'qERiGlEwRZ0YKaWNKasgD0cAWrXTBkrTVjYSyf4F.png',
            'R7817jdR7JHScPnWNxWAIR5zvApk9Gg4Rfcxr8yQ.png',
            'Rn0EGrExvKwJRem8x9ge70LTUDOkIuzMxPze1Z8Q.png',
            'RTDKOOX8SSl5CfR3anHOwFqs3lf8oW9VTwprUFZt.png',
            'S9YgZIyhcqihpe5GyQwJjAVIFgPxIvE4Dx5brDtf.png',
            'tGAx2kNwBgViPdSTINZABZxeWt1o0NenbVq8TIZd.png',
            'thejBAaNVxXTh1araozNxFBrf3XT151W21wpR0j6.png',
            'u4k4uyCNSdUTD6tOBmXDmqEvrAOlDAeL6qoApY1G.png',
            'u8MwTlVAhGb7ayNLgB0KRZUnf3qlqhe9kTVW9W4W.png',
            'wvTR6EEX12lH4lt04OWFbHqrmOgCAdzJw3fEwB6x.png',
            'XIHRRyNiSynTDWTEl7gUzAJfpfmHwqGZRATNHfpz.png',
            'xIoEG3JhoNTiQ0iadFERiNZA5AalkfsTkiEz3ZV5.png',
            'xmV0KoXikmxvAqhTqDXafNwQhnPzPciZ99ol7mVQ.png',
            'xRCA3sTGHnYWR5FeipjiA1ekAkmjbKoXw3qXtjpE.png',
            'yAniwqTDqEmAj9UuhiSvdBHldmbrsI6tSvtUe5jy.png',
            'YEutbKryhGodh6G7rwFa2fZPCRzLoCsRggDCxJWO.png',
            'yfKwBjb68RkGh8fULxWa0R2VV5LaXe45J21oVnbP.png',
            'YLYIrxv6F41LzpAFX2UnyfnOERLrMt1CdHjzLvNI.png',
            'YPtQ1aMnEJ5wpWAtHoNGunfK6ehBfu4EI0zPe8xZ.png',
            'ZKhZtW3vl8ODXHwmrpbetOPXcptzeJpiKnXksUMJ.png',
        ];

        $posts = [];

        foreach ($trainerIds as $trainerId) {
            $numPosts = rand(2, 4); // Secara acak pilih 2 hingga 4 post per pelatih

            for ($i = 0; $i < $numPosts; $i++) {
                $posts[] = [
                    'trainer_id' => $trainerId,
                    'data_price_id' => $dataPriceIds[array_rand($dataPriceIds)],
                    'description' => $this->generateDescription(),
                    'image' => 'images/' . $imageFiles[array_rand($imageFiles)],
                    'schedule_id' => $scheduleIds[array_rand($scheduleIds)],
                    'categories_post_id' => $categoryPostIds[array_rand($categoryPostIds)],
                    'post_date' => now(),
                    'status' => 'active',
                    // 'status' => rand(0, 1) ? 'active' : 'inactive',
                ];
            }
        }

        // Menyisipkan data ke tabel 'posts'
        DB::table('posts')->insert($posts);
    }

    private function generateDescription()
    {
        $descriptions = [
            'Pelatihan web developer yang mencakup semua aspek penting dari pemrograman web modern.',
            'Pelatihan digital marketing untuk membantu Anda memahami strategi pemasaran online yang efektif.',
            'Pelatihan soft skills untuk meningkatkan keterampilan interpersonal dan komunikasi.',
            'Pelatihan manajemen proyek untuk mengelola tim dan proyek secara efisien.',
            'Pelatihan analisis data untuk membantu Anda membuat keputusan berbasis data.',
            'Pelatihan desain grafis untuk meningkatkan keterampilan visual dan kreativitas.',
            'Pelatihan keamanan siber untuk melindungi data dan sistem dari ancaman digital.',
            'Pelatihan manajemen keuangan untuk mengelola anggaran dan finansial secara efektif.',
            'Pelatihan layanan pelanggan untuk meningkatkan keterampilan interaksi dengan pelanggan.',
            'Pelatihan kepemimpinan untuk memimpin tim dan organisasi dengan lebih baik.'
        ];

        return $descriptions[array_rand($descriptions)];
    }
}
