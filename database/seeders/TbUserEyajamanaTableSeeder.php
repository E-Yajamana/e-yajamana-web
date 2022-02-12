<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUserEyajamanaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_user_eyajamana')->delete();
        
        \DB::table('tb_user_eyajamana')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_penduduk' => NULL,
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$aDN8y/nNpe9DHte0VIVu/ensr4.Aw91vLA4z1XqlnEnZSW/AeeOEm',
                'nomor_telepon' => '087851423695',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'admin',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 14:53:02',
                'updated_at' => '2022-01-18 14:53:03',
            ),
            1 => 
            array (
                'id' => 2,
                'id_penduduk' => 3,
                'email' => 'sulinggih@gmail.com',
                'password' => '$2y$10$xkljavxyQ9xirivMWUw9hulUB5Dx2mX43o0UxnoPDVT1hKX7FoKya',
                'nomor_telepon' => '087221423695',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'sulinggih',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 14:53:54',
                'updated_at' => '2022-01-18 14:53:56',
            ),
            2 => 
            array (
                'id' => 3,
                'id_penduduk' => NULL,
                'email' => 'pemangku@gmail.com',
                'password' => '$2y$10$c90Bb7MqA9AKD3fMhIywt.r7dVbzG0LT3qdGV4Z8FmfJmUwRu0/ZK',
                'nomor_telepon' => '081241241258',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'pemangku',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 14:54:47',
                'updated_at' => '2022-01-18 14:54:49',
            ),
            3 => 
            array (
                'id' => 4,
                'id_penduduk' => NULL,
                'email' => 'sannggar@gmail.com',
                'password' => 'sanggar',
                'nomor_telepon' => '082412859582',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'sanggar',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 14:55:37',
                'updated_at' => '2022-01-18 14:55:39',
            ),
            4 => 
            array (
                'id' => 5,
                'id_penduduk' => NULL,
                'email' => 'serati@gmail.com',
                'password' => 'serati',
                'nomor_telepon' => '083421752812',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'serati',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 14:56:05',
                'updated_at' => '2022-01-18 14:56:07',
            ),
            5 => 
            array (
                'id' => 6,
                'id_penduduk' => 45,
                'email' => 'alingotama14@gmail.com',
                'password' => '$2y$10$JbdbcPmvSLO2gW.CJC5VFuIRYifjPNhjEI.c4mkvRYHjZBgvCDQ9O',
                'nomor_telepon' => '081924124989',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'krama_bali',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 14:57:25',
                'updated_at' => '2022-01-18 14:57:27',
            ),
            6 => 
            array (
                'id' => 7,
                'id_penduduk' => NULL,
                'email' => 'gedebajing@gmail.com',
                'password' => 'sulinggih',
                'nomor_telepon' => '081924121481',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'sulinggih',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 15:00:13',
                'updated_at' => '2022-01-18 15:00:14',
            ),
            7 => 
            array (
                'id' => 8,
                'id_penduduk' => NULL,
                'email' => 'alit@gmail.com',
                'password' => 'sulinggih',
                'nomor_telepon' => '082424124989',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'sulinggih',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 15:00:16',
                'updated_at' => '2022-01-18 15:00:18',
            ),
            8 => 
            array (
                'id' => 9,
                'id_penduduk' => NULL,
                'email' => 'dayu-ngurah@gmail.com',
                'password' => 'sulinggih',
                'nomor_telepon' => '081414121481',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'sulinggih',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-18 22:59:08',
                'updated_at' => '2022-01-18 22:59:09',
            ),
            9 => 
            array (
                'id' => 10,
                'id_penduduk' => NULL,
                'email' => 'sanggar-warini@gmail.com',
                'password' => 'sanggar',
                'nomor_telepon' => '081414121481',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'sanggar',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-19 01:44:56',
                'updated_at' => '2022-01-19 01:44:58',
            ),
            10 => 
            array (
                'id' => 11,
                'id_penduduk' => 5,
                'email' => 'krama@gmail.com',
                'password' => '$2y$10$7foFnYvAFzjIT5pQACjWduufgpx6yq0JJjYdVgAsJ6xFdpIHuymYm',
                'nomor_telepon' => '082421241242',
                'user_profile' => 'app/default/profile/user.jpg',
                'role' => 'krama_bali',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-01-21 13:56:51',
                'updated_at' => '2022-01-21 13:56:52',
            ),
        ));
        
        
    }
}