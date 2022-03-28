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
                'id_reservasi' => 1,
                'id_tahapan_upacara' => 5,
                'tanggal_mulai' => '2022-02-23 00:00:00',
                'tanggal_selesai' => '2022-02-23 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-17 23:36:04',
                'updated_at' => '2022-03-17 23:36:04',
            ),
            1 => 
            array (
                'id' => 2,
                'id_reservasi' => 1,
                'id_tahapan_upacara' => 6,
                'tanggal_mulai' => '2022-02-23 00:00:00',
                'tanggal_selesai' => '2022-02-23 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-17 23:36:04',
                'updated_at' => '2022-03-17 23:36:04',
            ),
            2 => 
            array (
                'id' => 3,
                'id_reservasi' => 2,
                'id_tahapan_upacara' => 20,
                'tanggal_mulai' => '2022-04-27 00:00:00',
                'tanggal_selesai' => '2022-04-27 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-24 21:46:47',
                'updated_at' => '2022-03-24 21:46:47',
            ),
            3 => 
            array (
                'id' => 4,
                'id_reservasi' => 3,
                'id_tahapan_upacara' => 20,
                'tanggal_mulai' => '2022-04-20 00:00:00',
                'tanggal_selesai' => '2022-04-27 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-24 21:48:07',
                'updated_at' => '2022-03-24 21:48:07',
            ),
            4 => 
            array (
                'id' => 5,
                'id_reservasi' => 3,
                'id_tahapan_upacara' => 22,
                'tanggal_mulai' => '2022-04-27 00:00:00',
                'tanggal_selesai' => '2022-04-27 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-24 21:48:07',
                'updated_at' => '2022-03-24 21:48:07',
            ),
            5 => 
            array (
                'id' => 6,
                'id_reservasi' => 5,
                'id_tahapan_upacara' => 20,
                'tanggal_mulai' => '2022-04-27 00:00:00',
                'tanggal_selesai' => '2022-04-27 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-25 15:16:33',
                'updated_at' => '2022-03-25 15:16:33',
            ),
            6 => 
            array (
                'id' => 7,
                'id_reservasi' => 6,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:51:29',
                'updated_at' => '2022-03-28 13:51:29',
            ),
            7 => 
            array (
                'id' => 8,
                'id_reservasi' => 6,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:51:29',
                'updated_at' => '2022-03-28 13:51:29',
            ),
            8 => 
            array (
                'id' => 9,
                'id_reservasi' => 6,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:51:29',
                'updated_at' => '2022-03-28 13:51:29',
            ),
            9 => 
            array (
                'id' => 10,
                'id_reservasi' => 6,
                'id_tahapan_upacara' => 16,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:51:29',
                'updated_at' => '2022-03-28 13:51:29',
            ),
            10 => 
            array (
                'id' => 11,
                'id_reservasi' => 7,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:52:31',
                'updated_at' => '2022-03-28 13:52:31',
            ),
            11 => 
            array (
                'id' => 12,
                'id_reservasi' => 7,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:52:31',
                'updated_at' => '2022-03-28 13:52:31',
            ),
            12 => 
            array (
                'id' => 13,
                'id_reservasi' => 7,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:52:31',
                'updated_at' => '2022-03-28 13:52:31',
            ),
            13 => 
            array (
                'id' => 14,
                'id_reservasi' => 7,
                'id_tahapan_upacara' => 16,
                'tanggal_mulai' => '2022-03-31 00:00:00',
                'tanggal_selesai' => '2022-03-31 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-28 13:52:31',
                'updated_at' => '2022-03-28 13:52:31',
            ),
        ));
        
        
    }
}