<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbKramaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_krama')->delete();
        
        \DB::table('tb_krama')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_user' => 1,
                'id_desa' => '1101010004',
                'id_desa_adat' => 5,
                'nama_krama' => 'krama-alin',
                'alamat_krama' => 'Jalan raya padonan no25',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Gianyar',
                'tanggal_lahir' => '2021-10-12',
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'created_at' => '2022-01-15 14:04:08',
                'updated_at' => '2022-01-15 14:04:12',
            ),
            1 => 
            array (
                'id' => 2,
                'id_user' => 7,
                'id_desa' => '1101010006',
                'id_desa_adat' => 4,
                'nama_krama' => 'krama-rismawan',
                'alamat_krama' => 'Jalan raya dalung permai no25',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Singaraja',
                'tanggal_lahir' => '2021-10-07',
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'created_at' => '2022-01-15 14:04:10',
                'updated_at' => '2022-01-15 14:04:13',
            ),
        ));
        
        
    }
}