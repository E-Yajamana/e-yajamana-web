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
                'id_user' => 6,
                'id_desa' => '1101010005',
                'id_desa_adat' => 6,
                'nama_serati' => 'serita eyajamana',
                'tempat_lahir' => 'badung',
                'tanggal_lahir' => '2021-12-29',
                'jenis_kelamin' => 'laki-laki',
                'alamat_serati' => 'dalung permain',
                'status_konfirmasi' => 'disetujui',
                'lat' => '-8.451791600000000000',
                'lng' => '115.197008600000000000',
                'created_at' => '2022-01-15 15:50:45',
                'updated_at' => '2022-01-15 15:50:47',
            ),
        ));
        
        
    }
}