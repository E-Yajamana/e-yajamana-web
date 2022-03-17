<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbSanggarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tb_sanggar')->delete();

        \DB::table('tb_sanggar')->insert(array (
            0 =>
            array (
                'id' => 5,
                'id_banjar_dinas' => 12,
                'nama_sanggar' => 'Sanngar Bali Warini',
                'alamat_sanggar' => 'Buana sari no 14',
                'sk_tanda_usaha' => 'app/default/tanda_usaha.jpg',
                'lat' => '-8.785502000000000000',
                'lng' => '115.176629200000000000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 6,
                'id_banjar_dinas' => 22,
                'nama_sanggar' => 'Sanggar Nuansa Bali',
                'alamat_sanggar' => 'Tegal lantang no 145',
                'sk_tanda_usaha' => 'app/default/tanda_usaha.jpg',
                'lat' => '-8.785502000000000000',
                'lng' => '115.176629200000000000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
