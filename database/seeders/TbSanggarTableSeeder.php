<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbSanggarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_sanggar')->delete();

        DB::table('tb_sanggar')->insert(array (
            0 =>
            array (
                'id' => 4,
                'id_user' => 8,
                'nama_sanggar' => 'Sanggar Singo Sari',
                'alamat_sanggar' => 'Dalung Permai',
            ),
        ));


    }
}
