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
                'profile' => NULL,
                'lat' => '-8.646906000000000000',
                'lng' => '115.145921000000000000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'id_banjar_dinas' => 19,
                'nama_sanggar' => 'Sanggar Nuansa',
                'alamat_sanggar' => 'Tegal lantang no 145',
                'sk_tanda_usaha' => 'app/sanggar/profile/1655121820-screen-0jpg.jpg',
                'profile' => 'app/sanggar/profile/1655121820-unnamedpng.png',
                'lat' => '-8.785502000000000000',
                'lng' => '115.176629200000000000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-06-13 20:03:40',
            ),
            2 => 
            array (
                'id' => 9,
                'id_banjar_dinas' => 21,
                'nama_sanggar' => 'testiong sanggar',
                'alamat_sanggar' => 'admin',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1651895919-default-mac-wallpaper-17-1920x1200jpg.jpg',
                'profile' => NULL,
                'lat' => '-8.578305369524900000',
                'lng' => '115.122985839843760000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-05-07 11:58:39',
                'updated_at' => '2022-06-28 14:29:33',
            ),
            3 => 
            array (
                'id' => 10,
                'id_banjar_dinas' => 11,
                'nama_sanggar' => 'Dalung Kesenian',
                'alamat_sanggar' => 'Dalung jalan sampuing bro',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1651903386-unnamedpng.png',
                'profile' => 'app/sanggar/profile/1651903386-screen-0jpg.jpg',
                'lat' => '-8.510674550565566000',
                'lng' => '115.180664062500010000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-05-07 14:03:06',
                'updated_at' => '2022-05-08 07:49:39',
            ),
            4 => 
            array (
                'id' => 11,
                'id_banjar_dinas' => 14,
                'nama_sanggar' => 'Sanggar Seni Dalung',
                'alamat_sanggar' => 'Cemara giri no 14',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1655085973-screen-0jpg.jpg',
                'profile' => 'app/sanggar/profile/1655085973-unnamedpng.png',
                'lat' => '-8.306623685431822000',
                'lng' => '114.635467529296890000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-06-13 10:06:13',
                'updated_at' => '2022-06-28 14:29:37',
            ),
            5 => 
            array (
                'id' => 12,
                'id_banjar_dinas' => 16,
                'nama_sanggar' => 'Sanggar testing apamen',
                'alamat_sanggar' => 'testing alam sangar',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1655125445-r0ad288kma8xjpg.jpg',
                'profile' => 'app/sanggar/profile/1655125445-unnamedpng.png',
                'lat' => '-8.369127351597545000',
                'lng' => '114.730234194559030000',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-06-13 21:04:05',
                'updated_at' => '2022-06-29 14:32:46',
            ),
            6 => 
            array (
                'id' => 13,
                'id_banjar_dinas' => 16,
                'nama_sanggar' => 'test',
                'alamat_sanggar' => 'test',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1656654057-tempfilejpg.jpg',
                'profile' => NULL,
                'lat' => '-8.615612736589748000',
                'lng' => '115.232848115265370000',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-07-01 13:40:57',
                'updated_at' => '2022-07-01 13:40:57',
            ),
            7 => 
            array (
                'id' => 14,
                'id_banjar_dinas' => 16,
                'nama_sanggar' => 'test 2',
                'alamat_sanggar' => 'test',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1656654437-tempfilejpg.jpg',
                'profile' => NULL,
                'lat' => '-8.640299188526740000',
                'lng' => '115.233846902847290000',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-07-01 13:47:17',
                'updated_at' => '2022-07-01 13:47:17',
            ),
            8 => 
            array (
                'id' => 15,
                'id_banjar_dinas' => 16,
                'nama_sanggar' => 'sanggar 3',
                'alamat_sanggar' => 'jln test',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1656654536-tempfilejpg.jpg',
                'profile' => NULL,
                'lat' => '-8.633880859686510000',
                'lng' => '115.240838080644610000',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-07-01 13:48:56',
                'updated_at' => '2022-07-01 13:48:56',
            ),
            9 => 
            array (
                'id' => 16,
                'id_banjar_dinas' => 16,
                'nama_sanggar' => 'testtesttest',
                'alamat_sanggar' => 'test',
                'sk_tanda_usaha' => 'app/sanggar/sk_tanda_usaha/1656654658-tempfilejpg.jpg',
                'profile' => 'app/sanggar/profile/1656654658-tempfilejpg.jpg',
                'lat' => '-8.634498068806540000',
                'lng' => '115.234595909714700000',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-07-01 13:50:58',
                'updated_at' => '2022-07-01 13:50:58',
            ),
        ));
        
        
    }
}