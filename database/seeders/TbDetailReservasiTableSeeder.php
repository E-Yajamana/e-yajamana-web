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
                'updated_at' => '2022-02-19 22:43:59',
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
                'updated_at' => '2022-02-19 22:43:59',
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
                'updated_at' => '2022-02-19 22:43:59',
            ),
            5 => 
            array (
                'id' => 6,
                'id_reservasi' => 53,
                'id_tahapan_upacara' => 23,
                'tanggal_mulai' => '2022-02-20 00:00:00',
                'tanggal_selesai' => '2022-02-22 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 19:59:23',
                'updated_at' => '2022-02-19 20:09:04',
            ),
            6 => 
            array (
                'id' => 7,
                'id_reservasi' => 54,
                'id_tahapan_upacara' => 23,
                'tanggal_mulai' => '2022-02-21 00:00:00',
                'tanggal_selesai' => '2022-02-23 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:18:34',
                'updated_at' => '2022-02-19 20:18:34',
            ),
            7 => 
            array (
                'id' => 8,
                'id_reservasi' => 55,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-02-24 00:00:00',
                'tanggal_selesai' => '2022-02-24 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:19:33',
                'updated_at' => '2022-02-19 20:19:33',
            ),
            8 => 
            array (
                'id' => 9,
                'id_reservasi' => 55,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-02-25 00:00:00',
                'tanggal_selesai' => '2022-02-25 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:19:33',
                'updated_at' => '2022-02-19 20:19:33',
            ),
            9 => 
            array (
                'id' => 10,
                'id_reservasi' => 55,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-02-26 00:00:00',
                'tanggal_selesai' => '2022-02-26 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:19:33',
                'updated_at' => '2022-02-19 20:19:33',
            ),
            10 => 
            array (
                'id' => 11,
                'id_reservasi' => 56,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-02-24 00:00:00',
                'tanggal_selesai' => '2022-02-25 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:28:08',
                'updated_at' => '2022-02-19 20:28:08',
            ),
            11 => 
            array (
                'id' => 12,
                'id_reservasi' => 56,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-02-24 00:00:00',
                'tanggal_selesai' => '2022-02-24 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:28:08',
                'updated_at' => '2022-02-19 20:28:08',
            ),
            12 => 
            array (
                'id' => 13,
                'id_reservasi' => 56,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-02-24 00:00:00',
                'tanggal_selesai' => '2022-02-24 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:28:08',
                'updated_at' => '2022-02-19 20:28:08',
            ),
            13 => 
            array (
                'id' => 14,
                'id_reservasi' => 56,
                'id_tahapan_upacara' => 16,
                'tanggal_mulai' => '2022-02-25 00:00:00',
                'tanggal_selesai' => '2022-02-25 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:28:08',
                'updated_at' => '2022-02-19 20:28:08',
            ),
            14 => 
            array (
                'id' => 15,
                'id_reservasi' => 56,
                'id_tahapan_upacara' => 17,
                'tanggal_mulai' => '2022-02-26 00:00:00',
                'tanggal_selesai' => '2022-02-26 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-19 20:28:08',
                'updated_at' => '2022-02-19 20:28:08',
            ),
            15 => 
            array (
                'id' => 16,
                'id_reservasi' => 50,
                'id_tahapan_upacara' => 7,
                'tanggal_mulai' => '2022-02-17 00:00:00',
                'tanggal_selesai' => '2022-02-18 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-20 16:54:15',
                'updated_at' => '2022-02-20 16:54:15',
            ),
            16 => 
            array (
                'id' => 17,
                'id_reservasi' => 50,
                'id_tahapan_upacara' => 8,
                'tanggal_mulai' => '2022-02-21 00:00:00',
                'tanggal_selesai' => '2022-02-23 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-20 16:54:24',
                'updated_at' => '2022-02-20 16:54:24',
            ),
            17 => 
            array (
                'id' => 18,
                'id_reservasi' => 50,
                'id_tahapan_upacara' => 9,
                'tanggal_mulai' => '2022-02-20 00:00:00',
                'tanggal_selesai' => '2022-02-23 23:59:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-02-20 16:54:39',
                'updated_at' => '2022-02-20 16:54:39',
            ),
        ));
        
        
    }
}