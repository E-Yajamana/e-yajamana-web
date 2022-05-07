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
                'keterangan' => NULL,
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
                'keterangan' => NULL,
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
                'status' => 'ditolak',
                'keterangan' => 'gak bisa hadir',
                'created_at' => '2022-04-28 23:55:00',
                'updated_at' => '2022-04-29 10:43:01',
            ),
            13 => 
            array (
                'id' => 47,
                'id_reservasi' => 22,
                'id_tahapan_upacara' => 17,
                'tanggal_mulai' => '2022-05-19 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'selesai',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:55:00',
                'updated_at' => '2022-04-29 10:55:39',
            ),
            14 => 
            array (
                'id' => 48,
                'id_reservasi' => 22,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-05-19 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'diterima',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:55:00',
                'updated_at' => '2022-04-29 10:43:01',
            ),
            15 => 
            array (
                'id' => 49,
                'id_reservasi' => 23,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-05-17 00:00:00',
                'tanggal_selesai' => '2022-05-19 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:17',
                'updated_at' => '2022-04-29 10:43:01',
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
                'tanggal_mulai' => '2022-05-23 00:00:00',
                'tanggal_selesai' => '2022-05-25 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:51',
                'updated_at' => '2022-04-29 09:36:43',
            ),
            19 => 
            array (
                'id' => 53,
                'id_reservasi' => 25,
                'id_tahapan_upacara' => 20,
                'tanggal_mulai' => '2022-05-24 00:00:00',
                'tanggal_selesai' => '2022-05-24 00:00:00',
                'status' => 'diterima',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:57:31',
                'updated_at' => '2022-04-29 10:46:41',
            ),
            20 => 
            array (
                'id' => 54,
                'id_reservasi' => 25,
                'id_tahapan_upacara' => 22,
                'tanggal_mulai' => '2022-05-24 00:00:00',
                'tanggal_selesai' => '2022-05-24 00:00:00',
                'status' => 'diterima',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:57:31',
                'updated_at' => '2022-04-29 10:46:41',
            ),
            21 => 
            array (
                'id' => 55,
                'id_reservasi' => 26,
                'id_tahapan_upacara' => 20,
                'tanggal_mulai' => '2022-05-15 00:00:00',
                'tanggal_selesai' => '2022-05-24 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:58:04',
                'updated_at' => '2022-04-29 07:32:26',
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
            23 => 
            array (
                'id' => 57,
                'id_reservasi' => 27,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-05-04 08:58:00',
                'tanggal_selesai' => '2022-05-05 08:58:00',
                'status' => 'selesai',
                'keterangan' => '',
                'created_at' => NULL,
                'updated_at' => '2022-04-29 09:04:43',
            ),
            24 => 
            array (
                'id' => 58,
                'id_reservasi' => 24,
                'id_tahapan_upacara' => 25,
                'tanggal_mulai' => '2022-05-25 00:00:00',
                'tanggal_selesai' => '2022-05-25 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-29 09:36:20',
                'updated_at' => '2022-04-29 09:37:07',
            ),
            25 => 
            array (
                'id' => 59,
                'id_reservasi' => 28,
                'id_tahapan_upacara' => 11,
                'tanggal_mulai' => '2022-04-14 00:00:00',
                'tanggal_selesai' => '2022-04-14 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-29 10:36:30',
                'updated_at' => '2022-04-29 10:36:30',
            ),
            26 => 
            array (
                'id' => 60,
                'id_reservasi' => 28,
                'id_tahapan_upacara' => 14,
                'tanggal_mulai' => '2022-04-14 00:00:00',
                'tanggal_selesai' => '2022-04-14 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-29 10:36:30',
                'updated_at' => '2022-04-29 10:36:30',
            ),
            27 => 
            array (
                'id' => 61,
                'id_reservasi' => 28,
                'id_tahapan_upacara' => 15,
                'tanggal_mulai' => '2022-04-14 00:00:00',
                'tanggal_selesai' => '2022-04-14 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-29 10:36:30',
                'updated_at' => '2022-04-29 10:36:30',
            ),
            28 => 
            array (
                'id' => 62,
                'id_reservasi' => 28,
                'id_tahapan_upacara' => 17,
                'tanggal_mulai' => '2022-04-12 00:00:00',
                'tanggal_selesai' => '2022-04-14 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-04-29 10:37:45',
                'updated_at' => '2022-04-29 10:37:45',
            ),
            29 => 
            array (
                'id' => 63,
                'id_reservasi' => 29,
                'id_tahapan_upacara' => 1,
                'tanggal_mulai' => '2022-05-01 10:09:00',
                'tanggal_selesai' => '2022-05-02 11:09:00',
                'status' => 'selesai',
                'keterangan' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-29 11:18:12',
            ),
        ));
        
        
    }
}