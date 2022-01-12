<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbReservasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_reservasi')->delete();

        DB::table('tb_reservasi')->insert(array (
            0 =>
            array (
                'id' => 9,
                'id_relasi' => 1,
                'id_upacaraku' => 1,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'selesai',
                'tgl_tangkil' => '2021-10-20',
                'desc' => 'Resevarsi buat anak saya',
            ),
            1 =>
            array (
                'id' => 10,
                'id_relasi' => 2,
                'id_upacaraku' => 1,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'in progress',
                'tgl_tangkil' => '2021-10-22',
                'desc' => 'teseavrsi 2',
            ),
            2 =>
            array (
                'id' => 11,
                'id_relasi' => 1,
                'id_upacaraku' => 2,
                'tipe' => 'sulinggih_pemangku',
                'status' => 'sedang berlangsung',
                'tgl_tangkil' => '2021-10-15',
                'desc' => 'Resevarsi Krama 2 Pemangku',
            ),
        ));


    }
}
