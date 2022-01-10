<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbSulinggihTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_sulinggih')->delete();

        DB::table('tb_sulinggih')->insert(array (
            0 =>
            array (
                'id_sulinggih' => 1,
                'id_griya' => 1,
                'id_user' => 3,
                'nabe' => 1,
                'nama_walaka' => 'i wayan boy',
                'nama_sulinggih' => 'sulinggih boy',
                'tgl_diksha' => '2021-10-18',
                'status_konfirmasi_akun' => 'terkonfirmasi',
                'sk_kesulinggihan' => 'image/sk-sulinggih',
                'image' => 'image/profile',
            ),
            1 =>
            array (
                'id_sulinggih' => 2,
                'id_griya' => 2,
                'id_user' => 5,
                'nabe' => 1,
                'nama_walaka' => 'i wayan dima',
                'nama_sulinggih' => 'sulinggih dima',
                'tgl_diksha' => '2021-10-19',
                'status_konfirmasi_akun' => 'terkonfirmasi',
                'sk_kesulinggihan' => 'image/sk-sulinggih',
                'image' => 'image/profile',
            ),
        ));


    }
}
