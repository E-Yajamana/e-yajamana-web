<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbServiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_service')->delete();
        
        \DB::table('tb_service')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_service' => 'Gambelan Gong Kebyar',
            'deskripsi_service' => 'Gong Kebyar adalah sebuah barungan baru. Sesuai dengan nama yang diberikan kepada barungan ini (Kebyar yang bermakna cepat, tiba-tiba dan keras) gamelan ini menghasilkan musik-musik keras dan dinamis. Gamelan ini dipakai untuk mengiringi tari-tarian atau memainkan tabuh-tabuhan instrumental. Secara fisik Gong Kebyar adalah pengembangan kemudian dari Gong Gede dengan pengurangan peranan, atau pengurangan beberapa buah instrumennya. Misalnya saja peranan trompong dalam Gong Gebyar dikurangi, bahkan pada tabuh-tabuh tertentu tidak dipakai sama sekali, gangsa jongkoknya yang berbilah 5 dirubah menjadi gangsa gantung berbilah 9 atau 10 . cengceng kopyak yang terdiri dari 4 sampai 6 pasang dirubah menjadi 1 atau 2 set cengceng kecil. Kendang yang semula dimainkan dengan memakai panggul diganti dengan pukulan tangan.

Secara konsep Gong Kebyar adalah perpaduan antara Gender Wayang, Gong Gede dan Pelegongan. Rasa-rasa musikal maupun pola pukulan instrumen Gong Kebyar ada kalanya terasa Gender Wayang yang lincah, Gong Gedeyang kokoh atau Pelegonganyang melodis. Pola Gagineman Gender Wayang, pola Gegambangan dan pukulan Kaklenyongan Gong Gede muncul dalam berbagai tabuh Gong Kebyar. Gamelan Gong Kebyar adalah produk kebudayaan Bali modern. Barungan ini diperkirakan muncul di Singaraja pada tahun 1915 (McPhee, 1966 : 328). Desa yang sebut-sebut sebagai asal pemunculan Gong Kebyar adalah Jagaraga (Buleleng) yang juga memulai tradisi Tari Kebyar. Ada juga informasi lain yang menyebutkan bahwa Gong Kebyar muncul pertama kali di desa Bungkulan (Buleleng). Perkembangan Gong Kebyar mencapai salah satu puncaknya pada tahun 1925 dengan datangnya seorang penari Jauk yang bernama I Mario dari Tabanan yang menciptakan sebuah tari Kebyar Duduk atau Kebyar Trompong.

Gong Kebyar berlaras pelog lima nada dan kebanyakan instrumennya memiliki 10 sampai 12 nada, karena konstruksi instrumennya yang lebih ringan jika dibandingkandengan Gong Gede. Tabuh-tabuh Gong Kebyar lebih lincah dengan komposisi yang lebih bebas, hanya pada bagian-bagian tertentu saja hukum-hukum tabuh klasik masih dipergunakan, seperti Tabuh Pisan, Tabuh Dua, Tabuh Telu dan sebagainya.

