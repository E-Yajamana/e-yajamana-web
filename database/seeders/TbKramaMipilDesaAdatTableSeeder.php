<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbKramaMipilDesaAdatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_krama_mipil_desa_adat')->delete();
        
        \DB::table('tb_krama_mipil_desa_adat')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nomor_krama_mipil' => 'KR-000',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 3,
                'penduduk_id' => 14,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:51',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            1 => 
            array (
                'id' => 2,
                'nomor_krama_mipil' => 'KR-001',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 1,
                'penduduk_id' => 13,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:52',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            2 => 
            array (
                'id' => 3,
                'nomor_krama_mipil' => 'KR-002',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 4,
                'penduduk_id' => 6,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:52',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            3 => 
            array (
                'id' => 4,
                'nomor_krama_mipil' => 'KR-003',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 4,
                'penduduk_id' => 22,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:53',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            4 => 
            array (
                'id' => 5,
                'nomor_krama_mipil' => 'KR-004',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 1,
                'penduduk_id' => 10,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:53',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            5 => 
            array (
                'id' => 6,
                'nomor_krama_mipil' => 'KR-005',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 8,
                'penduduk_id' => 21,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:53',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            6 => 
            array (
                'id' => 7,
                'nomor_krama_mipil' => 'KR-006',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 5,
                'penduduk_id' => 20,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:55',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            7 => 
            array (
                'id' => 8,
                'nomor_krama_mipil' => 'KR-007',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 6,
                'penduduk_id' => 19,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:55',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            8 => 
            array (
                'id' => 9,
                'nomor_krama_mipil' => 'KR-008',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 8,
                'penduduk_id' => 25,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:55',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            9 => 
            array (
                'id' => 10,
                'nomor_krama_mipil' => 'KR-009',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 8,
                'penduduk_id' => 12,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:56',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            10 => 
            array (
                'id' => 11,
                'nomor_krama_mipil' => 'KR-0010',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 8,
                'penduduk_id' => 24,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:57',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            11 => 
            array (
                'id' => 12,
                'nomor_krama_mipil' => 'KR-0011',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 4,
                'penduduk_id' => 27,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:58',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            12 => 
            array (
                'id' => 13,
                'nomor_krama_mipil' => 'KR-0012',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 5,
                'penduduk_id' => 1,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:59',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            13 => 
            array (
                'id' => 14,
                'nomor_krama_mipil' => 'KR-0013',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 6,
                'penduduk_id' => 9,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:42:59',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            14 => 
            array (
                'id' => 15,
                'nomor_krama_mipil' => 'KR-0014',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 7,
                'penduduk_id' => 18,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:00',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            15 => 
            array (
                'id' => 16,
                'nomor_krama_mipil' => 'KR-0015',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 1,
                'penduduk_id' => 24,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:00',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            16 => 
            array (
                'id' => 17,
                'nomor_krama_mipil' => 'KR-0016',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 6,
                'penduduk_id' => 14,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:01',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            17 => 
            array (
                'id' => 18,
                'nomor_krama_mipil' => 'KR-0017',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 2,
                'penduduk_id' => 26,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:02',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            18 => 
            array (
                'id' => 19,
                'nomor_krama_mipil' => 'KR-0018',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 2,
                'penduduk_id' => 8,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:02',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            19 => 
            array (
                'id' => 20,
                'nomor_krama_mipil' => 'KR-0019',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 3,
                'penduduk_id' => 7,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:03',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            20 => 
            array (
                'id' => 21,
                'nomor_krama_mipil' => 'KR-0020',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 7,
                'penduduk_id' => 2,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:03',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            21 => 
            array (
                'id' => 22,
                'nomor_krama_mipil' => 'KR-0021',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 5,
                'penduduk_id' => 25,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:04',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            22 => 
            array (
                'id' => 23,
                'nomor_krama_mipil' => 'KR-0022',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 8,
                'penduduk_id' => 16,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:04',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            23 => 
            array (
                'id' => 24,
                'nomor_krama_mipil' => 'KR-0023',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 4,
                'penduduk_id' => 5,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:04',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            24 => 
            array (
                'id' => 25,
                'nomor_krama_mipil' => 'KR-0024',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 1,
                'penduduk_id' => 14,
                'jenis_kependudukan' => NULL,
                'created_at' => '2022-01-16 06:43:06',
                'updated_at' => NULL,
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            25 => 
            array (
                'id' => 36,
                'nomor_krama_mipil' => '030701101130600001',
                'banjar_dinas_id' => 10,
                'banjar_adat_id' => 1,
                'penduduk_id' => 1,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 18:26:11',
                'updated_at' => '2022-01-18 08:22:25',
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            26 => 
            array (
                'id' => 38,
                'nomor_krama_mipil' => '030702101131000001',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 2,
                'penduduk_id' => 2,
                'jenis_kependudukan' => 'adat',
                'created_at' => '2022-01-25 18:26:13',
                'updated_at' => '2022-01-21 21:59:01',
                'deleted_at' => '2022-01-16 14:42:48',
            ),
            27 => 
            array (
                'id' => 39,
                'nomor_krama_mipil' => '030702101130600001',
                'banjar_dinas_id' => NULL,
                'banjar_adat_id' => 2,
                'penduduk_id' => 3,
                'jenis_kependudukan' => 'adat',
                'created_at' => '2022-01-22 09:42:53',
                'updated_at' => '2022-01-22 09:42:53',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 40,
                'nomor_krama_mipil' => '003250101130600001',
                'banjar_dinas_id' => 12,
                'banjar_adat_id' => 9,
                'penduduk_id' => 1,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 19:28:00',
                'updated_at' => '2022-01-25 19:28:00',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 41,
                'nomor_krama_mipil' => '003250101131000001',
                'banjar_dinas_id' => 12,
                'banjar_adat_id' => 9,
                'penduduk_id' => 2,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 19:28:25',
                'updated_at' => '2022-01-25 19:28:25',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 42,
                'nomor_krama_mipil' => '003250101311278001',
                'banjar_dinas_id' => 12,
                'banjar_adat_id' => 9,
                'penduduk_id' => 31,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 19:30:37',
                'updated_at' => '2022-01-25 19:30:37',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 43,
                'nomor_krama_mipil' => '003250101131000002',
                'banjar_dinas_id' => 12,
                'banjar_adat_id' => 9,
                'penduduk_id' => 32,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 19:35:39',
                'updated_at' => '2022-01-25 19:35:39',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 44,
                'nomor_krama_mipil' => '003250101130705001',
                'banjar_dinas_id' => 12,
                'banjar_adat_id' => 9,
                'penduduk_id' => 33,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 19:38:43',
                'updated_at' => '2022-01-25 19:38:43',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 45,
                'nomor_krama_mipil' => '003250101311283001',
                'banjar_dinas_id' => 13,
                'banjar_adat_id' => 10,
                'penduduk_id' => 34,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 18:47:04',
                'updated_at' => '2022-01-25 19:47:05',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 46,
                'nomor_krama_mipil' => '003250101311285001',
                'banjar_dinas_id' => 13,
                'banjar_adat_id' => 10,
                'penduduk_id' => 35,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 18:47:42',
                'updated_at' => '2022-01-25 19:47:43',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 47,
                'nomor_krama_mipil' => '003250101140407001',
                'banjar_dinas_id' => 13,
                'banjar_adat_id' => 10,
                'penduduk_id' => 36,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 18:49:22',
                'updated_at' => '2022-01-25 19:49:24',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 48,
                'nomor_krama_mipil' => '003250101311265001',
                'banjar_dinas_id' => 12,
                'banjar_adat_id' => 9,
                'penduduk_id' => 37,
                'jenis_kependudukan' => 'adat_&_dinas',
                'created_at' => '2022-01-25 19:59:51',
                'updated_at' => '2022-01-25 19:59:51',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 50,
                'nomor_krama_mipil' => '03250101030122001',
                'banjar_dinas_id' => 12,
                'banjar_adat_id' => 9,
                'penduduk_id' => 42,
                'jenis_kependudukan' => 'adat',
                'created_at' => '2022-01-31 08:55:43',
                'updated_at' => '2022-01-31 09:55:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}