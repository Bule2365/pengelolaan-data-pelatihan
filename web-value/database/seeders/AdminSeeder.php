<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['role_name' => 'admin-website']
        ]);

        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'role_id' => 1,
                'password' => Hash::make('admin123'),
            ],
            [
                'username' => 'coolBoy',
                'email' => 'coolboy@gmail.com',
                'role_id' => 1,
                'password' => Hash::make('boy34298637'),
            ]
        ]);
    }
}
