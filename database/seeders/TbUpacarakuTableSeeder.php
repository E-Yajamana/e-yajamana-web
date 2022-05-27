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
                'id_upacara' => 3,
                'id_krama' => 51,
                'nama_upacara' => 'Piodalan Ring Pura Dalung',
                'alamat_upacaraku' => 'Perumahan Cemara Giri Graha Utama 2',
                'tanggal_mulai' => '2022-06-20',
                'tanggal_selesai' => '2022-06-29',
                'deskripsi_upacaraku' => 'Upacara Rismawan Nugraha',
                'status' => 'pending',
                'keterangan' => NULL,
                'lat' => '-8.291132090397488000',
                'lng' => '114.578613289631930000',
                'created_at' => '2022-05-27 00:51:52',
                'updated_at' => '2022-05-27 00:51:52',
            ),
            1 => 
            array (
                'id' => 2,
                'id_banjar_dinas' => 23,
                'id_upacara' => 8,
                'id_krama' => 51,
                'nama_upacara' => 'Mawinten Pemangku',
                'alamat_upacaraku' => 'Melaya kecamatan mana kaden',
                'tanggal_mulai' => '2022-06-22',
                'tanggal_selesai' => '2022-06-30',
                'deskripsi_upacaraku' => 'Testing Deskripsi',
                'status' => 'pending',
                'keterangan' => NULL,
                'lat' => '-8.391137109850447000',
                'lng' => '114.830200178548710000',
                'created_at' => '2022-05-27 00:52:40',
                'updated_at' => '2022-05-27 00:52:40',
            ),
        ));
        
        
    }
}