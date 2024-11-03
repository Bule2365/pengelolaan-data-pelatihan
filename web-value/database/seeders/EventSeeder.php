<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $trainers = \App\Models\Trainer::pluck('id')->toArray(); // Mendapatkan semua ID trainer
        $hotels = \App\Models\Hotel::pluck('id')->toArray(); // Mendapatkan semua ID hotel

        for ($i = 0; $i < 200; $i++) {
            $eventType = $faker->randomElement(['online', 'offline']);
            $hotelId = $eventType === 'offline' ? $faker->randomElement($hotels) : null;
            $imageFile = 'event_images/' . $faker->randomElement([
                '1pHkKFaIclrDF8z7zL25GYajawbFTO1xQ8sIOdJf.png',
                '2RjJUxHT4PvLExWcQyRhaFiS5LrDdsEh9LT3Sq3D.png',
                '2T8vMdyPbYqVQAIT7NEpWUT1ZnY8fRmCBJFmy706.png',
                '2vZFgH26DlkKsnacdSY6kG8QlAwXOdDFIsF57NBr.png',
                '4Iv7nSeesGJyKDqSzs1YLqy8kXT9q390IqwdHMra.png',
                '6qggi29jDtPp1O6AGCZRyb9nFm45QPwik2Z0VxYR.png',
                '6XS2pUzX5GTH2oP5x1OHtl6fCaX9KQR32XYiYNoH.png',
                '11ehsU8U3qLfRFuK62r8lqteMEqpcJQulx9KZl0J.png',
                '3669Qb0QHpA6XTej3f0FxhtkJHTKOsmy3xJrL0GS.png',
                'AWXRBmVNeLzXVAjhMImjZhl5U52gFOy4rHZhBQK7.png',
                'bXskWcyYUXHq7aLyLgmfOUaN2n7FezCdNtylzMkp.png',
                'cyt0N1qSVXGaX2PhSU3yDFfv0QhZngrj7IcnpU7R.png',
                'DkeNifb5VJ76Cfj86l0Smc8gZZfV8FrRc23xzabY.png',
                'eJmxacdvk1JtHdUeLCmbx2KfgcZOINRcTYXilBS5.png',
                'fccfXdP4DVIngzkzonMy4Oytg9zUYsSOZwD1HQxk.png',
                'FhnVSkUICZnvmCaDpAiMwfy7UsiHD5zMW2XVWZWQ.png',
                'G1t3TMBSegfwR1cQiEyopf7WdGPg8R6sLgYYsIzp.png',
                'GJHT5keFcOTWBwQnz18AzQpKnOT6cTlRT2s5mV1d.png',
                'INOsVxMT5C4y7x1OHElxCSo9CLezbKtg4TT89Gtv.png',
                'j44Wjmbjpd0rST40l6ykcoyZOgPctvtHKCDxwXIa.png',
                'jG0kQykbV2yFkuH73lKoX15cWbNnojwMCqZ2zi6R.png',
                'jG0QJCXHTH9zciVR9m8QDvIOD1nEzcWARssNcOoX.png',
                'jKINAHOtEkE9O8Uc2ovUpqyRviwXgymfkOqRvH5m.png',
                'jQYlAgmHHiZnTb8CqTBPcRGkhCibhHgIRXH8D2At.png',
                'JUFakAth4MSjsLCo8VCucEjkNO9LqHaJlLFPQWxF.png',
                'JZBT6kezn7FpVvrjAQn7q4CfzI8GdJsYGPMAGjrJ.png',
                'KDEqhkSA86omHRYmyPLMy7JUIVsj0AgurR66Lveo.png',
                'KqvBiMDz5INXy5CezMfCAKqD1JKrwkgKn0IE4jrR.png',
                'LBF9l4kIxTsvxm1blbOoXn1sDoKUwi6Aquxpav1q.png',
                'LDBcAhOK5xQMGNqSTvxuKONyEtrc4Dx6lfggjhz7.png',
                'LG54EvBNci01nBxIPX4V8YoFCmaHKVj5MtQNY3rH.png',
                'lVqpMTbyjPtQyeCtKPdP4EMWwLIOMm4IsGZyPcNj.png',
                'MqXqEVHVELEBdQaFnHaf5Kf5QKS3BwYaoNWvO9pt.png',
                'Oj6MdMUBBh9FayHkCm5HNsdL9sbfdxwemEB1URtx.png',
                'omGYxQDlgNh7R4gytAPRJKVzpixj4TXuQCp0snhT.png',
                'onjGHZwTTqjq48J7P6oHLqc1S3wA0yGmCLirT6hf.png',
                'ORY5CQHR19Xwy5qK16tVKaHVRXNtyjmPrEOYwrAv.png',
                'OTVoytE7E9PlBwf3ZzFxHFIikGnaYSAekaB1YurB.png',
                'pcDZbdsHqNTtro6FfOxnP83G4WpHSoYFOsaUTMMd.png',
                'Q45UvB293rvWCgDqWvNRiRVvwnk1OjivxjjXZfHm.png',
                'qXASk382Sxj8TYSaxOYjoG5KwpWTUar7yiKo7XYs.png',
                'r2jx0YVEKCdTlhgYevGLIkloqbkrI4lFAp2L4sDW.png',
                'si5Wu6VdEhAa7b0zBnsLtTRlUTcrXm4FOh7fd2Vb.png',
                't2r5k50BHrQUFOMzHKgHBsaPZGpm278sTrm2BaF4.png',
                'tIlvJLgkjlwuaYQSajl4wNuXAwKzQ3ABTDbZ75rE.png',
                'tuByrxmeMQ7OgTVAIq27ryxB9AI6PjqiHGwRH9A3.png',
                'w0LVdU1Y91T35AXIo1pHp7TbP7s2GeL69c7cxbzd.png',
                'W9ZG1nzCm9Q0a5Xoer6VngIdmPQEeUZNm5COLwgM.png',
                'wahg0IfWKrZM0n7MVwkZL0triBLb6iUEv0Xjdr1d.png',
                'wbGMnD5baMZWpRdDsQTQwkpIYW15rrozH9L09kPX.png',
                'WdMM2aH3CaUX9WNBe9EOeAgDcoCfFFyNVpnfpqBS.png',
                'WY3luD9uR5ydWMg9vC8vmRfDlhkUUoHwWsb8P0wi.png',
                'y0JnPNpvjiDMrkejX74MJV0wtXRcDMDyHJBN9onX.png',
                'yCmlDlXn7gci7OpiTUmlPW5YmFVjq8s79mhPBWaG.png',
                'YW3PznFLlh4h4bPNs8ms20QgvaWtzl2sgAT6ZaSf.png'
            ]);

            DB::table('events')->insert([
                'event_title' => $faker->sentence(4),
                'image' => $imageFile,
                'event_description' => $faker->paragraph(),
                'event_time' => $faker->dateTimeBetween('+1 days', '+1 month'),
                'price' => $faker->randomFloat(2, 100, 1000),
                'trainer_id' => $faker->randomElement($trainers),
                'event_type' => $eventType,
                'hotel_id' => $hotelId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
