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
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 7,
                'id_sanggar' => 6,
                'id_user' => 65,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 9,
                'id_sanggar' => 9,
                'id_user' => 64,
                'created_at' => '2022-05-07 11:58:39',
                'updated_at' => '2022-05-07 11:58:39',
            ),
            3 => 
            array (
                'id' => 10,
                'id_sanggar' => 10,
                'id_user' => 65,
                'created_at' => '2022-05-07 14:03:06',
                'updated_at' => '2022-05-07 14:03:06',
            ),
            4 => 
            array (
                'id' => 11,
                'id_sanggar' => 6,
                'id_user' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 12,
                'id_sanggar' => 6,
                'id_user' => 22,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 13,
                'id_sanggar' => 6,
                'id_user' => 51,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}