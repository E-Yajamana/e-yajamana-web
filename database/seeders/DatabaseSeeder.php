<?php

namespace Database\Seeders;

use App\Models\Krama;
use App\Models\TahapanUpacara;
use App\Models\Upacara;
use App\Models\Upacaraku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Upacaraku::truncate();
        Krama::truncate();

        Krama::insert([
            [
                'id_user' => 1,
                'nama_krama' => "Krama Bali",
                'alamat_krama' => "Jalan Banteng no 12",
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '2000-01-12'
            ]
        ]);

        Upacaraku::insert([
            [
                'id_upacara' => 1,
                'id_krama' => 1,
                'nama_upacara' => 'Mepandes Putu Alex',
                'lokasi' => 'Jln Banteng no 12',
                'lat' => '-8.6350536',
                'lng' => '115.2123738',
                'tanggal_mulai' => '2022-07-12',
                'tanggal_selesai' => '2022-07-17',
                'desc' => 'Upacara metatah I Putu Alex',
            ]
        ]);

        Upacara::insert([
            [
                'nama_upacara' => 'Mepandes',
                'kategori' => 'Manusa Yadnya',
                'desc' => 'Upacara Manusa Yadnya Potong Gigi'
            ]
        ]);

        Schema::enableForeignKeyConstraints();

        $this->call(TbUserTableSeeder::class);
        $this->call(TbUpacaraTableSeeder::class);
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
