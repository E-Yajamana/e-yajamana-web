<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbSulinggihTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_sulinggih')->delete();
        
        \DB::table('tb_sulinggih')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_griya' => 2,
                'id_user' => 8,
                'id_pasangan' => NULL,
                'id_nabe' => NULL,
                'nama_walaka' => 'I Komang Alit Sudiasna',
                'nama_sulinggih' => 'Ida Pandita Sri Agnijaya Mukhi',
                'nama_pasangan' => 'Ida Pedande Istri Keniten',
                'nama_nabe' => NULL,
                'tanggal_diksha' => '2016-08-23',
                'status' => 'sulinggih',
                'sk_kesulinggihan' => 'app/default/sk_sulinggih.jpg',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-18 22:54:38',
                'updated_at' => '2022-01-18 22:54:40',
            ),
            1 => 
            array (
                'id' => 5,
                'id_griya' => 2,
                'id_user' => 9,
                'id_pasangan' => NULL,
                'id_nabe' => 1,
                'nama_walaka' => 'Ida Ayu Putu Ngurah',
                'nama_sulinggih' => 'Ida Pedande Istri Rai Kemenuh',
                'nama_pasangan' => 'Ida Pandita Mpu  Yoga Natha',
                'nama_nabe' => NULL,
                'tanggal_diksha' => '2011-01-12',
                'status' => 'sulinggih',
                'sk_kesulinggihan' => 'app/default/sk_sulinggih.jpg',
                'status_konfirmasi_akun' => 'pending',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-18 22:54:55',
                'updated_at' => '2022-01-22 15:33:22',
            ),
            2 => 
            array (
                'id' => 6,
                'id_griya' => 2,
                'id_user' => 7,
                'id_pasangan' => NULL,
                'id_nabe' => 1,
                'nama_walaka' => 'Ida Padanda Gde Made Bajing',
                'nama_sulinggih' => 'Pedanda Gede Bajing',
                'nama_pasangan' => 'Ida Padanda Gde Made Bajing',
                'nama_nabe' => NULL,
                'tanggal_diksha' => '2009-06-19',
                'status' => 'sulinggih',
                'sk_kesulinggihan' => 'app/default/sk_sulinggih.jpg',
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-19 01:36:55',
                'updated_at' => '2022-01-19 01:37:00',
            ),
            3 => 
            array (
                'id' => 18,
                'id_griya' => 13,
                'id_user' => 3,
                'id_pasangan' => NULL,
                'id_nabe' => 5,
                'nama_walaka' => 'I Gede Rus Jaya',
                'nama_sulinggih' => 'Ida Pandita Sri Agnaya',
                'nama_pasangan' => NULL,
                'nama_nabe' => NULL,
                'tanggal_diksha' => '2011-01-12',
                'status' => 'sulinggih',
                'sk_kesulinggihan' => NULL,
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-19 01:43:41',
                'updated_at' => '2022-01-19 01:43:44',
            ),
            4 => 
            array (
                'id' => 19,
                'id_griya' => 6,
                'id_user' => 3,
                'id_pasangan' => NULL,
                'id_nabe' => NULL,
                'nama_walaka' => 'I Gede Pemangku Gede',
                'nama_sulinggih' => 'Ida Pandita Sri Agnaya 2',
                'nama_pasangan' => 'I Nengah Karisma',
                'nama_nabe' => NULL,
                'tanggal_diksha' => '2011-01-12',
                'status' => 'pemangku',
                'sk_kesulinggihan' => NULL,
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => '2022-01-22 21:37:15',
                'updated_at' => '2022-01-22 13:39:42',
            ),
            5 => 
            array (
                'id' => 20,
                'id_griya' => 2,
                'id_user' => 2,
                'id_pasangan' => NULL,
                'id_nabe' => NULL,
                'nama_walaka' => 'I Gede Pemangku Gede',
                'nama_sulinggih' => 'Made Rismawan',
                'nama_pasangan' => 'Ida Padanda Gde Made Bajing',
                'nama_nabe' => NULL,
                'tanggal_diksha' => '2011-01-12',
                'status' => 'sulinggih',
                'sk_kesulinggihan' => NULL,
                'status_konfirmasi_akun' => 'disetujui',
                'keterangan_konfirmasi_akun' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}