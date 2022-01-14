<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbGriyaRumahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_griya_rumah')->delete();

        DB::table('tb_griya_rumah')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nama_griya_rumah' => 'Griaya Gunung Sari',
                'alamat_griya_rumah' => 'Jalan Gunung Sari No 5',
                'id_desa_adat' => NULL,
                'id_desa' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nama_griya_rumah' => 'Griya Tegal Linggah',
                'alamat_griya_rumah' => 'Jalan Tegal No 15',
                'id_desa_adat' => NULL,
                'id_desa' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nama_griya_rumah' => 'Puri Anyar',
                'alamat_griya_rumah' => 'Jalan Anyar no 12',
                'id_desa_adat' => NULL,
                'id_desa' => NULL,
            ),
        ));


    }
}
