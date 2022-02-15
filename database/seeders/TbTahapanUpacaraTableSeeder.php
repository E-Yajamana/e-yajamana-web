<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbTahapanUpacaraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_tahapan_upacara')->delete();
        
        \DB::table('tb_tahapan_upacara')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_upacara' => 1,
                'nama_tahapan' => 'Magumi Padangan 2',
                'deskripsi_tahapan' => 'Upacara ini juga di sebut mesakapan kepawon dan dilaksanakan di dapur',
                'status_tahapan' => 'awal',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-01-29 15:12:58',
            ),
            1 => 
            array (
                'id' => 2,
                'id_upacara' => 1,
                'nama_tahapan' => 'nekeb',
                'deskripsi_tahapan' => 'Upacara ini dilakukan di meten atau di gedong',
                'status_tahapan' => 'awal',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_upacara' => 1,
                'nama_tahapan' => 'Mabyakala',
                'deskripsi_tahapan' => 'Ini dilakukan di halaman rumah di depan meten atau gedong',
                'status_tahapan' => 'puncak',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'id_upacara' => 1,
                'nama_tahapan' => 'Mapinton ',
                'deskripsi_tahapan' => 'ke Pura Kahyangan Tiga, ke Pura Kawitan dan ke Pura lainnya yang menjadi pujaannya.',
                'status_tahapan' => 'puncak',
                'image' => 'app/admin/master-data/upacara/tahapan/1642845684-screen-0jpg.jpg',
                'created_at' => NULL,
                'updated_at' => '2022-01-22 10:11:23',
            ),
            4 => 
            array (
                'id' => 5,
                'id_upacara' => 2,
                'nama_tahapan' => 'Memangguh',
            'deskripsi_tahapan' => 'Mamangguh merupakan proses mencari sebidang tanah yang cocok untuk dijadikan pura dengan memohon petunjuk dari Ida Sang Hyang Widhi (Tuhan Yang Maha Esa). Memangguh bersalah dari kata "pangguh" atau "panggih" yang artinya menemukan. Memangguh lebih cenderung diartikan sebagai menemukan bidang tanah secara niskala (niskala = tidak nyata).',
                'status_tahapan' => 'awal',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'id_upacara' => 2,
                'nama_tahapan' => 'Macaru',
            'deskripsi_tahapan' => 'Proses Macaru bermakna sebagai korban suci/pengorbanan yang tulis ihklas kehadapan Sang Hyang Widhi (Tuhan Yang Maha Esa) untuk keseimbangan dan keselarasan. Macaru berasal dari kata "caru" artinya korban suci. Pemahaman ini terdapat dalam ajaran Hindu Tri Hita Karana (tri = tiga, hita = kebaikan, karana= sebab. Jadi Trinitakarana adalah tiga hal yang menyebabkan kebaikan). Tentang tingkatan upacara Caru disesuaikan dengan kemampuan umat Hindu setempat.',
                'status_tahapan' => 'awal',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'id_upacara' => 2,
                'nama_tahapan' => 'Piodalan',
                'deskripsi_tahapan' => 'Setelah upacara ngenteg linggih dilanjutkan dengan upacara piodalan, yakni penyambutan yang pertama bahwa pura telah berdiri yang diikuti persembahyangan bersama.',
                'status_tahapan' => 'puncak',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'id_upacara' => 2,
                'nama_tahapan' => 'Melaspas',
            'deskripsi_tahapan' => 'Melaspas dilakukan sebagai wujud rasa terima kasih kehadapan Ida Sang Hyang Widhi (Tuhan Yang Maha Esa), yang telah memberikan alam berserta isi nya untuk kebutuhan manusia berupa bahan bahan keperluan untuk membangun tempat suci (terdiri dari kayu dan batu), yang akan digunakan berdasarkan keperluan yang ada, dan sisanya akan di kembalikan lagi kealam semesta. Mlaspas berasal dari kata pas (tidak lebih-tidak kurang).',
                'status_tahapan' => 'puncak',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'id_upacara' => 2,
                'nama_tahapan' => 'Nganyarin',
                'deskripsi_tahapan' => 'Upacara ini berlangsung sehari setelah hari upacara ngenteg linggih dan piodalan, berturut-turut setiap hari sampai upacara Masineb.',
                'status_tahapan' => 'akhir',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'id_upacara' => 3,
                'nama_tahapan' => 'Ngarga Tirta Suci',
                'deskripsi_tahapan' => 'Proses ini merupakan proses dimana pemangku melakukan penyucian terhadap tirta yang akan digunakan dalam upacara tersebut, kemudian setelah proses penyucian selesai, tirta tersebut "dihidupkan" atau di Pasupati.',
                'status_tahapan' => 'awal',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'id_upacara' => 1,
                'nama_tahapan' => 'Mepandes/Potong Gigi',
                'deskripsi_tahapan' => 'Upacara potong gigi yang dilakukan oleh umat Hindu-Bali bila seseorang telah beranjak dewasa.',
                'status_tahapan' => 'akhir',
                'image' => 'app/admin/master-data/upacara/tahapan/1642832123-default-mac-wallpaper-17-1920x1200jpg.jpg',
                'created_at' => '2022-01-22 06:15:23',
                'updated_at' => '2022-01-22 09:58:45',
            ),
            11 => 
            array (
                'id' => 14,
                'id_upacara' => 3,
                'nama_tahapan' => 'Persiapan Pemangku',
                'deskripsi_tahapan' => 'Pemangku melakukan pembersihan diri dan juga sarana yang digunakan dalam upacara dengan tujuan agar menyucikan kedua hal tersebut.',
                'status_tahapan' => 'awal',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 15,
                'id_upacara' => 3,
                'nama_tahapan' => 'Ngaturang Ayaban Ring Batara Sami',
                'deskripsi_tahapan' => 'Prosesi persembahan sarana upacara kepada Dewa yang dilakukan oleh pemangku dengan mengucapkan mantra tertentu.',
                'status_tahapan' => 'puncak',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 16,
                'id_upacara' => 3,
                'nama_tahapan' => 'Ngelukat Caru',
            'deskripsi_tahapan' => 'Menyucikan Bhuta menjadi Dewa (dari kasar menjadi alus)',
                'status_tahapan' => 'puncak',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 17,
                'id_upacara' => 3,
                'nama_tahapan' => 'Ngeruwak Caru',
                'deskripsi_tahapan' => 'Ngeruwak caru merupakan salah satu prosesi yang bertujuan untuk memberikan persembahan kepada sang Bhuta karena suatu acara telah berjalan dengan lancar.',
                'status_tahapan' => 'akhir',
                'image' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 19,
                'id_upacara' => 5,
                'nama_tahapan' => 'tahapan awal',
                'deskripsi_tahapan' => 'awal dari tahapan',
                'status_tahapan' => 'awal',
                'image' => 'app/admin/master-data/upacara/tahapan1643454107-unnamedpng.png',
                'created_at' => '2022-01-29 19:01:47',
                'updated_at' => '2022-01-29 19:01:47',
            ),
            16 => 
            array (
                'id' => 20,
                'id_upacara' => 6,
                'nama_tahapan' => 'Wangun Bale Petak',
                'deskripsi_tahapan' => 'Wangun Bale Petak merupakan proses membangun Bale Petak yang digunakan sebagai tempat bersetana-Nya Sang Pitara di bale Payajnan. Bale Petak ini dibangun dalam keadaan yang cukup tinggi dikarenakan Sang Pitara bersetana disana.',
                'status_tahapan' => 'awal',
                'image' => 'app/admin/master-data/upacara/tahapan1644653190-default-mac-wallpaper-17-1920x1200jpg.jpg',
                'created_at' => '2022-02-12 16:06:30',
                'updated_at' => '2022-02-12 16:06:30',
            ),
            17 => 
            array (
                'id' => 22,
                'id_upacara' => 6,
                'nama_tahapan' => 'Nganyut ke Segara',
            'deskripsi_tahapan' => 'Nganyut ke Segara adalah merupakan tahap terakhir dari suatu upacara seperti Mamukur atau Ngaben, dapat dilakukan pagi hari selesai upacara Ngeseng Sekah (Upacara Ngirim). Setelah tiba di tepi pantai, arang/abu yang ditempatkan didalam kelapa gading dikeluarkan dan ditebarkan di tepi pantai yang didahului dengan upacara persembahyangan sesajen kepada Sang Hyang Baruna, sebagai penguasa laut, sekaligus permohonan penyucian terhadap roh yang diupacarakan dan diakhiri dengan persembayhangan oleh keluarga.',
                'status_tahapan' => 'akhir',
                'image' => 'app/admin/master-data/upacara/tahapan/1644653365-unnamedpng.png',
                'created_at' => '2022-02-12 16:09:25',
                'updated_at' => '2022-02-12 16:09:25',
            ),
            18 => 
            array (
                'id' => 23,
                'id_upacara' => 7,
                'nama_tahapan' => 'Mantraning Caru',
            'deskripsi_tahapan' => 'Merupakan prosesi awal sebelum dimulainya Upacara Mecaru. Banten (Upakara) Caru akan dibersihkan oleh Pemangku melalui mantram.',
                'status_tahapan' => 'puncak',
                'image' => 'app/admin/master-data/upacara/tahapan/1644653528-screen-0jpg.jpg',
                'created_at' => '2022-02-12 16:12:08',
                'updated_at' => '2022-02-12 16:12:08',
            ),
        ));
        
        
    }
}