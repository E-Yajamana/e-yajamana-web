<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbMBanjarAdatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_m_banjar_adat')->delete();
        
        \DB::table('tb_m_banjar_adat')->insert(array (
            0 => 
            array (
                'id' => 1,
                'desa_adat_id' => 307,
                'kode_banjar_adat' => '0307011',
                'nama_banjar_adat' => 'Kalijagat Kangin',
                'created_at' => '2022-01-15 23:58:29',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'desa_adat_id' => 307,
                'kode_banjar_adat' => '0307021',
                'nama_banjar_adat' => 'Kalijagat Kauh',
                'created_at' => '2022-01-15 23:58:32',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'desa_adat_id' => 325,
                'kode_banjar_adat' => '0325011',
                'nama_banjar_adat' => 'Melayu Kangin',
                'created_at' => '2022-01-25 16:14:51',
                'updated_at' => '2022-01-25 17:14:52',
                'deleted_at' => '2022-01-25 17:14:52',
            ),
            3 => 
            array (
                'id' => 4,
                'desa_adat_id' => 307,
                'kode_banjar_adat' => '0307031',
                'nama_banjar_adat' => 'Melayu Kauh',
                'created_at' => '2022-01-15 23:58:45',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'desa_adat_id' => 407,
                'kode_banjar_adat' => '0407011',
                'nama_banjar_adat' => 'Selemadeg Kauh',
                'created_at' => '2022-01-15 23:58:50',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'desa_adat_id' => 325,
                'kode_banjar_adat' => '0325021',
                'nama_banjar_adat' => 'Selemadeg Kangin',
                'created_at' => '2022-01-25 16:14:58',
                'updated_at' => '2022-01-25 17:14:59',
                'deleted_at' => '2022-01-25 17:14:59',
            ),
            6 => 
            array (
                'id' => 7,
                'desa_adat_id' => 325,
                'kode_banjar_adat' => '0325031',
                'nama_banjar_adat' => 'Antosari Kaja',
                'created_at' => '2022-01-25 16:15:04',
                'updated_at' => '2022-01-25 17:15:05',
                'deleted_at' => '2022-01-25 17:15:05',
            ),
            7 => 
            array (
                'id' => 8,
                'desa_adat_id' => 325,
                'kode_banjar_adat' => '0325041',
                'nama_banjar_adat' => 'Antosari Kelod',
                'created_at' => '2022-01-25 16:15:10',
                'updated_at' => '2022-01-25 17:15:11',
                'deleted_at' => '2022-01-25 17:15:11',
            ),
            8 => 
            array (
                'id' => 9,
                'desa_adat_id' => 325,
                'kode_banjar_adat' => '032501',
                'nama_banjar_adat' => 'Penida Kaja',
                'created_at' => '2022-01-28 07:34:09',
                'updated_at' => '2022-01-25 17:20:00',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'desa_adat_id' => 325,
                'kode_banjar_adat' => '032502',
                'nama_banjar_adat' => 'Penida Kelod',
                'created_at' => '2022-01-25 17:20:22',
                'updated_at' => '2022-01-25 17:20:22',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045801',
                'nama_banjar_adat' => 'Banjar Kangin',
                'created_at' => '2022-01-28 07:34:12',
                'updated_at' => '2022-01-25 17:33:45',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045802',
                'nama_banjar_adat' => 'Banjar Tengah',
                'created_at' => '2022-01-25 17:34:00',
                'updated_at' => '2022-01-25 17:34:00',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045803',
                'nama_banjar_adat' => 'Banjar Gede',
                'created_at' => '2022-01-25 17:34:39',
                'updated_at' => '2022-01-25 17:34:39',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045804',
                'nama_banjar_adat' => 'Banjar Sengguan',
                'created_at' => '2022-01-25 17:34:52',
                'updated_at' => '2022-01-25 17:34:52',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045805',
                'nama_banjar_adat' => 'Banjar Gerokgak',
                'created_at' => '2022-01-25 17:35:03',
                'updated_at' => '2022-01-25 17:35:03',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045806',
                'nama_banjar_adat' => 'Banjar Sebita',
                'created_at' => '2022-01-25 17:35:15',
                'updated_at' => '2022-01-25 17:35:15',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045807',
                'nama_banjar_adat' => 'Banjar Ubung',
                'created_at' => '2022-01-25 17:35:29',
                'updated_at' => '2022-01-25 17:35:29',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045808',
                'nama_banjar_adat' => 'Banjar Batanasem',
                'created_at' => '2022-01-25 17:37:18',
                'updated_at' => '2022-01-25 17:37:18',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045809',
                'nama_banjar_adat' => 'Banjar Pande',
                'created_at' => '2022-01-25 17:37:30',
                'updated_at' => '2022-01-25 17:37:30',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'desa_adat_id' => 458,
                'kode_banjar_adat' => '045810',
                'nama_banjar_adat' => 'Banjar Tegeha',
                'created_at' => '2022-01-25 17:37:45',
                'updated_at' => '2022-01-25 17:37:45',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'desa_adat_id' => 325,
                'kode_banjar_adat' => '032503',
                'nama_banjar_adat' => 'Cobaaaaa',
                'created_at' => '2022-01-26 08:09:49',
                'updated_at' => '2022-01-26 09:09:48',
                'deleted_at' => '2022-01-26 09:09:48',
            ),
        ));
        
        
    }
}