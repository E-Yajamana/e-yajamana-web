<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbSulinggihTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_sulinggih')->delete();
        
        \DB::table('tb_sulinggih')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_griya' => 1,
                'id_user' => 3,
                'nabe' => 1,
                'nama_walaka' => 'i wayan boy',
                'nama_sulinggih' => 'sulinggih boy',
                'nama_pasangan' => 'i wayan girl',
                'tempat_lahir' => 'singaraja',
                'tanggal_lahir' => '2022-01-13',
                'jenis_kelamin' => 'laki-laki',
                'pekerjaan' => 'petani',
                'pendidikan' => 'MAGISTER',
                'tanggal_diksha' => '2021-10-18',
                'sk_kesulinggihan' => 'image/sk-sulinggih',
                'status_konfirmasi_akun' => 'pending',
                'created_at' => '2022-01-13 23:41:40',
                'updated_at' => '2022-01-13 23:41:42',
            ),
            1 => 
            array (
                'id' => 2,
                'id_griya' => 2,
                'id_user' => 5,
                'nabe' => 1,
                'nama_walaka' => 'i wayan dima',
                'nama_sulinggih' => 'sulinggih dima',
                'nama_pasangan' => 'cowok ni men',
                'tempat_lahir' => 'badung',
                'tanggal_lahir' => '2022-01-13',
                'jenis_kelamin' => 'perempuan',
                'pekerjaan' => 'Dokter Umum',
                'pendidikan' => 'Doktor',
                'tanggal_diksha' => '2021-10-19',
                'sk_kesulinggihan' => 'image/sk-sulinggih',
                'status_konfirmasi_akun' => 'pending',
                'created_at' => '2022-01-13 23:41:44',
                'updated_at' => '2022-01-13 23:41:46',
            ),
        ));
        
        
    }
}