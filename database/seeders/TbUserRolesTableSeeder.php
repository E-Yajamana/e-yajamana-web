<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUserRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_user_roles')->delete();
        
        \DB::table('tb_user_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_user' => 1,
                'id_role' => 1,
                'created_at' => '2022-03-17 10:03:30',
                'updated_at' => '2022-03-17 10:03:28',
            ),
            1 => 
            array (
                'id' => 2,
                'id_user' => 2,
                'id_role' => 2,
                'created_at' => '2022-03-17 10:03:53',
                'updated_at' => '2022-03-17 10:03:56',
            ),
            2 => 
            array (
                'id' => 3,
                'id_user' => 2,
                'id_role' => 3,
                'created_at' => '2022-03-17 10:03:51',
                'updated_at' => '2022-03-17 10:03:54',
            ),
            3 => 
            array (
                'id' => 4,
                'id_user' => 51,
                'id_role' => 2,
                'created_at' => '2022-03-17 10:05:05',
                'updated_at' => '2022-03-17 10:05:07',
            ),
            4 => 
            array (
                'id' => 5,
                'id_user' => 4,
                'id_role' => 2,
                'created_at' => '2022-03-17 10:05:52',
                'updated_at' => '2022-03-17 10:05:55',
            ),
            5 => 
            array (
                'id' => 6,
                'id_user' => 4,
                'id_role' => 4,
                'created_at' => '2022-03-17 10:05:53',
                'updated_at' => '2022-03-17 10:05:56',
            ),
            6 => 
            array (
                'id' => 7,
                'id_user' => 4,
                'id_role' => 3,
                'created_at' => '2022-03-17 10:05:58',
                'updated_at' => '2022-03-17 10:06:00',
            ),
            7 => 
            array (
                'id' => 9,
                'id_user' => 49,
                'id_role' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'id_user' => 49,
                'id_role' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}