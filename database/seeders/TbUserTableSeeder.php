<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_user')->delete();

        DB::table('tb_user')->insert(array (
            0 =>
            array (
                'id' => 1,
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$3kFDzCQ/UtIIxpSAlaPe.uhCqJwh7TEsCSjwqEGKxacxNw1nGz7Tq',
                'nomor_telepon' => '081241241242',
                'user_profile' => NULL,
                'role' => 'admin',
                'json_token_lupa_password' => '',
                'created_at' => '2022-01-12 06:49:42',
                'updated_at' => '2022-01-12 06:49:42',
            ),
            1 =>
            array (
                'id' => 2,
                'email' => 'pemangku@gmail.com',
                'password' => '$2y$10$aNpem5TusICgROTkartapuirHwfqKepp64/7l8mT/k/MF0CUkH36u',
                'nomor_telepon' => '081241241243',
                'user_profile' => NULL,
                'role' => 'pemangku',
                'json_token_lupa_password' => '',
                'created_at' => '2022-01-12 06:49:42',
                'updated_at' => '2022-01-12 06:49:42',
            ),
            2 =>
            array (
                'id' => 3,
                'email' => 'sanggar@gmail.com',
                'password' => '$2y$10$G5UjxnMPOJpV9Zbtxvx8nOdsY4uzuxt6ErE6pzJLwWvqYLTsysZtG',
                'nomor_telepon' => '081241241244',
                'user_profile' => NULL,
                'role' => 'sanggar',
                'json_token_lupa_password' => '',
                'created_at' => '2022-01-12 06:49:42',
                'updated_at' => '2022-01-12 06:49:42',
            ),
            3 =>
            array (
                'id' => 4,
                'email' => 'sulinggih@gmail.com',
                'password' => '$2y$10$yEv5O2x164rjEb5ZscLygOuyEsnVu2hpp4zeT6R5MmD6SFsnrlAL6',
                'nomor_telepon' => '081241241241',
                'user_profile' => NULL,
                'role' => 'sulinggih',
                'json_token_lupa_password' => '',
                'created_at' => '2022-01-12 06:49:42',
                'updated_at' => '2022-01-12 06:49:42',
            ),
            4 =>
            array (
                'id' => 5,
                'email' => 'kramabali@gmail.com',
                'password' => '$2y$10$jV1t/ZHFhsv3cdCheBEYSuSYqa92alZR7B6td4UmtCjUYw4IKnjqa',
                'nomor_telepon' => '081141241242',
                'user_profile' => NULL,
                'role' => 'krama_bali',
                'json_token_lupa_password' => '',
                'created_at' => '2022-01-12 06:49:42',
                'updated_at' => '2022-01-12 06:49:42',
            ),
        ));


    }
}
