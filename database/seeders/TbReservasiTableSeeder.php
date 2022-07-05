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
                'id' => 1,
                'id_relasi' => 49,
                'id_sanggar' => NULL,
                'id_upacaraku' => 1,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-07-04 21:54:10',
                'updated_at' => '2022-07-04 21:54:10',
                'rating' => NULL,
                'keterangan_rating' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 1,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:14:37',
                'updated_at' => '2022-07-04 22:14:37',
                'rating' => NULL,
                'keterangan_rating' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_relasi' => NULL,
                'id_sanggar' => 10,
                'id_upacaraku' => 1,
                'tipe' => 'sanggar',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:16:01',
                'updated_at' => '2022-07-04 22:16:01',
                'rating' => NULL,
                'keterangan_rating' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 2,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-07-04 23:26:24',
                'updated_at' => '2022-07-04 23:26:24',
                'rating' => NULL,
                'keterangan_rating' => NULL,
            ),
        ));
        
        
    }
}