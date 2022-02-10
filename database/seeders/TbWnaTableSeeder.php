<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbWnaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_wna')->delete();
        
        \DB::table('tb_wna')->insert(array (
            0 => 
            array (
                'id' => 1,
                'negara_id' => 5,
                'nomor_paspor' => 'A7537543',
                'nama' => 'Robert Samoaa',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'LA',
                'tanggal_lahir' => '2022-01-20',
                'alamat' => 'Br. Canggu Kaja No.1',
                'foto' => NULL,
                'created_at' => '2022-01-21 11:53:28',
                'updated_at' => '2022-01-21 04:53:27',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'negara_id' => 6,
                'nomor_paspor' => 'A7584244',
                'nama' => 'Benedict Aldous',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'LA',
                'tanggal_lahir' => '2022-01-20',
                'alamat' => 'Br. Sading No. 6',
                'foto' => NULL,
                'created_at' => '2022-01-20 18:06:21',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'negara_id' => 230,
                'nomor_paspor' => 'A7532646',
                'nama' => 'Mark Rufallo',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Penida Kaja',
                'tanggal_lahir' => '2022-01-12',
                'alamat' => 'Denpasar',
                'foto' => '/storage/image/wna/A7532646/foto/61e94862df27a.png',
                'created_at' => '2022-01-20 18:32:59',
                'updated_at' => '2022-01-20 11:32:50',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'negara_id' => 230,
                'nomor_paspor' => 'A7584245',
                'nama' => 'Scarlett',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'LA',
                'tanggal_lahir' => '2022-01-17',
                'alamat' => 'Denpasar',
                'foto' => '/storage/image/wna/A7584245/foto/61e967a8789de.png',
                'created_at' => '2022-01-20 20:46:26',
                'updated_at' => '2022-01-20 13:46:16',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'negara_id' => 230,
                'nomor_paspor' => 'A7584249',
                'nama' => 'Tom Holland',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'London',
                'tanggal_lahir' => '2000-06-13',
                'alamat' => 'Br. Penida Kaja, Tembuku',
                'foto' => NULL,
                'created_at' => '2022-01-21 02:03:47',
                'updated_at' => '2022-01-21 02:03:47',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}