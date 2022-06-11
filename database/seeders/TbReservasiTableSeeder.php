<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbReservasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_reservasi')->delete();
        
        \DB::table('tb_reservasi')->insert(array (
            0 => 
            array (
                'id' => 54,
                'id_relasi' => NULL,
                'id_sanggar' => 6,
                'id_upacaraku' => 1,
                'tipe' => 'sanggar',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-05-27 11:11:26',
                'updated_at' => '2022-05-27 11:11:26',
                'rating' => NULL,
            ),
            1 => 
            array (
                'id' => 84,
                'id_relasi' => NULL,
                'id_sanggar' => 5,
                'id_upacaraku' => 1,
                'tipe' => 'sanggar',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-05-27 12:57:24',
                'updated_at' => '2022-05-27 12:57:24',
                'rating' => NULL,
            ),
            2 => 
            array (
                'id' => 85,
                'id_relasi' => 58,
                'id_sanggar' => NULL,
                'id_upacaraku' => 1,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-05-27 13:03:02',
                'updated_at' => '2022-05-27 13:03:02',
                'rating' => NULL,
            ),
            3 => 
            array (
                'id' => 86,
                'id_relasi' => 49,
                'id_sanggar' => NULL,
                'id_upacaraku' => 1,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:05:26',
                'updated_at' => '2022-05-31 12:05:26',
                'rating' => NULL,
            ),
            4 => 
            array (
                'id' => 89,
                'id_relasi' => NULL,
                'id_sanggar' => 6,
                'id_upacaraku' => 2,
                'tipe' => 'sanggar',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:11:16',
                'updated_at' => '2022-05-31 12:11:16',
                'rating' => NULL,
            ),
            5 => 
            array (
                'id' => 90,
                'id_relasi' => 49,
                'id_sanggar' => NULL,
                'id_upacaraku' => 2,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:12:39',
                'updated_at' => '2022-05-31 12:12:39',
                'rating' => NULL,
            ),
        ));
        
        
    }
}