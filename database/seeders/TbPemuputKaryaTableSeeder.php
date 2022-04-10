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
                'id_pasangan' => NULL,
                'id_atribut' => 1,
                'nama_pemuput' => 'Ida Pandita Sri Agnijaya Mukhi',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-01-18 22:54:38',
                'updated_at' => '2022-01-18 22:54:40',
            ),
            1 => 
            array (
                'id' => 5,
                'id_user' => 4,
                'id_griya' => 2,
                'id_pasangan' => NULL,
                'id_atribut' => 0,
                'nama_pemuput' => 'Ida Pedande Istri Rai Kemenuh',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'tipe' => 'sulinggih',
                'created_at' => '2022-01-18 22:54:55',
                'updated_at' => '2022-01-22 15:33:22',
            ),
            2 => 
            array (
                'id' => 6,
                'id_user' => 2,
                'id_griya' => 2,
                'id_pasangan' => NULL,
                'id_atribut' => 0,
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
        ));
        
        
    }
}