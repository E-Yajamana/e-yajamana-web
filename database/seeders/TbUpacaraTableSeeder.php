<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbUpacaraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('tb_upacara')->delete();

        DB::table('tb_upacara')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nama_upacara' => 'Potong Gigi',
                'katagori_upacara' => 'Manusa Yadnya',
                'deskripsi_upacara' => 'Potong gigi (bahasa Bali: mepandes, mesangih atau metatah) adalah upacara keagamaan Hindu-Bali bila seorang Anak sudah beranjak dewasa,dan diartikan juga pembayaran hutang oleh Orang Tua ke Anaknya karena sudah bisa menghilangkan keenam sifat buruk dari d',
            ),
            1 =>
            array (
                'id' => 2,
                'nama_upacara' => 'Ngenteg Linggi',
                'katagori_upacara' => 'Dewa Yadnya',
                'deskripsi_upacara' => 'Upacara Ngenteg Linggih bertujuan untuk menyucikan atau mensakralkan Sthana Hyang Widhi Wasa beserta manifestasinya, sehingga bangunan yang diupacarai memenuhi syarat sebagai "Niyasa" (simbol) objek konsentrasi pemujaan.',
            ),
        ));


    }
}
