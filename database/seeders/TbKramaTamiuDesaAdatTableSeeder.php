<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbKramaTamiuDesaAdatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_krama_tamiu_desa_adat')->delete();
        
        \DB::table('tb_krama_tamiu_desa_adat')->insert(array (
            0 => 
            array (
                'id' => 1,
                'banjar_adat_id' => 3,
                'penduduk_id' => 17,
                'banjar_dinas_id' => NULL,
                'nomor_krama_tamiu' => 'KRT-000',
                'tanggal_masuk' => '2013-05-08',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:06',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            1 => 
            array (
                'id' => 2,
                'banjar_adat_id' => 8,
                'penduduk_id' => 3,
                'banjar_dinas_id' => NULL,
                'nomor_krama_tamiu' => 'KRT-001',
                'tanggal_masuk' => '2004-08-12',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:08',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            2 => 
            array (
                'id' => 3,
                'banjar_adat_id' => 3,
                'penduduk_id' => 11,
                'banjar_dinas_id' => NULL,
                'nomor_krama_tamiu' => 'KRT-002',
                'tanggal_masuk' => '1982-09-15',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:08',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            3 => 
            array (
                'id' => 4,
                'banjar_adat_id' => 1,
                'penduduk_id' => 18,
                'banjar_dinas_id' => NULL,
                'nomor_krama_tamiu' => 'KRT-003',
                'tanggal_masuk' => '1990-05-10',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:09',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            4 => 
            array (
                'id' => 5,
                'banjar_adat_id' => 8,
                'penduduk_id' => 7,
                'banjar_dinas_id' => NULL,
                'nomor_krama_tamiu' => 'KRT-004',
                'tanggal_masuk' => '2006-12-07',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:09',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            5 => 
            array (
                'id' => 6,
                'banjar_adat_id' => 7,
                'penduduk_id' => 7,
                'banjar_dinas_id' => NULL,
                'nomor_krama_tamiu' => 'KRT-005',
                'tanggal_masuk' => '2001-09-07',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:09',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            6 => 
            array (
                'id' => 7,
                'banjar_adat_id' => 1,
                'penduduk_id' => 4,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-006',
                'tanggal_masuk' => '1985-09-13',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:38',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            7 => 
            array (
                'id' => 8,
                'banjar_adat_id' => 6,
                'penduduk_id' => 13,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-007',
                'tanggal_masuk' => '1986-05-15',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:40',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            8 => 
            array (
                'id' => 9,
                'banjar_adat_id' => 4,
                'penduduk_id' => 14,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-008',
                'tanggal_masuk' => '2007-03-31',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:41',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            9 => 
            array (
                'id' => 10,
                'banjar_adat_id' => 7,
                'penduduk_id' => 3,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-009',
                'tanggal_masuk' => '1985-01-10',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:41',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            10 => 
            array (
                'id' => 11,
                'banjar_adat_id' => 4,
                'penduduk_id' => 5,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0010',
                'tanggal_masuk' => '1976-07-14',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:41',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            11 => 
            array (
                'id' => 12,
                'banjar_adat_id' => 4,
                'penduduk_id' => 26,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0011',
                'tanggal_masuk' => '2008-08-28',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:42',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            12 => 
            array (
                'id' => 13,
                'banjar_adat_id' => 1,
                'penduduk_id' => 21,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0012',
                'tanggal_masuk' => '2002-09-06',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:42',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            13 => 
            array (
                'id' => 14,
                'banjar_adat_id' => 6,
                'penduduk_id' => 20,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0013',
                'tanggal_masuk' => '2019-03-01',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:42',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            14 => 
            array (
                'id' => 15,
                'banjar_adat_id' => 2,
                'penduduk_id' => 8,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0014',
                'tanggal_masuk' => '2012-06-26',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:43',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            15 => 
            array (
                'id' => 16,
                'banjar_adat_id' => 5,
                'penduduk_id' => 1,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0015',
                'tanggal_masuk' => '2011-12-06',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:43',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            16 => 
            array (
                'id' => 17,
                'banjar_adat_id' => 5,
                'penduduk_id' => 5,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0016',
                'tanggal_masuk' => '1979-06-30',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:44',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            17 => 
            array (
                'id' => 18,
                'banjar_adat_id' => 1,
                'penduduk_id' => 20,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0017',
                'tanggal_masuk' => '1991-12-09',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:44',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            18 => 
            array (
                'id' => 19,
                'banjar_adat_id' => 8,
                'penduduk_id' => 23,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0018',
                'tanggal_masuk' => '2000-05-07',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:44',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            19 => 
            array (
                'id' => 20,
                'banjar_adat_id' => 2,
                'penduduk_id' => 25,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0019',
                'tanggal_masuk' => '2015-04-06',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:45',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            20 => 
            array (
                'id' => 21,
                'banjar_adat_id' => 5,
                'penduduk_id' => 14,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0020',
                'tanggal_masuk' => '1998-07-17',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:45',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            21 => 
            array (
                'id' => 22,
                'banjar_adat_id' => 7,
                'penduduk_id' => 15,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0021',
                'tanggal_masuk' => '1970-10-12',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 05:51:46',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            22 => 
            array (
                'id' => 23,
                'banjar_adat_id' => 3,
                'penduduk_id' => 25,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0022',
                'tanggal_masuk' => '2007-06-10',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 10:49:19',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            23 => 
            array (
                'id' => 24,
                'banjar_adat_id' => 2,
                'penduduk_id' => 4,
                'banjar_dinas_id' => 11,
                'nomor_krama_tamiu' => 'KRT-0023',
                'tanggal_masuk' => '1993-07-21',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 10:49:19',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            24 => 
            array (
                'id' => 25,
                'banjar_adat_id' => 1,
                'penduduk_id' => 8,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => 'KRT-0024',
                'tanggal_masuk' => '1971-09-22',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-19 10:49:20',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-19 06:51:02',
            ),
            25 => 
            array (
                'id' => 26,
                'banjar_adat_id' => 1,
                'penduduk_id' => 3,
                'banjar_dinas_id' => 10,
                'nomor_krama_tamiu' => '030701102130600001',
                'tanggal_masuk' => '2000-06-13',
                'tanggal_keluar' => '2000-06-13',
                'created_at' => '2022-01-19 14:37:16',
                'updated_at' => '2022-01-19 07:35:50',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'banjar_adat_id' => 9,
                'penduduk_id' => 38,
                'banjar_dinas_id' => 12,
                'nomor_krama_tamiu' => '03250102311288001',
                'tanggal_masuk' => '2020-01-10',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-30 19:03:31',
                'updated_at' => '2022-01-25 20:41:05',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'banjar_adat_id' => 9,
                'penduduk_id' => 30,
                'banjar_dinas_id' => 12,
                'nomor_krama_tamiu' => '03250102130600001',
                'tanggal_masuk' => '2022-01-18',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-30 18:56:26',
                'updated_at' => '2022-01-30 19:56:23',
                'deleted_at' => '2022-01-30 19:56:23',
            ),
            28 => 
            array (
                'id' => 29,
                'banjar_adat_id' => 9,
                'penduduk_id' => 30,
                'banjar_dinas_id' => 12,
                'nomor_krama_tamiu' => '03250102130600001',
                'tanggal_masuk' => '2020-01-13',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-30 18:57:57',
                'updated_at' => '2022-01-30 19:57:54',
                'deleted_at' => '2022-01-30 19:57:54',
            ),
            29 => 
            array (
                'id' => 30,
                'banjar_adat_id' => 9,
                'penduduk_id' => 30,
                'banjar_dinas_id' => 12,
                'nomor_krama_tamiu' => '03250102130600001',
                'tanggal_masuk' => '2021-12-27',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-30 19:01:04',
                'updated_at' => '2022-01-30 20:01:01',
                'deleted_at' => '2022-01-30 20:01:01',
            ),
            30 => 
            array (
                'id' => 31,
                'banjar_adat_id' => 9,
                'penduduk_id' => 30,
                'banjar_dinas_id' => 12,
                'nomor_krama_tamiu' => '03250102130600002',
                'tanggal_masuk' => '2021-12-27',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-30 19:00:56',
                'updated_at' => '2022-01-30 20:00:53',
                'deleted_at' => '2022-01-30 20:00:53',
            ),
            31 => 
            array (
                'id' => 32,
                'banjar_adat_id' => 9,
                'penduduk_id' => 30,
                'banjar_dinas_id' => 12,
                'nomor_krama_tamiu' => '03250102130600001',
                'tanggal_masuk' => '2020-01-13',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-30 19:03:10',
                'updated_at' => '2022-01-30 20:03:07',
                'deleted_at' => '2022-01-30 20:03:07',
            ),
            32 => 
            array (
                'id' => 34,
                'banjar_adat_id' => 9,
                'penduduk_id' => 43,
                'banjar_dinas_id' => 12,
                'nomor_krama_tamiu' => '03250102261221001',
                'tanggal_masuk' => '2022-01-18',
                'tanggal_keluar' => NULL,
                'created_at' => '2022-01-30 20:35:08',
                'updated_at' => '2022-01-30 20:35:08',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}