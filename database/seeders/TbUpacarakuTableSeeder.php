<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUpacarakuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tb_upacaraku')->delete();

        \DB::table('tb_upacaraku')->insert(array (
            0 =>
            array (
                'id' => 1,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 51,
                'nama_upacara' => 'Mepandes I Wayan Bobiu',
                'alamat_upacaraku' => 'Jalan Pulau kawe no 15, utama 3',
                'tanggal_mulai' => '2022-08-17',
                'tanggal_selesai' => '2022-08-20',
                'deskripsi_upacaraku' => 'Mepandes Bobi pada umur ke 25',
                'status' => 'pending',
                'keterangan' => NULL,
                'lat' => '-8.301311663902583000',
                'lng' => '114.569187948416170000',
                'created_at' => '2022-07-04 20:08:02',
                'updated_at' => '2022-07-04 20:08:02',
            ),
            1 =>
            array (
                'id' => 2,
                'id_banjar_dinas' => 11,
                'id_upacara' => 3,
                'id_krama' => 51,
                'nama_upacara' => 'Piodalan Ring Pura Tegal Tugu',
                'alamat_upacaraku' => 'Jalan Supratman no 15, gang 2',
                'tanggal_mulai' => '2022-08-24',
                'tanggal_selesai' => '2022-08-27',
                'deskripsi_upacaraku' => 'Odalan yang diselengarakan setiap 6 bulan sekali',
                'status' => 'pending',
                'keterangan' => NULL,
                'lat' => '-8.464345860005155000',
                'lng' => '115.338215129804300000',
                'created_at' => '2022-07-04 20:11:34',
                'updated_at' => '2022-07-04 20:11:34',
            ),
        ));


    }
}
