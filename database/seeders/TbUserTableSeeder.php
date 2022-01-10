<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_user')->delete();
        
        
        
    }
}