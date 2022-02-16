<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbDetailReservasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_detail_reservasi')->delete();
        
        \DB::table('tb_detail_reservasi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_reservasi' => 50,
                'id_tahapan_upacara' => 5,
                'tanggal_mulai' => '2022-02-17 00:00:00',
                'tanggal_selesai' => '2022-02-18 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-14 21:48:53',
                'updated_at' => '2022-02-14 21:48:53',
            ),
            1 => 
            array (
                'id' => 2,
                'id_reservasi' => 51,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-02-25 00:00:00',
                'tanggal_selesai' => '2022-02-26 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-14 21:52:39',
                'updated_at' => '2022-02-14 21:52:39',
            ),
            2 => 
            array (
                'id' => 3,
                'id_reservasi' => 51,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-02-25 00:00:00',
                'tanggal_selesai' => '2022-02-26 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-14 21:52:39',
                'updated_at' => '2022-02-14 21:52:39',
            ),
            3 => 
            array (
                'id' => 4,
                'id_reservasi' => 52,
                'id_tahapan_upacara' => 5,
                'tanggal_mulai' => '2022-02-16 00:00:00',
                'tanggal_selesai' => '2022-02-19 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-14 22:23:32',
                'updated_at' => '2022-02-14 22:23:32',
            ),
            4 => 
            array (
                'id' => 5,
                'id_reservasi' => 52,
                'id_tahapan_upacara' => 6,
                'tanggal_mulai' => '2022-02-16 00:00:00',
                'tanggal_selesai' => '2022-02-19 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-14 22:23:32',
                'updated_at' => '2022-02-14 22:23:32',
            ),
        ));
        
        
    }
}