<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbAtributPemuputTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_atribut_pemuput')->delete();
        
        \DB::table('tb_atribut_pemuput')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_nabe' => 6,
                'sk_pemuput' => '0',
                'tanggal_diksha' => '2022-03-13',
            ),
            1 => 
            array (
                'id' => 2,
                'id_nabe' => 54,
                'sk_pemuput' => '0',
                'tanggal_diksha' => NULL,
            ),
            2 => 
            array (
                'id' => 6,
                'id_nabe' => 5,
                'sk_pemuput' => 'app/sulinggih/sk/1651190905-screen-0jpg.jpg',
                'tanggal_diksha' => '2022-04-12',
            ),
            3 => 
            array (
                'id' => 7,
                'id_nabe' => NULL,
                'sk_pemuput' => 'app/sulinggih/sk/1651202843-tempfilejpg.jpg',
                'tanggal_diksha' => '2022-04-29',
            ),
        ));
        
        
    }
}