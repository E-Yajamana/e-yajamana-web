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
        ));
        
        
    }
}