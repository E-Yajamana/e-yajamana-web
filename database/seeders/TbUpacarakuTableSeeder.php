<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbUpacarakuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_upacaraku')->delete();

        DB::table('tb_upacaraku')->insert(array (
            0 =>
            array (
                'id' => 1,
                'id_upacara' => 1,
                'id_krama' => 1,
                'id_desa' => 1101010001,
                'id_desa_adat' => 1,
                'nama_upacara' => 'Mepandes Alin',
                'lokasi' => 'Gianyar Tegal Tugu',
                'tanggal_mulai' => '2021-10-21',
                'tanggal_selesai' => '2021-10-30',
                'desc' => 'Mepandes putu alin',
                'status' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'id_upacara' => 2,
                'id_krama' => 1,
                'id_desa' => 1101010001,
                'id_desa_adat' => 1,
                'nama_upacara' => 'Ngenteg Linggih',
                'lokasi' => 'Dalung Permai',
                'tanggal_mulai' => '2021-10-21',
                'tanggal_selesai' => '2021-10-29',
                'desc' => 'Ngenteg Linggih Rimsawan',
                'status' => NULL,
            ),
        ));


    }
}
