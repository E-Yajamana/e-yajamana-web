<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbGriyaRumahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_griya_rumah')->delete();
        
        \DB::table('tb_griya_rumah')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_griya_rumah' => 'Griaya Gunung Sari',
                'alamat_griya_rumah' => 'Jalan Gunung Sari No 5',
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'id_desa_adat' => 3,
                'id_desa' => '1101010005',
                'created_at' => '2022-01-15 20:59:11',
                'updated_at' => '2022-01-15 20:59:12',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_griya_rumah' => 'Griya Tegal Linggah',
                'alamat_griya_rumah' => 'Jalan Tegal No 15',
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'id_desa_adat' => 3,
                'id_desa' => '1101010004',
                'created_at' => '2022-01-15 20:59:14',
                'updated_at' => '2022-01-15 20:59:19',
            ),
            2 => 
            array (
                'id' => 3,
                'nama_griya_rumah' => 'Puri Anyar',
                'alamat_griya_rumah' => 'Jalan Anyar no 12',
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'id_desa_adat' => 5,
                'id_desa' => '1101010006',
                'created_at' => '2022-01-15 20:59:16',
                'updated_at' => '2022-01-15 20:59:17',
            ),
        ));
        
        
    }
}