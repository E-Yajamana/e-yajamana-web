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
            4 =>
            array (
                'id' => 6,
                'nama_upacara' => 'Atma Wedana',
                'kategori_upacara' => 'Pitra Yadnya',
                'deskripsi_upacara' => 'Atma Wedana adalah upacara yadnya yang bertujuan untuk menyucikan sang atma pitara setelah prosesi ngaben atau sawa wedana selesai yang dilaksanakan dengan upacara Nyekah atau Mamukur.

Melalui upacara Atma Wedana ini yang diawali dengan dilaksanakannya upacara ngangget don bingin sebagai sarana ngawi sekah utawi puspa sarira sajeroning upacara mamukur sehingga nantinya roh atau atman leluhur kita itu menjadi Dewa Pitara untuk selanjutnya dapat menstanakannya di Kemulan.',
                'image' => 'app/admin/master-data/upacara/1644653190-default-mac-wallpaper-17-1920x1200jpg.jpg',
                'created_at' => '2022-02-12 16:06:30',
                'updated_at' => '2022-02-12 16:06:30',
            ),
            5 =>
            array (
                'id' => 7,
                'nama_upacara' => 'Mecaru',
                'kategori_upacara' => 'Bhuta Yadnya',
            'deskripsi_upacara' => 'Mecaru adalah bagian dari upacara Bhuta Yadnya (mungkin dapat disebut sebagai danhyangan dalam bahasa Jawa) sebagai salah satu bentuk usaha untuk menetralisir kekuatan alam semesta/Panca Maha Bhuta. Upacara mecaru dapat dilakukan baik di area pura ataupun natah di rumah.',
                'image' => 'app/admin/master-data/upacara/1644653528-screen-0jpg.jpg',
                'created_at' => '2022-02-12 16:12:08',
                'updated_at' => '2022-02-12 16:12:08',
            ),
        ));


    }
}
