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
            9 => 
            array (
                'id' => 229,
                'id_reservasi' => 86,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-06-26 14:12:00',
                'tanggal_selesai' => '2022-06-29 14:13:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:05:26',
                'updated_at' => '2022-05-31 12:05:26',
            ),
            10 => 
            array (
                'id' => 230,
                'id_reservasi' => 86,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-06-27 12:15:00',
                'tanggal_selesai' => '2022-06-29 19:12:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:05:26',
                'updated_at' => '2022-05-31 12:05:26',
            ),
            11 => 
            array (
                'id' => 231,
                'id_reservasi' => 86,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-06-26 09:11:00',
                'tanggal_selesai' => '2022-06-29 11:12:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:05:26',
                'updated_at' => '2022-05-31 12:05:26',
            ),
            12 => 
            array (
                'id' => 236,
                'id_reservasi' => 89,
                'id_tahapan_upacara' => 28,
                'tanggal_mulai' => '2022-06-22 00:00:00',
                'tanggal_selesai' => '2022-06-30 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:11:16',
                'updated_at' => '2022-05-31 12:11:16',
            ),
            13 => 
            array (
                'id' => 237,
                'id_reservasi' => 89,
                'id_tahapan_upacara' => 29,
                'tanggal_mulai' => '2022-06-22 00:00:00',
                'tanggal_selesai' => '2022-06-30 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:11:16',
                'updated_at' => '2022-05-31 12:11:16',
            ),
            14 => 
            array (
                'id' => 238,
                'id_reservasi' => 90,
                'id_tahapan_upacara' => 28,
                'tanggal_mulai' => '2022-06-27 12:09:00',
                'tanggal_selesai' => '2022-06-29 10:10:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:12:39',
                'updated_at' => '2022-05-31 12:12:39',
            ),
            15 => 
            array (
                'id' => 239,
                'id_reservasi' => 90,
                'id_tahapan_upacara' => 29,
                'tanggal_mulai' => '2022-06-27 07:08:00',
                'tanggal_selesai' => '2022-06-30 05:12:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:12:39',
                'updated_at' => '2022-05-31 12:12:39',
            ),
            16 => 
            array (
                'id' => 240,
                'id_reservasi' => 90,
                'id_tahapan_upacara' => 31,
                'tanggal_mulai' => '2022-06-26 08:10:00',
                'tanggal_selesai' => '2022-06-30 09:10:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:12:39',
                'updated_at' => '2022-05-31 12:12:39',
            ),
            17 => 
            array (
                'id' => 241,
                'id_reservasi' => 90,
                'id_tahapan_upacara' => 32,
                'tanggal_mulai' => '2022-06-27 09:08:00',
                'tanggal_selesai' => '2022-06-30 17:11:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-05-31 12:12:40',
                'updated_at' => '2022-05-31 12:12:40',
            ),
        ));
        
        
    }
}