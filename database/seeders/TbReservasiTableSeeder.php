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
                'id_relasi' => 2,
                'id_upacaraku' => 21,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-03-17 23:36:04',
                'updated_at' => '2022-03-17 23:36:04',
            ),
            1 => 
            array (
                'id' => 2,
                'id_relasi' => 4,
                'id_upacaraku' => 24,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-03-24 21:46:47',
                'updated_at' => '2022-03-24 21:46:47',
            ),
            2 => 
            array (
                'id' => 3,
                'id_relasi' => 2,
                'id_upacaraku' => 25,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-03-24 21:48:07',
                'updated_at' => '2022-03-24 21:48:07',
            ),
            3 => 
            array (
                'id' => 5,
                'id_relasi' => 49,
                'id_upacaraku' => 25,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-03-25 15:16:33',
                'updated_at' => '2022-03-25 15:16:33',
            ),
        ));
        
        
    }
}