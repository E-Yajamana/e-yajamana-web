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
                'id' => 5,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 2,
                'tipe' => NULL,
                'status' => 'selesai',
                'tanggal_tangkil' => '2022-04-28 04:52:00',
                'keterangan' => NULL,
                'created_at' => '2022-04-12 15:59:08',
                'updated_at' => '2022-04-28 20:06:49',
            ),
            1 =>
            array (
                'id' => 6,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 4,
                'tipe' => NULL,
                'status' => 'proses muput',
                'tanggal_tangkil' => '2022-04-17 03:22:00',
                'keterangan' => NULL,
                'created_at' => '2022-04-17 15:21:11',
                'updated_at' => '2022-04-25 13:50:49',
            ),
            2 =>
            array (
                'id' => 7,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 3,
                'tipe' => NULL,
                'status' => 'batal',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-18 00:19:29',
                'updated_at' => '2022-04-21 20:21:53',
            ),
            3 =>
            array (
                'id' => 9,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 6,
                'tipe' => NULL,
                'status' => 'selesai',
                'tanggal_tangkil' => '2022-04-21 04:10:00',
                'keterangan' => NULL,
                'created_at' => '2022-04-21 16:06:49',
                'updated_at' => '2022-04-21 16:12:05',
            ),
            4 =>
            array (
                'id' => 10,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 7,
                'tipe' => NULL,
                'status' => 'batal',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-21 20:20:07',
                'updated_at' => '2022-04-28 11:21:31',
            ),
            5 =>
            array (
                'id' => 11,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 7,
                'tipe' => NULL,
                'status' => 'selesai',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-21 20:24:00',
                'updated_at' => '2022-04-21 20:32:03',
            ),
            6 =>
            array (
                'id' => 13,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 3,
                'tipe' => NULL,
                'status' => 'ditolak',
                'tanggal_tangkil' => '2022-04-28 12:03:00',
                'keterangan' => NULL,
                'created_at' => '2022-04-25 12:18:42',
                'updated_at' => '2022-04-28 15:47:03',
            ),
            7 =>
            array (
                'id' => 15,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 14,
                'tipe' => 'pemuput_karya',
                'status' => 'proses tangkil',
                'tanggal_tangkil' => '2022-04-29 08:17:00',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 19:24:34',
                'updated_at' => '2022-04-28 20:17:25',
            ),
            8 =>
            array (
                'id' => 16,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 15,
                'tipe' => 'pemuput_karya',
                'status' => 'selesai',
                'tanggal_tangkil' => '2022-04-01 08:01:00',
                'keterangan' => NULL,
                'created_at' => '2022-04-28 19:46:35',
                'updated_at' => '2022-04-28 20:21:02',
            ),
            9 =>
            array (
                'id' => 17,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 15,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 19:46:41',
                'updated_at' => '2022-04-28 19:46:41',
            ),
            10 =>
            array (
                'id' => 18,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 15,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 19:46:52',
                'updated_at' => '2022-04-28 19:46:52',
            ),
            11 =>
            array (
                'id' => 20,
                'id_relasi' => 2,
                'id_sanggar' => NULL,
                'id_upacaraku' => 17,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 20:14:49',
                'updated_at' => '2022-04-28 20:14:49',
            ),
            12 =>
            array (
                'id' => 22,
                'id_relasi' => 3,
                'id_sanggar' => NULL,
                'id_upacaraku' => 18,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:55:00',
                'updated_at' => '2022-04-28 23:55:00',
            ),
            13 =>
            array (
                'id' => 23,
                'id_relasi' => 49,
                'id_sanggar' => NULL,
                'id_upacaraku' => 18,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:17',
                'updated_at' => '2022-04-28 23:56:17',
            ),
            14 =>
            array (
                'id' => 24,
                'id_relasi' => 49,
                'id_sanggar' => NULL,
                'id_upacaraku' => 19,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:56:51',
                'updated_at' => '2022-04-28 23:56:51',
            ),
            15 =>
            array (
                'id' => 25,
                'id_relasi' => 3,
                'id_sanggar' => NULL,
                'id_upacaraku' => 20,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:57:30',
                'updated_at' => '2022-04-28 23:57:30',
            ),
            16 =>
            array (
                'id' => 26,
                'id_relasi' => 49,
                'id_sanggar' => NULL,
                'id_upacaraku' => 20,
                'tipe' => 'pemuput_karya',
                'status' => 'pending',
                'tanggal_tangkil' => NULL,
                'keterangan' => NULL,
                'created_at' => '2022-04-28 23:58:04',
                'updated_at' => '2022-04-28 23:58:04',
            ),
        ));


    }
}
