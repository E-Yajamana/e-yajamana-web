<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbSanggarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_sanggar')->delete();
        
        \DB::table('tb_sanggar')->insert(array (
            0 => 
            array (
                'id' => 5,
                'id_user' => 3,
                'id_desa' => '1101010006',
                'id_desa_adat' => 16,
                'nama_sanggar' => 'Sanggar Dalung',
                'nama_pengelola' => 'Made Pengelola',
                'alamat_sanggar' => 'Jalan dalung permai no 5',
                'sk_tanda_usaha' => 'img/default',
                'status_konfirmasi' => 'disetujui',
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'created_at' => '2022-01-15 14:04:39',
                'updated_at' => '2022-01-15 14:04:44',
            ),
        ));
        
        
    }
}