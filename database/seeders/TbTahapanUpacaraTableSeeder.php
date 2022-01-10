<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TbTahapanUpacaraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tb_tahapan_upacara')->delete();

        DB::table('tb_tahapan_upacara')->insert(array (
            0 =>
            array (
                'id_tahapan_upacara' => 1,
                'id_upacara' => 1,
                'nama_tahapan' => 'Masakapan Kapawon',
                'deskripsi_tahapan' => ' Masakapan Kapawon dan dilaksanakan di dapur, mengandung makna bahwa tugas pertama seseorang yang sudah dewasa dan siap berumah tangga adalah mengurus masalah dapur (logistik). Seseorang diminta bertanggung jawab untuk kelangsungan hidup keluarga di kemud',
                'status_tahapan' => 'awal',
            ),
            1 =>
            array (
                'id_tahapan_upacara' => 2,
                'id_upacara' => 1,
                'nama_tahapan' => 'Ngekeb',
                'deskripsi_tahapan' => 'Prosesi ini dilakukan di meten atau di gedong, mengandung makna pelaksanaan Brata, yakni janji untuk mengendalikan diri dari berbagai dorongan dan godaan nafsu, terutama dorongan negatif yang disimboliskan dengan Sadripu, yakni enam musuh pada diri pribad',
                'status_tahapan' => 'awal',
            ),
            2 =>
            array (
                'id_tahapan_upacara' => 3,
                'id_upacara' => 1,
                'nama_tahapan' => 'Mepandes/Potong Gigi',
                'deskripsi_tahapan' => 'Upacara potong gigi yang dilakukan oleh umat Hindu-Bali bila seseorang telah beranjak dewasa.',
                'status_tahapan' => 'awal',
            ),
            3 =>
            array (
                'id_tahapan_upacara' => 4,
                'id_upacara' => 2,
                'nama_tahapan' => 'Memangguh',
            'deskripsi_tahapan' => 'Mamangguh merupakan proses mencari sebidang tanah yang cocok untuk dijadikan pura dengan memohon petunjuk dari Ida Sang Hyang Widhi (Tuhan Yang Maha Esa). Memangguh bersalah dari kata "pangguh" atau "panggih" yang artinya menemukan. Memangguh lebih cender',
                'status_tahapan' => 'awal',
            ),
            4 =>
            array (
                'id_tahapan_upacara' => 5,
                'id_upacara' => 2,
                'nama_tahapan' => 'Macarau',
            'deskripsi_tahapan' => 'Proses Macaru bermakna sebagai korban suci/pengorbanan yang tulis ihklas kehadapan Sang Hyang Widhi (Tuhan Yang Maha Esa) untuk keseimbangan dan keselarasan. Macaru berasal dari kata "caru" artinya korban suci. Pemahaman ini terdapat dalam ajaran Hindu Tr',
                'status_tahapan' => 'awal',
            ),
            5 =>
            array (
                'id_tahapan_upacara' => 6,
                'id_upacara' => 2,
                'nama_tahapan' => 'Piodalan',
                'deskripsi_tahapan' => 'Setelah upacara ngenteg linggih dilanjutkan dengan upacara piodalan, yakni penyambutan yang pertama bahwa pura telah berdiri yang diikuti persembahyangan bersama.',
                'status_tahapan' => 'awal',
            ),
        ));


    }
}
