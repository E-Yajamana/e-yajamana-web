<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUpacarakuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_upacaraku')->delete();
        
        \DB::table('tb_upacaraku')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_banjar_dinas' => 11,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'Mepandes Alin',
                'alamat_upacaraku' => 'Gianyar Tegal Tugu',
                'tanggal_mulai' => '2021-10-21',
                'tanggal_selesai' => '2021-10-30',
                'deskripsi_upacaraku' => 'Mepandes putu alin',
                'status' => 'pending',
                'lat' => '-8.785502000000000000',
                'lng' => '115.199806000000000000',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_banjar_dinas' => 22,
                'id_upacara' => 2,
                'id_krama' => 1,
                'nama_upacara' => 'Ngenteg Linggih',
                'alamat_upacaraku' => 'Dalung Permai',
                'tanggal_mulai' => '2021-10-21',
                'tanggal_selesai' => '2021-10-29',
                'deskripsi_upacaraku' => 'Ngenteg Linggih Rimsawan',
                'status' => 'pending',
                'lat' => '-8.785502000000000000',
                'lng' => '115.199806000000000000',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_banjar_dinas' => 20,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'potong gigi',
                'alamat_upacaraku' => 'jln banteng no 16',
                'tanggal_mulai' => '2022-01-21',
                'tanggal_selesai' => '2022-01-31',
                'deskripsi_upacaraku' => 'Upacara Potong Gigi Putu Alex',
                'status' => 'pending',
                'lat' => '-8.544880839165002000',
                'lng' => '115.307327024638650000',
                'created_at' => '2022-01-20 23:48:21',
                'updated_at' => '2022-01-20 23:48:21',
            ),
            3 => 
            array (
                'id' => 8,
                'id_banjar_dinas' => 19,
                'id_upacara' => 3,
                'id_krama' => 2,
                'nama_upacara' => 'Piodalan Ring Pura Tegal Tugu',
                'alamat_upacaraku' => 'Jalan Ratna No 14',
                'tanggal_mulai' => '2022-01-21',
                'tanggal_selesai' => '2022-03-10',
                'deskripsi_upacaraku' => 'Piodalan ring pura dilaksanakan setahun sekali',
                'status' => 'pending',
                'lat' => '-8.785502000000000000',
                'lng' => '115.199806000000000000',
                'created_at' => '2022-01-21 14:12:32',
                'updated_at' => '2022-01-21 14:12:35',
            ),
            4 => 
            array (
                'id' => 9,
                'id_banjar_dinas' => 18,
                'id_upacara' => 2,
                'id_krama' => 2,
                'nama_upacara' => 'Ngeteg Linggih Rismawan',
                'alamat_upacaraku' => 'Perumahan Cemara Giri Graha Utama 2',
                'tanggal_mulai' => '2022-01-25',
                'tanggal_selesai' => '2022-01-27',
                'deskripsi_upacaraku' => 'Acara ini merupakan tradisi pada tahun ke tahun sih',
                'status' => 'pending',
                'lat' => '-8.530723997719216000',
                'lng' => '115.161575320526040000',
                'created_at' => '2022-01-24 04:18:03',
                'updated_at' => '2022-01-24 04:18:03',
            ),
            5 => 
            array (
                'id' => 10,
                'id_banjar_dinas' => 17,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'Potong Gigi Adik',
                'alamat_upacaraku' => 'not found location',
                'tanggal_mulai' => '2022-01-28',
                'tanggal_selesai' => NULL,
                'deskripsi_upacaraku' => NULL,
                'status' => 'pending',
                'lat' => '-8.671713711334464000',
                'lng' => '115.218540541827680000',
                'created_at' => '2022-01-27 23:08:10',
                'updated_at' => '2022-01-27 23:08:10',
            ),
            6 => 
            array (
                'id' => 11,
                'id_banjar_dinas' => 13,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'Potong Gigi Adik',
                'alamat_upacaraku' => 'not found location',
                'tanggal_mulai' => '2022-01-01',
                'tanggal_selesai' => NULL,
                'deskripsi_upacaraku' => NULL,
                'status' => 'pending',
                'lat' => '-8.544665991796604000',
                'lng' => '115.307317301630960000',
                'created_at' => '2022-01-27 23:19:29',
                'updated_at' => '2022-01-27 23:19:29',
            ),
            7 => 
            array (
                'id' => 12,
                'id_banjar_dinas' => 14,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'Mepandes Putu Alin',
                'alamat_upacaraku' => NULL,
                'tanggal_mulai' => '2021-01-01',
                'tanggal_selesai' => NULL,
                'deskripsi_upacaraku' => NULL,
                'status' => 'pending',
                'lat' => '-8.785502000000000000',
                'lng' => '115.199806000000000000',
                'created_at' => '2022-01-27 23:24:39',
                'updated_at' => '2022-01-27 23:24:39',
            ),
            8 => 
            array (
                'id' => 13,
                'id_banjar_dinas' => 15,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'Mepandes Putu Alin',
                'alamat_upacaraku' => NULL,
                'tanggal_mulai' => '2021-01-01',
                'tanggal_selesai' => '2022-02-02',
                'deskripsi_upacaraku' => NULL,
                'status' => 'pending',
                'lat' => '-8.785502000000000000',
                'lng' => '115.199806000000000000',
                'created_at' => '2022-01-27 23:25:26',
                'updated_at' => '2022-01-27 23:25:26',
            ),
            9 => 
            array (
                'id' => 14,
                'id_banjar_dinas' => 17,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'hehe',
                'alamat_upacaraku' => 'not found location',
                'tanggal_mulai' => '2022-02-01',
                'tanggal_selesai' => '2022-02-05',
                'deskripsi_upacaraku' => 'Upacata Potong Gigi Adik',
                'status' => 'pending',
                'lat' => '-8.544616921701655000',
                'lng' => '115.307275727391230000',
                'created_at' => '2022-01-27 23:36:40',
                'updated_at' => '2022-01-27 23:36:40',
            ),
            10 => 
            array (
                'id' => 15,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 2,
                'nama_upacara' => 'Mepandes diBanjar Gede',
                'alamat_upacaraku' => 'Badung Apam men ya',
                'tanggal_mulai' => '2022-01-13',
                'tanggal_selesai' => '2022-01-28',
                'deskripsi_upacaraku' => 'Potong gigi secara masalh sih maunya',
                'status' => 'pending',
                'lat' => '-8.570723531417086000',
                'lng' => '115.220756528433430000',
                'created_at' => '2022-01-28 10:42:34',
                'updated_at' => '2022-01-28 10:42:34',
            ),
            11 => 
            array (
                'id' => 16,
                'id_banjar_dinas' => 18,
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'Upacara Potong Gigi Adik',
                'alamat_upacaraku' => NULL,
                'tanggal_mulai' => '2022-02-01',
                'tanggal_selesai' => '2022-02-05',
                'deskripsi_upacaraku' => 'Upacara potong gigi adik',
                'status' => 'pending',
                'lat' => '-8.540372334597201000',
                'lng' => '115.314705446362500000',
                'created_at' => '2022-01-28 12:15:57',
                'updated_at' => '2022-01-28 12:15:57',
            ),
            12 => 
            array (
                'id' => 17,
                'id_banjar_dinas' => 16,
                'id_upacara' => 2,
                'id_krama' => 2,
                'nama_upacara' => 'testing upacara',
                'alamat_upacaraku' => 'Perumahan Cemara Giri',
                'tanggal_mulai' => '2022-06-02',
                'tanggal_selesai' => '2022-06-02',
                'deskripsi_upacaraku' => 'Upacara Potong gigi',
                'status' => 'pending',
                'lat' => '-8.568256578377063000',
                'lng' => '115.104858381673710000',
                'created_at' => '2022-02-06 15:54:11',
                'updated_at' => '2022-02-06 15:54:11',
            ),
            13 => 
            array (
                'id' => 20,
                'id_banjar_dinas' => 16,
                'id_upacara' => 2,
                'id_krama' => 1,
                'nama_upacara' => 'jdjdjd',
                'alamat_upacaraku' => NULL,
                'tanggal_mulai' => '2022-02-07',
                'tanggal_selesai' => NULL,
                'deskripsi_upacaraku' => NULL,
                'status' => 'pending',
                'lat' => '-8.440004746110139000',
                'lng' => '115.274150781333430000',
                'created_at' => '2022-02-07 19:47:49',
                'updated_at' => '2022-02-07 19:47:49',
            ),
        ));
        
        
    }
}