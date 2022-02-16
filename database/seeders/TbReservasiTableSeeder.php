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
                'id' => 50,
                'id_relasi' => 2,
                'id_upacaraku' => 21,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-14 21:48:53',
                'updated_at' => '2022-02-14 21:48:53',
            ),
            1 => 
            array (
                'id' => 51,
                'id_relasi' => 10,
                'id_upacaraku' => 22,
                'tipe' => 'sanggar',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-14 21:52:39',
                'updated_at' => '2022-02-14 21:52:39',
            ),
            2 => 
            array (
                'id' => 52,
                'id_relasi' => 4,
                'id_upacaraku' => 21,
                'tipe' => 'sanggar',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-14 22:23:31',
                'updated_at' => '2022-02-14 22:23:31',
            ),
        ));
        
        
    }
}