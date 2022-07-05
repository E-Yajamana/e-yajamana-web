<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbKepemilikanSanggarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_kepemilikan_sanggar')->delete();
        
        \DB::table('tb_kepemilikan_sanggar')->insert(array (
            0 => 
            array (
                'id' => 6,
                'id_sanggar' => 5,
                'id_user' => 4,
                'jabatan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 9,
                'id_sanggar' => 9,
                'id_user' => 64,
                'jabatan' => NULL,
                'created_at' => '2022-05-07 11:58:39',
                'updated_at' => '2022-05-07 11:58:39',
            ),
            2 => 
            array (
                'id' => 10,
                'id_sanggar' => 10,
                'id_user' => 65,
                'jabatan' => 1,
                'created_at' => '2022-05-07 14:03:06',
                'updated_at' => '2022-05-07 14:03:06',
            ),
            3 => 
            array (
                'id' => 12,
                'id_sanggar' => 10,
                'id_user' => 22,
                'jabatan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 13,
                'id_sanggar' => 10,
                'id_user' => 51,
                'jabatan' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 14,
                'id_sanggar' => 11,
                'id_user' => 66,
                'jabatan' => NULL,
                'created_at' => '2022-06-13 10:06:13',
                'updated_at' => '2022-06-13 10:06:13',
            ),
            6 => 
            array (
                'id' => 17,
                'id_sanggar' => 6,
                'id_user' => 16,
                'jabatan' => NULL,
                'created_at' => '2022-06-13 18:43:29',
                'updated_at' => '2022-06-13 18:43:29',
            ),
            7 => 
            array (
                'id' => 18,
                'id_sanggar' => 6,
                'id_user' => 65,
                'jabatan' => NULL,
                'created_at' => '2022-06-13 18:57:32',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 19,
                'id_sanggar' => 12,
                'id_user' => 1,
                'jabatan' => NULL,
                'created_at' => '2022-06-13 21:04:05',
                'updated_at' => '2022-06-13 21:04:05',
            ),
            9 => 
            array (
                'id' => 20,
                'id_sanggar' => 10,
                'id_user' => 61,
                'jabatan' => NULL,
                'created_at' => '2022-06-13 21:07:08',
                'updated_at' => '2022-06-13 21:07:08',
            ),
            10 => 
            array (
                'id' => 21,
                'id_sanggar' => 13,
                'id_user' => 1,
                'jabatan' => 1,
                'created_at' => '2022-07-01 13:40:57',
                'updated_at' => '2022-07-01 13:40:57',
            ),
            11 => 
            array (
                'id' => 22,
                'id_sanggar' => 14,
                'id_user' => 1,
                'jabatan' => 1,
                'created_at' => '2022-07-01 13:47:17',
                'updated_at' => '2022-07-01 13:47:17',
            ),
            12 => 
            array (
                'id' => 23,
                'id_sanggar' => 15,
                'id_user' => 1,
                'jabatan' => 1,
                'created_at' => '2022-07-01 13:48:56',
                'updated_at' => '2022-07-01 13:48:56',
            ),
            13 => 
            array (
                'id' => 24,
                'id_sanggar' => 16,
                'id_user' => 1,
                'jabatan' => 1,
                'created_at' => '2022-07-01 13:50:58',
                'updated_at' => '2022-07-01 13:50:58',
            ),
        ));
        
        
    }
}