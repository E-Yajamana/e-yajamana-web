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
                'id' => 22,
                'id_reservasi' => 5,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-28 04:52:00',
                'tanggal_selesai' => '2022-04-29 04:52:00',
                'status' => 'batal',
                'keterangan' => 'Kondisi tidak memungkinkan untuk Muput',
                'created_at' => NULL,
                'updated_at' => '2022-04-28 20:06:49',
            ),
            1 => 
            array (
                'id' => 23,
                'id_reservasi' => 6,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-17 03:20:00',
                'tanggal_selesai' => '2022-04-18 03:21:00',
                'status' => 'diterima',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-25 13:50:49',
            ),
            2 => 
            array (
                'id' => 24,
                'id_reservasi' => 7,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-18 12:19:00',
                'tanggal_selesai' => '2022-04-19 12:19:00',
                'status' => 'batal',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-21 20:21:53',
            ),
            3 => 
            array (
                'id' => 26,
                'id_reservasi' => 9,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-05-01 01:00:00',
                'tanggal_selesai' => '2022-05-02 01:00:00',
                'status' => 'selesai',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-21 16:12:05',
            ),
            4 => 
            array (
                'id' => 27,
                'id_reservasi' => 10,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-05-01 08:19:00',
                'tanggal_selesai' => '2022-05-02 08:19:00',
                'status' => 'batal',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-21 20:28:59',
            ),
            5 => 
            array (
                'id' => 28,
                'id_reservasi' => 11,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-05-01 08:23:00',
                'tanggal_selesai' => '2022-05-02 08:23:00',
                'status' => 'selesai',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-21 20:32:02',
            ),
            6 => 
            array (
                'id' => 30,
                'id_reservasi' => 13,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-25 12:18:00',
                'tanggal_selesai' => '2022-04-26 12:18:00',
                'status' => 'ditolak',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-28 15:47:03',
            ),
            7 => 
            array (
                'id' => 38,
                'id_reservasi' => 15,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-28 07:24:00',
                'tanggal_selesai' => '2022-04-29 07:24:00',
                'status' => 'diterima',
                'keterangan' => '',
                'created_at' => NULL,
                'updated_at' => '2022-04-28 20:17:25',
            ),
            8 => 
            array (
                'id' => 39,
                'id_reservasi' => 16,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-28 07:46:00',
                'tanggal_selesai' => '2022-04-29 07:46:00',
                'status' => 'selesai',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-28 20:21:01',
            ),
            9 => 
            array (
                'id' => 40,
                'id_reservasi' => 17,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-29 08:19:00',
                'tanggal_selesai' => '2022-04-30 08:19:00',
                'status' => 'pending',
                'keterangan' => 'test',
                'created_at' => NULL,
                'updated_at' => '2022-04-28 20:19:39',
            ),
            10 => 
            array (
                'id' => 41,
                'id_reservasi' => 18,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-29 08:19:00',
                'tanggal_selesai' => '2022-04-30 08:19:00',
                'status' => 'pending',
                'keterangan' => 'test',
                'created_at' => NULL,
                'updated_at' => '2022-04-28 20:19:39',
            ),
            11 => 
            array (
                'id' => 43,
                'id_reservasi' => 20,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-04-01 06:14:00',
                'tanggal_selesai' => '2022-04-02 08:14:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 46,
                'id_reservasi' => 22,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-05-19 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:55:00',
                'updated_at' => '2022-04-28 23:55:00',
            ),
            13 => 
            array (
                'id' => 47,
                'id_reservasi' => 22,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-05-19 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:55:00',
                'updated_at' => '2022-04-28 23:55:00',
            ),
            14 => 
            array (
                'id' => 48,
                'id_reservasi' => 22,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-05-19 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:55:00',
                'updated_at' => '2022-04-28 23:55:00',
            ),
            15 => 
            array (
                'id' => 49,
                'id_reservasi' => 23,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-05-03 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:17',
                'updated_at' => '2022-04-28 23:56:17',
            ),
            16 => 
            array (
                'id' => 50,
                'id_reservasi' => 23,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-05-19 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:17',
                'updated_at' => '2022-04-28 23:56:17',
            ),
            17 => 
            array (
                'id' => 51,
                'id_reservasi' => 23,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-05-19 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:17',
                'updated_at' => '2022-04-28 23:56:17',
            ),
            18 => 
            array (
                'id' => 52,
                'id_reservasi' => 24,
                'id_tahapan_upacara' => 23,
                'tanggal_mulai' => '2022-05-25 00:00:00',
                'tanggal_selesai' => '2022-05-25 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:51',
                'updated_at' => '2022-04-28 23:56:51',
            ),
            19 => 
            array (
                'id' => 53,
                'id_reservasi' => 25,
                'id_tahapan_upacara' => 20,
                'tanggal_mulai' => '2022-05-24 00:00:00',
                'tanggal_selesai' => '2022-05-24 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:57:31',
                'updated_at' => '2022-04-28 23:57:31',
            ),
            20 => 
            array (
                'id' => 54,
                'id_reservasi' => 25,
                'id_tahapan_upacara' => 22,
                'tanggal_mulai' => '2022-05-24 00:00:00',
                'tanggal_selesai' => '2022-05-24 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:57:31',
                'updated_at' => '2022-04-28 23:57:31',
            ),
            21 => 
            array (
                'id' => 55,
                'id_reservasi' => 26,
                'id_tahapan_upacara' => 20,
                'tanggal_mulai' => '2022-05-24 00:00:00',
                'tanggal_selesai' => '2022-05-24 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:58:04',
                'updated_at' => '2022-04-28 23:58:04',
            ),
            22 => 
            array (
                'id' => 56,
                'id_reservasi' => 26,
                'id_tahapan_upacara' => 22,
                'tanggal_mulai' => '2022-05-24 00:00:00',
                'tanggal_selesai' => '2022-05-24 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:58:04',
                'updated_at' => '2022-04-28 23:58:04',
            ),
        ));
        
        
    }
}