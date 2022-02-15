<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbMProfesiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_m_profesi')->delete();
        
        \DB::table('tb_m_profesi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'profesi' => 'Tidak/Belum Bekerja',
                'created_at' => '2022-01-30 12:09:43',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'profesi' => 'Pegawai Negeri Sipil',
                'created_at' => '2022-01-30 12:09:50',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'profesi' => 'Wiraswasta',
                'created_at' => '2022-01-30 12:09:52',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'profesi' => 'Petani',
                'created_at' => '2022-01-30 12:09:55',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'profesi' => 'Mengurus Rumah Tangga',
                'created_at' => '2022-01-30 12:09:59',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 8,
                'profesi' => 'Pelajar/Mahasiswa',
                'created_at' => '2021-10-20 14:02:27',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 10,
                'profesi' => 'Pegawai Swasta',
                'created_at' => '2021-10-20 14:02:27',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}