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
                'id' => 2,
                'nama_sanggar' => 'Sanngar Bali Warini',
                'alamat_sanggar' => 'Buana sari no 14',
                'sk_tanda_usaha' => 'app/default/tanda_usaha.jpg',
                'lat' => '-8.785502000000000000',
                'lng' => '115.176629200000000000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-19 01:47:09',
                'updated_at' => '2022-01-23 06:27:00',
            ),
            1 =>
            array (
                'id' => 3,
                'nama_sanggar' => 'Sanggar Nuansa Bali',
                'alamat_sanggar' => 'Tegal lantang no 145',
                'sk_tanda_usaha' => 'app/default/tanda_usaha.jpg',
                'lat' => '-8.556869800000000000',
                'lng' => '115.199806000000000000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-24 20:29:48',
                'updated_at' => '2022-01-24 20:29:50',
            ),
        ));


    }
}
