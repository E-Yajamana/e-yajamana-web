<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbSeratiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_serati')->delete();

        DB::table('tb_serati')->insert(array (
            0 =>
            array (
                'id' => 1,
                'id_user' => 9,
                'nama_serati' => 'serati-bobi',
                'alamat_serati' => 'dalung permai no 51',
            ),
        ));


    }
}
