<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_role')->delete();
        
        \DB::table('tb_role')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_role' => 'admin',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_role' => 'krama',
            ),
            2 => 
            array (
                'id' => 3,
                'nama_role' => 'pemuput_karya',
            ),
            3 => 
            array (
                'id' => 4,
                'nama_role' => 'sanggar',
            ),
            4 => 
            array (
                'id' => 5,
                'nama_role' => 'serati',
            ),
        ));
        
        
    }
}