Lagu-lagunya seringkali merupakan penggarapan kembali terhadap bentuk-bentuk (repertoire) tabuh klasik dengan merubah komposisinya, melodi, tempo dan ornamentasi melodi. Matra tidak lagi selamanya ajeg, pola ritme ganjil muncul di beberapa bagian komposisi tabuh.',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama_service' => 'Gamelan Geguntangan',
                'deskripsi_service' => 'Gamelan Geguntangan adalah barungan baru yang juga disebut sebagai gamelan Arja atau Paarjaan. Gamelan ini adalah pengiring pertunjukan dramatari Arja yang diperkirakan muncul pada permulaan abad XX. Sesuai dengan bentuk Arja yang lebih mengutamakan tembang dan melodrama, maka diperlukan musik pengiring yang suaranya tidak terlalu keras, sehingga tidak sampai mengurangi keindahan lagu-lagu vokal yang dinyanyikan para penari. Melibatkan antara 10 sampai 12 orang penabuh, gamelan ini termasuk barungan kecil.',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama_service' => 'Tari Wali',
                'deskripsi_service' => 'Tari sakral Bali adalah sebutan lain untuk tari wali atai tari sanghyang. Tarian yang masuk kelompok ini hanya boleh dipentaskan ketika upacara keagamaan. Biasanya tarian-tarian wali merupakan pelengkap upacara keagamaan.',
                'created_at' => '2022-07-14 11:19:44',
                'updated_at' => '2022-07-14 11:19:44',
            ),
            3 => 
            array (
                'id' => 4,
                'nama_service' => 'Tari Bebali',
                'deskripsi_service' => 'Tarian ini adalah jenis tari semi sakral yang dapat difungsikan untuk acara adat keagamaan serta tari hiburan. Jika dipentaskan di area pura, biasanya dilakukan di halaman tengah atau madya madala. Kisah yang diangkat dalam tarian ini adalah kalon terkait upacara tersebut.',
                'created_at' => '2022-07-14 11:19:52',
                'updated_at' => '2022-07-14 11:19:52',
            ),
            4 => 
            array (
                'id' => 5,
                'nama_service' => 'Tari Balihan',
                'deskripsi_service' => 'Kelompok tari ini berfungsi sebagai tarian hiburan masyarakt. Umumnya tari jenis ini dipentaskan di panggung atau gedung serta are terluar pura. Tari balihan selalu mengalami dinamika dan perkembangan oleh senimat tari Bali.',
                'created_at' => '2022-07-14 11:19:59',
                'updated_at' => '2022-07-14 11:19:59',
            ),
            5 => 
            array (
                'id' => 6,
                'nama_service' => 'Tari Kecak',
                'deskripsi_service' => 'Tari kecak adalah tarian Bali yang sangat terkenal. Tarian ini dimainkan oleh puluhan bahkan ratusan penari laki-laki yang membentuk formasi lingkaran. Ciri utama dari tari kecak adalah teriakan kata “cak cak cak” secara serentak oleh para penari dengan gerakan dua tangan keatas.',
                'created_at' => '2022-07-14 11:20:17',
                'updated_at' => '2022-07-14 11:20:17',
            ),
            6 => 
            array (
                'id' => 7,
                'nama_service' => 'Tari Pendet',
                'deskripsi_service' => 'Tari pendet adalah tarian pemujaan yang sering dipentaskan di pura oleh umat Hindu sebagai bagian dari prosesi ibadah untuk menyambut datangnya Dewa dari langit. Jenis tarian Bali ini dimainkan oleh penari wanita dalam jumlah tertentu dengan mengenakan pakaian adat khas Bali. Para penari dilengkapi pula dengan hiasan bunga serta membawa sesajen.',
                'created_at' => '2022-07-14 11:20:45',
                'updated_at' => '2022-07-14 11:20:45',
            ),
            7 => 
            array (
                'id' => 8,
                'nama_service' => 'Tari Barong',
                'deskripsi_service' => 'Tari yang berasal dari Bali ini dimainkan oleh penari dengan mengenakan kostum barong berwajah seram berhiaskan ornamen khas Bali. Kata barong dalam tarian ini diduga berasal dari kata “bahruang” atau berarti beruang.',
                'created_at' => '2022-07-14 11:20:54',
                'updated_at' => '2022-07-14 11:20:54',
            ),
            8 => 
            array (
                'id' => 9,
                'nama_service' => 'Tari Legong',
                'deskripsi_service' => 'Menurut sejarahnya, tari legong adalah tarian yang berasal dari lingkungan keraton. Akan tetapi seiring perkembangan zaman, tarian ini menyebar di masyarakat dan dapat dijumpai saat acara-acara lain. Kata “legong” mempunyai makna, yaitu “leg” atau luwes dan “gong” yang berarti gamelan tradisional Bali.',
                'created_at' => '2022-07-14 11:21:08',
                'updated_at' => '2022-07-14 11:21:08',
            ),
            9 => 
            array (
                'id' => 10,
                'nama_service' => 'Tari Trunajaya',
                'deskripsi_service' => 'Trunajaya adalah tari Bali yang mengisahkan tentang seorang lelaki yang jatuh cinta dan ingin memikat hati perempuan pujaannya. Pada awalnya tarian ini hanya dimainkan oleh penari pria, akan tetapi kemudian berkembang dan tarian ini dilakukan pula oleh wanita.',
                'created_at' => '2022-07-14 11:21:18',
                'updated_at' => '2022-07-14 11:21:18',
            ),
            10 => 
            array (
                'id' => 11,
                'nama_service' => 'Tari Baris',
                'deskripsi_service' => 'Tari baris adalah salah satu tarian ritual Bali yang kini berkembang menjadi tarian hiburan masyarakat. Sesuai dengan namanya, tarian ini dilakukan dengan pola atau formasi berbaris 8 hingga 40 penari laki-laki.',
                'created_at' => '2022-07-14 11:21:26',
                'updated_at' => '2022-07-14 11:21:26',
            ),
            11 => 
            array (
                'id' => 12,
                'nama_service' => 'Tari Panji Semirang',
                'deskripsi_service' => 'Panji semirang adalah tari Bali yang diciptakan oleh seniman bernama I Nyoman Kaler pada tahun 1942. Tari panji semirang mengisahkan tentang petualangan Putri Galuh Candrakirana saat mengebara dan menyamar sebagai lelaki bernama Raden Panji untuk menghilangkan kesedihan seusai suaminya meninggal.',
                'created_at' => '2022-07-14 11:21:33',
                'updated_at' => '2022-07-14 11:21:33',
            ),
            12 => 
            array (
                'id' => 13,
                'nama_service' => 'Tari Margapati',
                'deskripsi_service' => 'Tari margapati adalah tarian bali yang mempunyai makna sebagai tarian menuju kematian. Ketika melihat pentas tarian ini, kita akan menyaksikan penari gagah dan bergerak lincah bagai laki-laki. Gerakan tersebut dilakukan secara cepat seakan-akan hendak menyergap.',
                'created_at' => '2022-07-14 11:21:44',
                'updated_at' => '2022-07-14 11:21:44',
            ),
            13 => 
            array (
                'id' => 14,
                'nama_service' => 'Tari Wirayudha',
                'deskripsi_service' => 'Tari wirayudha adalah tarian perang dari Bali yang diperankan oleh 2 sampai 4 orang penari pria dilengkapi senjata tombak. Tari Bali ini bercerita tentang sekelompok Bali Dwipa yang sedang bersiap untuk maju dan bertempur di peperangan.',
                'created_at' => '2022-07-14 11:21:51',
                'updated_at' => '2022-07-14 11:21:51',
            ),
        ));
        
        
    }
}