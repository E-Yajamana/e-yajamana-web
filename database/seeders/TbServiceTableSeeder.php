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
            ),
            1 => 
            array (
                'id' => 2,
                'nama_service' => 'Gamelan Geguntangan',
                'deskripsi_service' => 'Gamelan Geguntangan adalah barungan baru yang juga disebut sebagai gamelan Arja atau Paarjaan. Gamelan ini adalah pengiring pertunjukan dramatari Arja yang diperkirakan muncul pada permulaan abad XX. Sesuai dengan bentuk Arja yang lebih mengutamakan tembang dan melodrama, maka diperlukan musik pengiring yang suaranya tidak terlalu keras, sehingga tidak sampai mengurangi keindahan lagu-lagu vokal yang dinyanyikan para penari. Melibatkan antara 10 sampai 12 orang penabuh, gamelan ini termasuk barungan kecil.',
            ),
        ));
        
        
    }
}