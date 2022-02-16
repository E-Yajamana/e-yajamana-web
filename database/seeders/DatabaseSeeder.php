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

        $this->call(TbUpacaraTableSeeder::class);
        $this->call(TbKramaTableSeeder::class);
        $this->call(TbGriyaRumahTableSeeder::class);
        $this->call(TbTahapanUpacaraTableSeeder::class);
        $this->call(TbUpacarakuTableSeeder::class);
        $this->call(TbSulinggihTableSeeder::class);
        $this->call(TbSanggarTableSeeder::class);
        $this->call(TbSeratiTableSeeder::class);
        $this->call(TbReservasiTableSeeder::class);

        $this->call(TbMProvinsiTableSeeder::class);
        $this->call(TbMKabupatenTableSeeder::class);
        $this->call(TbMKecamatanTableSeeder::class);
        $this->call(TbMDesaDinasTableSeeder::class);
        $this->call(TbMBanjarDinasTableSeeder::class);
        $this->call(TbMBanjarAdatTableSeeder::class);
        $this->call(TbMDesaAdatTableSeeder::class);
        $this->call(TbKramaMipilDesaAdatTableSeeder::class);
        $this->call(TbKramaTamiuDesaAdatTableSeeder::class);
        $this->call(TbTamiuDesaAdatTableSeeder::class);
        $this->call(TbWnaTableSeeder::class);
        $this->call(TbPendudukTableSeeder::class);
        $this->call(TbMProfesiTableSeeder::class);
        $this->call(TbMPendidikanTableSeeder::class);
        $this->call(TbUserEyajamanaTableSeeder::class);
        Schema::enableForeignKeyConstraints();

        $this->call(TbDetailReservasiTableSeeder::class);
    }
}
