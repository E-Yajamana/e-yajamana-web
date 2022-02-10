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
                'id_relasi' => 1,
                'id_upacaraku' => 1,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => 'desc',
                'created_at' => '2022-01-20 19:52:34',
                'updated_at' => '2022-01-20 19:52:36',
            ),
            1 => 
            array (
                'id' => 30,
                'id_relasi' => 18,
                'id_upacaraku' => 1,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-01-25 05:15:07',
                'updated_at' => '2022-01-25 05:15:07',
            ),
            2 => 
            array (
                'id' => 36,
                'id_relasi' => 20,
                'id_upacaraku' => 1,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => '2022-02-10 08:33:55',
                'keterangan' => NULL,
                'created_at' => '2022-01-26 14:35:49',
                'updated_at' => '2022-02-10 20:33:55',
            ),
            3 => 
            array (
                'id' => 39,
                'id_relasi' => 20,
                'id_upacaraku' => 14,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'batal',
                'tanggal_tangkil' => '2022-02-12 18:49:45',
                'keterangan' => NULL,
                'created_at' => '2022-01-27 23:40:13',
                'updated_at' => '2022-02-10 19:30:34',
            ),
            4 => 
            array (
                'id' => 41,
                'id_relasi' => 1,
                'id_upacaraku' => 14,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-01-27 23:49:53',
                'updated_at' => '2022-01-27 23:49:53',
            ),
            5 => 
            array (
                'id' => 42,
                'id_relasi' => 1,
                'id_upacaraku' => 8,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-01-28 10:43:31',
                'updated_at' => '2022-02-08 16:42:33',
            ),
            6 => 
            array (
                'id' => 43,
                'id_relasi' => 1,
                'id_upacaraku' => 8,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-01-28 13:21:03',
                'updated_at' => '2022-01-28 13:21:03',
            ),
            7 => 
            array (
                'id' => 45,
                'id_relasi' => 18,
                'id_upacaraku' => 1,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => '2022-02-11 18:53:56',
                'keterangan' => NULL,
                'created_at' => '2022-02-07 21:13:45',
                'updated_at' => '2022-02-07 21:13:45',
            ),
            8 => 
            array (
                'id' => 46,
                'id_relasi' => 20,
                'id_upacaraku' => 1,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'proses tangkil',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-10 16:22:46',
                'updated_at' => '2022-02-10 19:37:14',
            ),
            9 => 
            array (
                'id' => 47,
                'id_relasi' => 20,
                'id_upacaraku' => 9,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-02-10 20:16:06',
                'updated_at' => '2022-02-10 20:16:06',
            ),
            10 => 
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
        ));
        
        
    }
}