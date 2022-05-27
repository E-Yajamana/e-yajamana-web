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
            9 => 
            array (
                'id' => 11,
                'id_user' => 3,
                'id_role' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'id_user' => 3,
                'id_role' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 26,
                'id_user' => 58,
                'id_role' => 2,
                'created_at' => '2022-04-29 08:08:25',
                'updated_at' => '2022-04-29 08:08:25',
            ),
            12 => 
            array (
                'id' => 27,
                'id_user' => 58,
                'id_role' => 3,
                'created_at' => '2022-04-29 08:08:25',
                'updated_at' => '2022-04-29 08:08:25',
            ),
            13 => 
            array (
                'id' => 28,
                'id_user' => 6,
                'id_role' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 53,
                'id_user' => 51,
                'id_role' => 3,
                'created_at' => '2022-05-05 08:27:53',
                'updated_at' => '2022-05-05 08:27:53',
            ),
            15 => 
            array (
                'id' => 54,
                'id_user' => 60,
                'id_role' => 2,
                'created_at' => '2022-05-05 09:47:22',
                'updated_at' => '2022-05-05 09:47:22',
            ),
            16 => 
            array (
                'id' => 55,
                'id_user' => 60,
                'id_role' => 3,
                'created_at' => '2022-05-05 09:47:22',
                'updated_at' => '2022-05-05 09:47:22',
            ),
            17 => 
            array (
                'id' => 56,
                'id_user' => 61,
                'id_role' => 2,
                'created_at' => '2022-05-05 09:48:20',
                'updated_at' => '2022-05-05 09:48:20',
            ),
            18 => 
            array (
                'id' => 57,
                'id_user' => 61,
                'id_role' => 3,
                'created_at' => '2022-05-05 09:48:20',
                'updated_at' => '2022-05-05 09:48:20',
            ),
            19 => 
            array (
                'id' => 58,
                'id_user' => 62,
                'id_role' => 2,
                'created_at' => '2022-05-06 04:18:02',
                'updated_at' => '2022-05-06 04:18:02',
            ),
            20 => 
            array (
                'id' => 59,
                'id_user' => 62,
                'id_role' => 3,
                'created_at' => '2022-05-06 04:18:02',
                'updated_at' => '2022-05-06 04:18:02',
            ),
            21 => 
            array (
                'id' => 61,
                'id_user' => 63,
                'id_role' => 2,
                'created_at' => '2022-05-06 22:54:31',
                'updated_at' => '2022-05-06 22:54:31',
            ),
            22 => 
            array (
                'id' => 65,
                'id_user' => 63,
                'id_role' => 3,
                'created_at' => '2022-05-07 06:05:31',
                'updated_at' => '2022-05-07 06:05:31',
            ),
            23 => 
            array (
                'id' => 66,
                'id_user' => 62,
                'id_role' => 5,
                'created_at' => '2022-05-07 06:52:45',
                'updated_at' => '2022-05-07 06:52:45',
            ),
            24 => 
            array (
                'id' => 67,
                'id_user' => 64,
                'id_role' => 2,
                'created_at' => '2022-05-07 06:53:29',
                'updated_at' => '2022-05-07 06:53:29',
            ),
            25 => 
            array (
                'id' => 68,
                'id_user' => 64,
                'id_role' => 5,
                'created_at' => '2022-05-07 06:53:29',
                'updated_at' => '2022-05-07 06:53:29',
            ),
            26 => 
            array (
                'id' => 69,
                'id_user' => 64,
                'id_role' => 3,
                'created_at' => '2022-05-07 12:01:34',
                'updated_at' => '2022-05-07 12:01:34',
            ),
            27 => 
            array (
                'id' => 70,
                'id_user' => 65,
                'id_role' => 2,
                'created_at' => '2022-05-07 14:03:06',
                'updated_at' => '2022-05-07 14:03:06',
            ),
            28 => 
            array (
                'id' => 71,
                'id_user' => 65,
                'id_role' => 4,
                'created_at' => '2022-05-07 14:03:06',
                'updated_at' => '2022-05-07 14:03:06',
            ),
        ));
        
        
    }
}