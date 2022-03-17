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
                'nama_role' => 'ADMIN',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_role' => 'Krama',
            ),
            2 => 
            array (
                'id' => 3,
                'nama_role' => 'Pemuput_Karya',
            ),
            3 => 
            array (
                'id' => 4,
                'nama_role' => 'Sanggar',
            ),
            4 => 
            array (
                'id' => 5,
                'nama_role' => 'Serati',
            ),
        ));
        
        
    }
}