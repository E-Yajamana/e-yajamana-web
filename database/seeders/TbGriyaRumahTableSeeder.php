<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbGriyaRumahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_griya_rumah')->delete();
        
        \DB::table('tb_griya_rumah')->insert(array (
            0 => 
            array (
                'id' => 2,
                'id_banjar_dinas' => 10,
                'nama_griya_rumah' => 'Griya Pesraman Kerta Sari Dalung',
                'alamat_griya_rumah' => 'Griya Pesraman Kerta Sari',
                'lat' => '-8.432590000000000000',
                'lng' => '115.098214000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-02-06 11:54:56',
            ),
            1 => 
            array (
                'id' => 4,
                'id_banjar_dinas' => 13,
                'nama_griya_rumah' => 'Manggis Karangasem',
                'alamat_griya_rumah' => 'Dukuh Badeg, Ds. Subudi',
                'lat' => '-8.432590000000000000',
                'lng' => '115.098214000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:18',
            ),
            2 => 
            array (
                'id' => 5,
                'id_banjar_dinas' => 10,
                'nama_griya_rumah' => 'Griya Candi Karang Manik',
                'alamat_griya_rumah' => 'Br. Dukuh, Ds. Dukuh Kubu, Karangasem.',
                'lat' => '-8.445112000000000000',
                'lng' => '115.193237000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            3 => 
            array (
                'id' => 6,
                'id_banjar_dinas' => 10,
                'nama_griya_rumah' => 'Griya Giri Purwa Jagat Santhi',
                'alamat_griya_rumah' => 'Ababi, Abang Karangasem.',
                'lat' => '-8.519268000000000000',
                'lng' => '115.263298000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            4 => 
            array (
                'id' => 7,
                'id_banjar_dinas' => 15,
                'nama_griya_rumah' => 'Griya  Anyar',
                'alamat_griya_rumah' => 'Amlapura Karangasem.',
                'lat' => '-8.519268000000000000',
                'lng' => '115.263298000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            5 => 
            array (
                'id' => 8,
                'id_banjar_dinas' => 21,
                'nama_griya_rumah' => 'Griya Taman Astika Meranggi',
                'alamat_griya_rumah' => 'Muncan, Selat – Karangasem.',
                'lat' => '-8.519268000000000000',
                'lng' => '115.263298000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            6 => 
            array (
                'id' => 9,
                'id_banjar_dinas' => 10,
                'nama_griya_rumah' => 'Griya Taman Telaga Mas',
                'alamat_griya_rumah' => 'Ds. Muncan, Selat – Karangasem.',
                'lat' => '-8.445112000000000000',
                'lng' => '115.193237000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            7 => 
            array (
                'id' => 10,
                'id_banjar_dinas' => 19,
                'nama_griya_rumah' => 'Griya Asti Kahuripan',
                'alamat_griya_rumah' => 'Apit Yeh, Manggis, Karangasem.',
                'lat' => '-8.519268000000000000',
                'lng' => '115.263298000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            8 => 
            array (
                'id' => 11,
                'id_banjar_dinas' => 19,
                'nama_griya_rumah' => 'Muncan, Selat – Karangasem.',
                'alamat_griya_rumah' => 'Ds. Duda Timur, Selat, Karangasem.',
                'lat' => '-8.519268000000000000',
                'lng' => '115.263298000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            9 => 
            array (
                'id' => 12,
                'id_banjar_dinas' => 19,
                'nama_griya_rumah' => 'Ds. Duda Timur, Selat, Karangasem.',
                'alamat_griya_rumah' => 'Sibetan, Bebandem – Karangasem.',
                'lat' => '-8.573663000000000000',
                'lng' => '115.276199000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            10 => 
            array (
                'id' => 13,
                'id_banjar_dinas' => 21,
                'nama_griya_rumah' => 'Griya Gede Suka Werdi',
                'alamat_griya_rumah' => 'Suwukan Menangga, Rendang, Karangasem.',
                'lat' => '-8.509348000000000000',
                'lng' => '115.309510000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
            11 => 
            array (
                'id' => 14,
                'id_banjar_dinas' => 18,
                'nama_griya_rumah' => 'Griya Taman Telaga Mas',
                'alamat_griya_rumah' => 'Ds. Muncan, Selat – Karangasem.',
                'lat' => '-8.519268000000000000',
                'lng' => '115.263298000000000000',
                'created_at' => '2022-01-18 22:35:16',
                'updated_at' => '2022-01-18 22:35:16',
            ),
        ));
        
        
    }
}