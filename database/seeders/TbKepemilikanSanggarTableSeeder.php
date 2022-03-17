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
                'id_user' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}