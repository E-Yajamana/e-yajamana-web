<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbProvinsiBaruTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_provinsi_baru')->delete();
        
        \DB::table('tb_provinsi_baru')->insert(array (
            0 => 
            array (
                'id_provinsi' => '11',
                'name' => 'ACEH',
            ),
            1 => 
            array (
                'id_provinsi' => '12',
                'name' => 'SUMATERA UTARA',
            ),
            2 => 
            array (
                'id_provinsi' => '13',
                'name' => 'SUMATERA BARAT',
            ),
            3 => 
            array (
                'id_provinsi' => '14',
                'name' => 'RIAU',
            ),
            4 => 
            array (
                'id_provinsi' => '15',
                'name' => 'JAMBI',
            ),
            5 => 
            array (
                'id_provinsi' => '16',
                'name' => 'SUMATERA SELATAN',
            ),
            6 => 
            array (
                'id_provinsi' => '17',
                'name' => 'BENGKULU',
            ),
            7 => 
            array (
                'id_provinsi' => '18',
                'name' => 'LAMPUNG',
            ),
            8 => 
            array (
                'id_provinsi' => '19',
                'name' => 'KEPULAUAN BANGKA BELITUNG',
            ),
            9 => 
            array (
                'id_provinsi' => '21',
                'name' => 'KEPULAUAN RIAU',
            ),
            10 => 
            array (
                'id_provinsi' => '31',
                'name' => 'DKI JAKARTA',
            ),
            11 => 
            array (
                'id_provinsi' => '32',
                'name' => 'JAWA BARAT',
            ),
            12 => 
            array (
                'id_provinsi' => '33',
                'name' => 'JAWA TENGAH',
            ),
            13 => 
            array (
                'id_provinsi' => '34',
                'name' => 'DI YOGYAKARTA',
            ),
            14 => 
            array (
                'id_provinsi' => '35',
                'name' => 'JAWA TIMUR',
            ),
            15 => 
            array (
                'id_provinsi' => '36',
                'name' => 'BANTEN',
            ),
            16 => 
            array (
                'id_provinsi' => '51',
                'name' => 'BALI',
            ),
            17 => 
            array (
                'id_provinsi' => '52',
                'name' => 'NUSA TENGGARA BARAT',
            ),
            18 => 
            array (
                'id_provinsi' => '53',
                'name' => 'NUSA TENGGARA TIMUR',
            ),
            19 => 
            array (
                'id_provinsi' => '61',
                'name' => 'KALIMANTAN BARAT',
            ),
            20 => 
            array (
                'id_provinsi' => '62',
                'name' => 'KALIMANTAN TENGAH',
            ),
            21 => 
            array (
                'id_provinsi' => '63',
                'name' => 'KALIMANTAN SELATAN',
            ),
            22 => 
            array (
                'id_provinsi' => '64',
                'name' => 'KALIMANTAN TIMUR',
            ),
            23 => 
            array (
                'id_provinsi' => '65',
                'name' => 'KALIMANTAN UTARA',
            ),
            24 => 
            array (
                'id_provinsi' => '71',
                'name' => 'SULAWESI UTARA',
            ),
            25 => 
            array (
                'id_provinsi' => '72',
                'name' => 'SULAWESI TENGAH',
            ),
            26 => 
            array (
                'id_provinsi' => '73',
                'name' => 'SULAWESI SELATAN',
            ),
            27 => 
            array (
                'id_provinsi' => '74',
                'name' => 'SULAWESI TENGGARA',
            ),
            28 => 
            array (
                'id_provinsi' => '75',
                'name' => 'GORONTALO',
            ),
            29 => 
            array (
                'id_provinsi' => '76',
                'name' => 'SULAWESI BARAT',
            ),
            30 => 
            array (
                'id_provinsi' => '81',
                'name' => 'MALUKU',
            ),
            31 => 
            array (
                'id_provinsi' => '82',
                'name' => 'MALUKU UTARA',
            ),
            32 => 
            array (
                'id_provinsi' => '91',
                'name' => 'PAPUA BARAT',
            ),
            33 => 
            array (
                'id_provinsi' => '94',
                'name' => 'PAPUA',
            ),
        ));
        
        
    }
}