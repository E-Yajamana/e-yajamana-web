<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TbUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'email' => "admin@gmail.com",
                'password' => Hash::make('admin'),
                'nomor_telepon' => '081241241242',
                'role' => "admin"
            ],
            [
                'email' => "pemangku@gmail.com",
                'password' => Hash::make('pemangku'),
                'nomor_telepon' => '081241241243',
                'role' => "pemangku"
            ],
            [
                'email' => "sanggar@gmail.com",
                'password' => Hash::make('sanggar'),
                'nomor_telepon' => '081241241244',
                'role' => "sanggar"
            ],
            [
                'email' => "sulinggih@gmail.com",
                'password' => Hash::make('sulinggih'),
                'nomor_telepon' => '081241241241',
                'role' => "sulinggih"
            ],
            [
                'email' => "kramabali@gmail.com",
                'password' => Hash::make('kramabali'),
                'nomor_telepon' => '081141241242',
                'role' => "krama_bali"
            ],

        ];

        foreach ($data as $user){
            User::create($user);
        }
    }
}
