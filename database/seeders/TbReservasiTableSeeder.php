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
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-14 21:48:53',
                'updated_at' => '2022-02-19 22:43:59',
            ),
            1 => 
            array (
                'id' => 51,
                'id_relasi' => 10,
                'id_upacaraku' => 22,
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
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-14 22:23:31',
                'updated_at' => '2022-02-19 22:43:59',
            ),
            3 => 
            array (
                'id' => 53,
                'id_relasi' => 2,
                'id_upacaraku' => 23,
                'status' => 'proses muput',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-19 19:59:23',
                'updated_at' => '2022-02-19 20:09:04',
            ),
            4 => 
            array (
                'id' => 54,
                'id_relasi' => 10,
                'id_upacaraku' => 23,
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:18:34',
                'updated_at' => '2022-02-19 20:18:34',
            ),
            5 => 
            array (
                'id' => 55,
                'id_relasi' => 2,
                'id_upacaraku' => 22,
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:19:33',
                'updated_at' => '2022-02-19 20:19:33',
            ),
            6 => 
            array (
                'id' => 56,
                'id_relasi' => 3,
                'id_upacaraku' => 22,
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:28:08',
                'updated_at' => '2022-02-19 20:28:08',
            ),
        ));
        
        
    }
}