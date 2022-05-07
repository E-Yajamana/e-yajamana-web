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
                'id_desa_dinas' => '12',
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
                'id_desa_dinas' => '22',
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
            2 => 
            array (
                'id' => 8,
                'id_desa_dinas' => NULL,
                'nama_sanggar' => 'admiamd',
                'alamat_sanggar' => 'asdasdas',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1651895823-screen-0jpg.jpg',
                'lat' => '-8.610894239554503000',
                'lng' => '115.101013183593760000',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-05-07 11:57:03',
                'updated_at' => '2022-05-07 11:57:03',
            ),
            3 => 
            array (
                'id' => 9,
                'id_desa_dinas' => '5101010003',
                'nama_sanggar' => 'testiong sanggar',
                'alamat_sanggar' => 'admin',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1651895919-default-mac-wallpaper-17-1920x1200jpg.jpg',
                'lat' => '-8.578305369524900000',
                'lng' => '115.122985839843760000',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-05-07 11:58:39',
                'updated_at' => '2022-05-07 11:58:39',
            ),
        ));
        
        
    }
}