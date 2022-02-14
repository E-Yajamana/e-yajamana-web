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
                'id' => 48,
                'id_relasi' => 20,
                'id_upacaraku' => 17,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-10 20:31:29',
                'updated_at' => '2022-02-10 20:31:29',
            ),
            1 => 
            array (
                'id' => 49,
                'id_relasi' => 20,
                'id_upacaraku' => 21,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-14 15:24:07',
                'updated_at' => '2022-02-14 15:24:07',
            ),
        ));
        
        
    }
}