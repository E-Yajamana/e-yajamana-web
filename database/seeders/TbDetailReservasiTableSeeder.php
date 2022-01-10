<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbDetailReservasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_detail_reservasi')->delete();
        
        \DB::table('tb_detail_reservasi')->insert(array (
            0 => 
            array (
                'id_detail_reservasi' => 1,
                'id_reservasi' => 9,
                'id_tahapan_upacara' => 2,
                'waktu_mulai' => '05:00:00',
                'waktu_selesai' => '08:00:00',
                'tanggal_mulai' => '2021-10-21',
                'tanggal_selesai' => '2021-10-21',
                'status' => NULL,
            ),
            1 => 
            array (
                'id_detail_reservasi' => 2,
                'id_reservasi' => 9,
                'id_tahapan_upacara' => 1,
                'waktu_mulai' => '10:01:23',
                'waktu_selesai' => '13:23:21',
                'tanggal_mulai' => '2021-10-21',
                'tanggal_selesai' => '2021-10-21',
                'status' => NULL,
            ),
            2 => 
            array (
                'id_detail_reservasi' => 3,
                'id_reservasi' => 10,
                'id_tahapan_upacara' => 3,
                'waktu_mulai' => '15:00:00',
                'waktu_selesai' => '18:00:00',
                'tanggal_mulai' => '2021-10-21',
                'tanggal_selesai' => '2021-10-21',
                'status' => NULL,
            ),
            3 => 
            array (
                'id_detail_reservasi' => 5,
                'id_reservasi' => 11,
                'id_tahapan_upacara' => 5,
                'waktu_mulai' => '06:00:07',
                'waktu_selesai' => '09:00:10',
                'tanggal_mulai' => '2021-10-15',
                'tanggal_selesai' => '2021-10-15',
                'status' => NULL,
            ),
            4 => 
            array (
                'id_detail_reservasi' => 6,
                'id_reservasi' => 11,
                'id_tahapan_upacara' => 6,
                'waktu_mulai' => '10:00:00',
                'waktu_selesai' => '14:01:23',
                'tanggal_mulai' => '2021-10-16',
                'tanggal_selesai' => '2021-10-16',
                'status' => NULL,
            ),
        ));
        
        
    }
}