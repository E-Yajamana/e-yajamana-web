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
                'id_krama' => 1,
                'id_user' => 1,
                'nama_krama' => 'krama-alin',
                'alamat_krama' => 'Jalan raya padonan no25',
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '2021-10-12',
            ),
            1 => 
            array (
                'id_krama' => 2,
                'id_user' => 7,
                'nama_krama' => 'krama-rismawan',
                'alamat_krama' => 'Jalan raya dalung permai no25',
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '2021-10-07',
            ),
        ));
        
        
    }
}