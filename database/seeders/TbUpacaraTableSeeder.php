<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUpacaraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tb_upacara')->delete();

        \DB::table('tb_upacara')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nama_upacara' => 'Potong Gigi',
                'kategori_upacara' => 'Manusa Yadnya',
                'deskripsi_upacara' => 'Potong gigi (bahasa Bali: mepandes, mesangih atau metatah) adalah upacara keagamaan Hindu-Bali bila seorang Anak sudah beranjak dewasa,dan diartikan juga pembayaran hutang oleh Orang Tua ke Anaknya karena sudah bisa menghilangkan keenam sifat buruk dari d',
                'image' => 'app/admin/master-data/upacara/1642845641-screen-0jpg.jpg',
                'created_at' => NULL,
                'updated_at' => '2022-01-22 10:00:41',
            ),
            1 =>
            array (
                'id' => 2,
                'nama_upacara' => 'Ngenteg Linggi',
                'kategori_upacara' => 'Dewa Yadnya',
            'deskripsi_upacara' => 'Upacara Ngenteg Linggih bertujuan untuk menyucikan atau mensakralkan Sthana Hyang Widhi Wasa beserta manifestasinya, sehingga bangunan yang diupacarai memenuhi syarat sebagai "Niyasa" (simbol) objek konsentrasi pemujaan.',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nama_upacara' => 'Piodalan Ring Pura',
                'kategori_upacara' => 'Dewa Yadnya',
                'deskripsi_upacara' => 'Piodalan yang utamanya sebagai kelompok upacara Dewa Yadnya ini merupakan upacara yang ditujukan kehadapan Ida Sang Hyang Widhi Waça dengan segala manifestasinya yang pujawalinya dipimpin oleh seorang pemangku di tempat suci masing-masing.',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 5,
                'nama_upacara' => 'testing upacara',
                'kategori_upacara' => 'Pitra Yadnya',
                'deskripsi_upacara' => 'testing uapcara deskripsi',
                'image' => 'app/admin/master-data/upacara/1643454107-unnamedpng.png',
                'created_at' => '2022-01-29 19:01:47',
                'updated_at' => '2022-01-29 19:01:47',
            ),
        ));


    }
}
