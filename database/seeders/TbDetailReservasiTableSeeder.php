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
                'id' => 140,
                'id_reservasi' => 54,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-06-20 00:00:00',
                'tanggal_selesai' => '2022-06-29 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 11:11:27',
                'updated_at' => '2022-05-27 11:11:27',
            ),
            1 => 
            array (
                'id' => 141,
                'id_reservasi' => 54,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-06-20 00:00:00',
                'tanggal_selesai' => '2022-06-29 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 11:11:27',
                'updated_at' => '2022-05-27 11:11:27',
            ),
            2 => 
            array (
                'id' => 142,
                'id_reservasi' => 54,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-06-20 00:00:00',
                'tanggal_selesai' => '2022-06-29 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 11:11:27',
                'updated_at' => '2022-05-27 11:11:27',
            ),
            3 => 
            array (
                'id' => 223,
                'id_reservasi' => 84,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-06-20 00:00:00',
                'tanggal_selesai' => '2022-06-29 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 12:57:24',
                'updated_at' => '2022-05-27 12:57:24',
            ),
            4 => 
            array (
                'id' => 224,
                'id_reservasi' => 84,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-06-20 00:00:00',
                'tanggal_selesai' => '2022-06-29 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 12:57:24',
                'updated_at' => '2022-05-27 12:57:24',
            ),
            5 => 
            array (
                'id' => 225,
                'id_reservasi' => 84,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-06-20 00:00:00',
                'tanggal_selesai' => '2022-06-29 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 12:57:24',
                'updated_at' => '2022-05-27 12:57:24',
            ),
            6 => 
            array (
                'id' => 226,
                'id_reservasi' => 85,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-06-20 16:00:00',
                'tanggal_selesai' => '2022-06-22 14:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 13:03:02',
                'updated_at' => '2022-05-27 13:03:02',
            ),
            7 => 
            array (
                'id' => 227,
                'id_reservasi' => 85,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-06-27 17:00:00',
                'tanggal_selesai' => '2022-06-29 17:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 13:03:03',
                'updated_at' => '2022-05-27 13:03:03',
            ),
            8 => 
            array (
                'id' => 228,
                'id_reservasi' => 85,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-06-26 20:12:00',
                'tanggal_selesai' => '2022-06-27 14:11:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-27 13:03:03',
                'updated_at' => '2022-05-27 13:03:03',
            ),
        ));
        
        
    }
}