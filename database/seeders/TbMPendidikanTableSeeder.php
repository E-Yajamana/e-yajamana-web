<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbMPendidikanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_m_pendidikan')->delete();
        
        \DB::table('tb_m_pendidikan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'jenjang_pendidikan' => 'Tidak/Belum Bersekolah',
                'created_at' => '2022-01-30 12:07:25',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'jenjang_pendidikan' => 'Belum Tamat SD/Sederajat',
                'created_at' => '2022-01-30 12:07:18',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'jenjang_pendidikan' => 'Tamat SD/Sederajat',
                'created_at' => '2022-01-30 12:07:06',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'jenjang_pendidikan' => 'SLTP/Sederajat',
                'created_at' => '2022-01-30 12:07:03',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'jenjang_pendidikan' => 'SLTA/Sederajat',
                'created_at' => '2022-01-30 12:07:30',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'jenjang_pendidikan' => 'Diploma 1',
                'created_at' => '2022-01-30 12:08:12',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'jenjang_pendidikan' => 'Diploma 2',
                'created_at' => '2022-01-30 12:08:16',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'jenjang_pendidikan' => 'Diploma 3',
                'created_at' => '2022-01-30 12:08:29',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'jenjang_pendidikan' => 'Strata 1',
                'created_at' => '2022-01-30 12:08:34',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'jenjang_pendidikan' => 'Strata 2',
                'created_at' => '2022-01-30 12:09:01',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'jenjang_pendidikan' => 'Strata 3',
                'created_at' => '2022-01-30 12:09:02',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}