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
                'id' => 2,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'potong gigi saudara',
                'alamat_upacaraku' => 'Jln.Banteng No 16',
                'tanggal_mulai' => '2022-05-01',
                'tanggal_selesai' => '2022-05-31',
                'deskripsi_upacaraku' => NULL,
                'status' => 'berlangsung',
                'lat' => '-8.224160388095388000',
                'lng' => '114.846491999924170000',
                'created_at' => '2022-04-12 15:56:44',
                'updated_at' => '2022-04-12 16:09:14',
            ),
            1 => 
            array (
                'id' => 3,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'Upacara Potong Gigi Saudara',
                'alamat_upacaraku' => 'Jln. Banteng no. 16',
                'tanggal_mulai' => '2022-05-01',
                'tanggal_selesai' => '2022-05-31',
                'deskripsi_upacaraku' => NULL,
                'status' => 'berlangsung',
                'lat' => '-8.226572107730671000',
                'lng' => '114.895880185067650000',
                'created_at' => '2022-04-16 15:55:49',
                'updated_at' => '2022-04-28 12:03:40',
            ),
            2 => 
            array (
                'id' => 4,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'Potong Gigi Saudara Istri',
                'alamat_upacaraku' => 'Jln Banteng No. 16',
                'tanggal_mulai' => '2022-05-01',
                'tanggal_selesai' => '2022-05-31',
                'deskripsi_upacaraku' => NULL,
                'status' => 'berlangsung',
                'lat' => '-8.620303329706324000',
                'lng' => '115.241712145507340000',
                'created_at' => '2022-04-16 17:48:41',
                'updated_at' => '2022-04-17 15:22:29',
            ),
            3 => 
            array (
                'id' => 6,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'Nama Upacara Test',
                'alamat_upacaraku' => 'jln.Banteng no. 16',
                'tanggal_mulai' => '2022-05-01',
                'tanggal_selesai' => '2022-05-14',
                'deskripsi_upacaraku' => NULL,
                'status' => 'berlangsung',
                'lat' => '-8.607232507400752000',
                'lng' => '115.272283293306830000',
                'created_at' => '2022-04-21 16:05:09',
                'updated_at' => '2022-04-21 16:10:48',
            ),
            4 => 
            array (
                'id' => 7,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'Nama Upacara Test',
                'alamat_upacaraku' => 'Alamat Test',
                'tanggal_mulai' => '2022-05-01',
                'tanggal_selesai' => '2022-05-07',
                'deskripsi_upacaraku' => NULL,
                'status' => 'berlangsung',
                'lat' => '-8.205717282823073000',
                'lng' => '114.887503311038030000',
                'created_at' => '2022-04-21 20:17:28',
                'updated_at' => '2022-04-21 20:25:33',
            ),
            5 => 
            array (
                'id' => 8,
                'id_banjar_dinas' => 16,
                'id_upacara' => 3,
                'id_krama' => 6,
                'nama_upacara' => 'Testing Piodalan Ring Pura Upacara',
                'alamat_upacaraku' => 'DImana Kaden Ya',
                'tanggal_mulai' => '2022-04-28',
                'tanggal_selesai' => '2022-05-23',
                'deskripsi_upacaraku' => 'Apamen ya',
                'status' => 'pending',
                'lat' => '-8.550874302523177000',
                'lng' => '115.154296942055240000',
                'created_at' => '2022-04-27 13:33:11',
                'updated_at' => '2022-04-27 13:33:11',
            ),
            6 => 
            array (
                'id' => 14,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'Potong Gigi Saudara',
                'alamat_upacaraku' => 'jln.Banteng no 16',
                'tanggal_mulai' => '2022-05-01',
                'tanggal_selesai' => '2022-05-02',
                'deskripsi_upacaraku' => NULL,
                'status' => 'berlangsung',
                'lat' => '-8.214558160759450000',
                'lng' => '114.895462095737470000',
                'created_at' => '2022-04-28 19:21:26',
                'updated_at' => '2022-04-28 20:17:25',
            ),
            7 => 
            array (
                'id' => 15,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'test',
                'alamat_upacaraku' => 'jln banteng',
                'tanggal_mulai' => '2022-05-01',
                'tanggal_selesai' => '2022-05-02',
                'deskripsi_upacaraku' => NULL,
                'status' => 'berlangsung',
                'lat' => '-8.212899640067024000',
                'lng' => '114.864278733730330000',
                'created_at' => '2022-04-28 19:44:56',
                'updated_at' => '2022-04-28 20:01:55',
            ),
            8 => 
            array (
                'id' => 17,
                'id_banjar_dinas' => 16,
                'id_upacara' => 1,
                'id_krama' => 6,
                'nama_upacara' => 'Potong Gigi Saudara',
                'alamat_upacaraku' => 'jln banteng no. 16',
                'tanggal_mulai' => '2022-04-28',
                'tanggal_selesai' => '2022-05-31',
                'deskripsi_upacaraku' => NULL,
                'status' => 'pending',
                'lat' => '-8.199837966844900000',
                'lng' => '114.913889877498160000',
                'created_at' => '2022-04-28 20:11:29',
                'updated_at' => '2022-04-28 20:11:29',
            ),
            9 => 
            array (
                'id' => 18,
                'id_banjar_dinas' => 16,
                'id_upacara' => 3,
                'id_krama' => 81,
                'nama_upacara' => 'Piodalan Ring Pura Dalem',
                'alamat_upacaraku' => 'Jembrana No2 Perumahan Dalem Jineng',
                'tanggal_mulai' => '2022-05-03',
                'tanggal_selesai' => '2022-05-19',
                'deskripsi_upacaraku' => 'Dilakukan selama 1 tahun sekali',
                'status' => 'pending',
                'lat' => '-8.319397019735302000',
                'lng' => '114.617065438069430000',
                'created_at' => '2022-04-28 23:48:26',
                'updated_at' => '2022-04-28 23:48:26',
            ),
            10 => 
            array (
                'id' => 19,
                'id_banjar_dinas' => 16,
                'id_upacara' => 7,
                'id_krama' => 81,
                'nama_upacara' => 'Mecaru Ring Sanggah Gede',
                'alamat_upacaraku' => 'Perumahan Cemara Giri Graha Utama 2',
                'tanggal_mulai' => '2022-05-17',
                'tanggal_selesai' => '2022-05-25',
                'deskripsi_upacaraku' => 'Mecariu ring pura gede selama 1 tahun sekali',
                'status' => 'pending',
                'lat' => '-8.609536425934472000',
                'lng' => '115.177368130534900000',
                'created_at' => '2022-04-28 23:49:49',
                'updated_at' => '2022-04-28 23:49:49',
            ),
            11 => 
            array (
                'id' => 20,
                'id_banjar_dinas' => 16,
                'id_upacara' => 6,
                'id_krama' => 81,
                'nama_upacara' => 'Atama Wedana Cemara',
                'alamat_upacaraku' => 'sengguan no IV jaalang senguni',
                'tanggal_mulai' => '2022-05-08',
                'tanggal_selesai' => '2022-05-24',
                'deskripsi_upacaraku' => 'Upacara risamwan',
                'status' => 'pending',
                'lat' => '-8.483510233582473000',
                'lng' => '115.019165009725850000',
                'created_at' => '2022-04-28 23:54:09',
                'updated_at' => '2022-04-28 23:54:09',
            ),
        ));
        
        
    }
}