<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbPemuputKaryaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_pemuput_karya')->delete();
        
        \DB::table('tb_pemuput_karya')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_user' => 2,
                'id_griya' => 2,
                'id_pasangan' => 62,
                'id_atribut' => 1,
                'nama_pemuput' => 'Ida Pandita Sri Agnijaya Mukhi',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-01-18 22:54:38',
                'updated_at' => '2022-05-05 09:48:20',
            ),
            1 => 
            array (
                'id' => 5,
                'id_user' => 4,
                'id_griya' => 2,
                'id_pasangan' => 66,
                'id_atribut' => 1,
                'nama_pemuput' => 'Ida Pedande Istri Rai Kemenuh',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-01-18 22:54:55',
                'updated_at' => '2022-05-07 06:05:31',
            ),
            2 => 
            array (
                'id' => 6,
                'id_user' => 2,
                'id_griya' => 2,
                'id_pasangan' => NULL,
                'id_atribut' => 6,
                'nama_pemuput' => 'Pedanda Gede Bajing',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-01-19 01:36:55',
                'updated_at' => '2022-01-19 01:37:00',
            ),
            3 => 
            array (
                'id' => 54,
                'id_user' => 49,
                'id_griya' => 14,
                'id_pasangan' => 19,
                'id_atribut' => 1,
                'nama_pemuput' => 'Ida Pedande watu',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 55,
                'id_user' => 3,
                'id_griya' => 7,
                'id_pasangan' => 5,
                'id_atribut' => 2,
                'nama_pemuput' => 'Ida Gede Dalem Jineng',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'pemangku',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 57,
                'id_user' => 58,
                'id_griya' => 4,
                'id_pasangan' => NULL,
                'id_atribut' => 6,
                'nama_pemuput' => 'ida pedande',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-04-29 08:08:25',
                'updated_at' => '2022-04-29 10:08:41',
            ),
            6 => 
            array (
                'id' => 60,
                'id_user' => 51,
                'id_griya' => 7,
                'id_pasangan' => NULL,
                'id_atribut' => 9,
                'nama_pemuput' => 'Ida Pedande Ratu Dalung',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-05-05 08:27:53',
                'updated_at' => '2022-05-05 09:52:39',
            ),
            7 => 
            array (
                'id' => 61,
                'id_user' => 60,
                'id_griya' => 2,
                'id_pasangan' => NULL,
                'id_atribut' => 10,
                'nama_pemuput' => 'testingSulinggih',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-05-05 09:47:22',
                'updated_at' => '2022-05-07 21:47:13',
            ),
            8 => 
            array (
                'id' => 62,
                'id_user' => 61,
                'id_griya' => 2,
                'id_pasangan' => 1,
                'id_atribut' => 1,
                'nama_pemuput' => 'pasangan',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-05-05 09:48:20',
                'updated_at' => '2022-05-20 12:16:57',
            ),
            9 => 
            array (
                'id' => 63,
                'id_user' => 62,
                'id_griya' => 8,
                'id_pasangan' => NULL,
                'id_atribut' => 11,
                'nama_pemuput' => 'Jro Pemangku Rismawan',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'pemangku',
                'created_at' => '2022-05-06 04:18:02',
                'updated_at' => '2022-05-25 21:25:46',
            ),
            10 => 
            array (
                'id' => 66,
                'id_user' => 63,
                'id_griya' => 2,
                'id_pasangan' => 5,
                'id_atribut' => 1,
                'nama_pemuput' => 'Testung',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-05-07 06:05:31',
                'updated_at' => '2022-05-07 12:16:07',
            ),
            11 => 
            array (
                'id' => 67,
                'id_user' => 64,
                'id_griya' => 9,
                'id_pasangan' => NULL,
                'id_atribut' => 12,
                'nama_pemuput' => 'Testing Sulinggih',
                'status_konfirmasi_akun' => 'ditolak',
                'keterangan_konfirmasi_akun' => 'Terdapat data yang tidak sesuai dimasukan',
                'tipe' => 'sulinggih',
                'created_at' => '2022-05-07 12:01:34',
                'updated_at' => '2022-05-07 12:16:01',
            ),
        ));
        
        
    }
}