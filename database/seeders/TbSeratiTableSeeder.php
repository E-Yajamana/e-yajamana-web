<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbSeratiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_serati')->delete();
        
        \DB::table('tb_serati')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_user' => 5,
                'nama_serati' => NULL,
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-19 01:59:32',
                'updated_at' => '2022-01-19 01:59:36',
            ),
            1 => 
            array (
                'id' => 2,
                'id_user' => 62,
                'nama_serati' => 'Serati testing',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-05-07 06:52:45',
                'updated_at' => '2022-05-07 06:52:45',
            ),
            2 => 
            array (
                'id' => 3,
                'id_user' => 64,
                'nama_serati' => 'serati admin',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-05-07 06:53:29',
                'updated_at' => '2022-05-07 06:53:29',
            ),
        ));
        
        
    }
}