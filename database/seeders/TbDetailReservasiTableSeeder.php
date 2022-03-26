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
                'id' => 1,
                'id_reservasi' => 1,
                'id_tahapan_upacara' => 5,
                'tanggal_mulai' => '2022-02-23 00:00:00',
                'tanggal_selesai' => '2022-02-23 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-17 23:36:04',
                'updated_at' => '2022-03-17 23:36:04',
            ),
            1 => 
            array (
                'id' => 2,
                'id_reservasi' => 1,
                'id_tahapan_upacara' => 6,
                'tanggal_mulai' => '2022-02-23 00:00:00',
                'tanggal_selesai' => '2022-02-23 00:00:00',
                'status' => 'pending',
                'keterangan' => NULL,
                'created_at' => '2022-03-17 23:36:04',
                'updated_at' => '2022-03-17 23:36:04',
            ),
        ));
        
        
    }
}