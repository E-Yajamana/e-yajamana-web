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
                'id' => 21,
                'id_banjar_dinas' => 16,
                'id_upacara' => 2,
                'id_krama' => 2,
                'nama_upacara' => 'Ngeteg Linggih Cemara',
                'alamat_upacaraku' => 'Perumahan cemara giri graha utama II No 29',
                'tanggal_mulai' => '2022-02-15',
                'tanggal_selesai' => '2022-02-23',
                'deskripsi_upacaraku' => 'Ngeteg linggih adalah tradisi turun temurun',
                'status' => 'pending',
                'lat' => '-8.534577561443303000',
                'lng' => '115.261962907388820000',
                'created_at' => '2022-02-13 19:40:23',
                'updated_at' => '2022-02-13 19:40:23',
            ),
            1 => 
            array (
                'id' => 22,
                'id_banjar_dinas' => 16,
                'id_upacara' => 3,
                'id_krama' => 2,
                'nama_upacara' => 'Piodalan Ring Pura Keramasa',
                'alamat_upacaraku' => 'Perumahan Keramas no 154',
                'tanggal_mulai' => '2022-02-24',
                'tanggal_selesai' => '2022-02-26',
                'deskripsi_upacaraku' => 'deskripsi upacara keramas',
                'status' => 'pending',
                'lat' => '-8.588897084373947000',
                'lng' => '115.271850619465110000',
                'created_at' => '2022-02-13 20:06:35',
                'updated_at' => '2022-02-13 20:06:35',
            ),
        ));
        
        
    }
}