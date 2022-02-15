<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbKramaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_krama')->delete();
        
        \DB::table('tb_krama')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_user' => 6,
                'lat' => '-8.785502000000000000',
                'lng' => '115.199806000000000000',
                'created_at' => '2022-01-19 01:48:22',
                'updated_at' => '2022-01-19 01:48:25',
            ),
            1 => 
            array (
                'id' => 2,
                'id_user' => 11,
                'lat' => '-8.785502000000000000',
                'lng' => '115.199806000000000000',
                'created_at' => '2022-01-21 14:10:38',
                'updated_at' => '2022-01-21 14:10:40',
            ),
        ));
        
        
    }
}