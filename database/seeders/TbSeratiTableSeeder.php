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
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'created_at' => '2022-01-19 01:59:32',
                'updated_at' => '2022-01-19 01:59:36',
            ),
        ));
        
        
    }
}