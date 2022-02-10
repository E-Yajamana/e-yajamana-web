<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUserEyajamanaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tb_user_eyajamana')->delete();

        \DB::table('tb_user_eyajamana')->insert(array (
            0 =>
            array (
                'id' => 1,
                'id_penduduk' => NULL,
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$Krx60SatPlhgbfi7N64hQu2Gl0UMh.BHObl43TLxOvbRyzLZhYyVa',
                'nomor_telepon' => '081241241242',
                'user_profile' => NULL,
                'role' => 'admin',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-02-11 01:26:27',
                'updated_at' => '2022-02-11 01:26:27',
            ),
            1 =>
            array (
                'id' => 2,
                'id_penduduk' => NULL,
                'email' => 'pemangku@gmail.com',
                'password' => '$2y$10$nM0nw0c2vn998byhOfga3.JYmI0dukGVyO1XmpnJ6.G8.RdAODDVS',
                'nomor_telepon' => '081241241243',
                'user_profile' => NULL,
                'role' => 'pemangku',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-02-11 01:26:27',
                'updated_at' => '2022-02-11 01:26:27',
            ),
            2 =>
            array (
                'id' => 3,
                'id_penduduk' => NULL,
                'email' => 'sanggar@gmail.com',
                'password' => '$2y$10$i7N6zfGDW2CjTnb7kCIgI.0ao58oo0aRkGiBPojwHFQxOBQ4jlWXe',
                'nomor_telepon' => '081241241244',
                'user_profile' => NULL,
                'role' => 'sanggar',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-02-11 01:26:27',
                'updated_at' => '2022-02-11 01:26:27',
            ),
            3 =>
            array (
                'id' => 4,
                'id_penduduk' => NULL,
                'email' => 'sulinggih@gmail.com',
                'password' => '$2y$10$nOomAKh72TtwR7ptgcpVwOSdKqvEIbPinnHFFJPzXiaIEUxAF6Azm',
                'nomor_telepon' => '081241241241',
                'user_profile' => NULL,
                'role' => 'sulinggih',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-02-11 01:26:27',
                'updated_at' => '2022-02-11 01:26:27',
            ),
            4 =>
            array (
                'id' => 5,
                'id_penduduk' => NULL,
                'email' => 'kramabali@gmail.com',
                'password' => '$2y$10$SujMYFtSwwKv66NSg.C26unq2/ql63DF2rVGkFXTPmEf84badCyn6',
                'nomor_telepon' => '081141241242',
                'user_profile' => NULL,
                'role' => 'krama_bali',
                'json_token_lupa_password' => NULL,
                'created_at' => '2022-02-11 01:26:27',
                'updated_at' => '2022-02-11 01:26:27',
            ),
        ));


    }
}
