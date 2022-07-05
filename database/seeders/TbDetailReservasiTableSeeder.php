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
                'id_tahapan_upacara' => 12,
                'tanggal_mulai' => '2022-08-18 09:12:00',
                'tanggal_selesai' => '2022-08-20 21:11:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 21:54:10',
                'updated_at' => '2022-07-04 22:02:09',
            ),
            1 => 
            array (
                'id' => 2,
                'id_reservasi' => 1,
                'id_tahapan_upacara' => 2,
                'tanggal_mulai' => '2022-08-19 10:15:00',
                'tanggal_selesai' => '2022-08-20 09:07:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 21:54:10',
                'updated_at' => '2022-07-04 22:01:50',
            ),
            2 => 
            array (
                'id' => 3,
                'id_reservasi' => 1,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-08-20 07:10:00',
                'tanggal_selesai' => '2022-08-20 13:08:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:02:32',
                'updated_at' => '2022-07-04 22:02:32',
            ),
            3 => 
            array (
                'id' => 4,
                'id_reservasi' => 2,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-08-17 15:16:00',
                'tanggal_selesai' => '2022-08-17 17:18:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:14:37',
                'updated_at' => '2022-07-04 22:14:37',
            ),
            4 => 
            array (
                'id' => 5,
                'id_reservasi' => 2,
                'id_tahapan_upacara' => 2,
                'tanggal_mulai' => '2022-08-19 15:00:00',
                'tanggal_selesai' => '2022-08-20 11:13:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:14:37',
                'updated_at' => '2022-07-04 22:14:37',
            ),
            5 => 
            array (
                'id' => 6,
                'id_reservasi' => 3,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-08-17 14:00:00',
                'tanggal_selesai' => '2022-08-17 17:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:16:01',
                'updated_at' => '2022-07-04 22:16:01',
            ),
            6 => 
            array (
                'id' => 7,
                'id_reservasi' => 3,
                'id_tahapan_upacara' => 2,
                'tanggal_mulai' => '2022-08-17 00:00:00',
                'tanggal_selesai' => '2022-08-20 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:16:01',
                'updated_at' => '2022-07-04 22:16:01',
            ),
            7 => 
            array (
                'id' => 8,
                'id_reservasi' => 3,
                'id_tahapan_upacara' => 3,
                'tanggal_mulai' => '2022-08-19 13:00:00',
                'tanggal_selesai' => '2022-08-19 19:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:16:01',
                'updated_at' => '2022-07-04 22:16:01',
            ),
            8 => 
            array (
                'id' => 9,
                'id_reservasi' => 3,
                'id_tahapan_upacara' => 4,
                'tanggal_mulai' => '2022-08-20 09:00:00',
                'tanggal_selesai' => '2022-08-20 10:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 22:16:01',
                'updated_at' => '2022-07-04 22:16:01',
            ),
            9 => 
            array (
                'id' => 10,
                'id_reservasi' => 4,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-08-24 07:00:00',
                'tanggal_selesai' => '2022-08-24 11:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 23:26:24',
                'updated_at' => '2022-07-04 23:26:24',
            ),
            10 => 
            array (
                'id' => 11,
                'id_reservasi' => 4,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-08-24 14:12:00',
                'tanggal_selesai' => '2022-08-24 19:12:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 23:26:24',
                'updated_at' => '2022-07-04 23:26:24',
            ),
            11 => 
            array (
                'id' => 12,
                'id_reservasi' => 4,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-08-25 12:00:00',
                'tanggal_selesai' => '2022-08-25 15:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 23:26:24',
                'updated_at' => '2022-07-04 23:26:24',
            ),
            12 => 
            array (
                'id' => 13,
                'id_reservasi' => 4,
                'id_tahapan_upacara' => 16,
                'tanggal_mulai' => '2022-08-26 06:00:00',
                'tanggal_selesai' => '2022-08-26 17:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 23:26:24',
                'updated_at' => '2022-07-04 23:26:24',
            ),
            13 => 
            array (
                'id' => 14,
                'id_reservasi' => 4,
                'id_tahapan_upacara' => 17,
                'tanggal_mulai' => '2022-08-25 10:00:00',
                'tanggal_selesai' => '2022-08-27 13:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-07-04 23:26:24',
                'updated_at' => '2022-07-04 23:26:24',
            ),
        ));
        
        
    }
}