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
                'id' => 21,
                'id_banjar_dinas' => 16,
                'id_upacara' => 2,
                'id_krama' => 2,
                'nama_upacara' => 'Ngeteg Linggih Cemara',
                'alamat_upacaraku' => 'Perumahan cemara giri graha utama II No 29',
                'tanggal_mulai' => '2022-02-15',
                'tanggal_selesai' => '2022-02-23',
                'deskripsi_upacaraku' => 'Ngeteg linggih adalah tradisi turun temurun',
                'status' => 'pending',
                'lat' => '-8.534577561443303000',
                'lng' => '115.261962907388820000',
                'created_at' => '2022-02-13 19:40:23',
                'updated_at' => '2022-02-19 22:43:59',
            ),
            1 =>
            array (
                'id' => 22,
                'id_banjar_dinas' => 16,
                'id_upacara' => 3,
                'id_krama' => 2,
                'nama_upacara' => 'Piodalan Ring Pura Keramasa',
                'alamat_upacaraku' => 'Perumahan Keramas no 154',
                'tanggal_mulai' => '2022-02-24',
                'tanggal_selesai' => '2022-02-26',
                'deskripsi_upacaraku' => 'deskripsi upacara keramas',
                'status' => 'pending',
                'lat' => '-8.588897084373947000',
                'lng' => '115.271850619465110000',
                'created_at' => '2022-02-13 20:06:35',
                'updated_at' => '2022-02-13 20:06:35',
            ),
            2 =>
            array (
                'id' => 23,
                'id_banjar_dinas' => 16,
                'id_upacara' => 7,
                'id_krama' => 1,
                'nama_upacara' => 'Mecaru di Jembrana',
                'alamat_upacaraku' => 'Jembraan Jalan kedewatan no 153',
                'tanggal_mulai' => '2022-02-20',
                'tanggal_selesai' => '2022-02-24',
                'deskripsi_upacaraku' => 'Upacara yang dilaksanakan selama seminggu sekali',
                'status' => 'pending',
                'lat' => '-8.578908910980676000',
                'lng' => '115.223065741759110000',
                'created_at' => '2022-02-19 19:57:30',
                'updated_at' => '2022-02-19 20:09:04',
            ),
            3 =>
            array (
                'id' => 24,
                'id_banjar_dinas' => 16,
                'id_upacara' => 6,
                'id_krama' => 51,
                'nama_upacara' => 'Atma Wedana Testing Upacara',
                'alamat_upacaraku' => 'Kabupaten Jembrana Kecamatan Apakaden ni',
                'tanggal_mulai' => '2022-04-20',
                'tanggal_selesai' => '2022-04-27',
                'deskripsi_upacaraku' => 'Testing Upacara',
                'status' => 'pending',
                'lat' => '-8.525885734177315000',
                'lng' => '115.108154313638820000',
                'created_at' => '2022-03-17 11:20:13',
                'updated_at' => '2022-03-17 11:20:13',
            ),
            4 =>
            array (
                'id' => 25,
                'id_banjar_dinas' => 16,
                'id_upacara' => 6,
                'id_krama' => 51,
                'nama_upacara' => 'Apakaden Testing',
                'alamat_upacaraku' => 'Kabupaten Jembrana Kecamatan Apakaden ni',
                'tanggal_mulai' => '2022-04-20',
                'tanggal_selesai' => '2022-04-27',
                'deskripsi_upacaraku' => 'Testing Upacara',
                'status' => 'pending',
                'lat' => '-8.525885734177315000',
                'lng' => '115.108154313638820000',
                'created_at' => '2022-03-17 11:20:13',
                'updated_at' => '2022-03-17 11:20:13',
            ),
        ));


    }
}
