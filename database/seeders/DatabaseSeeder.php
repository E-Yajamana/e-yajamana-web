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

        $this->call(TbUserTableSeeder::class);
        $this->call(TbUpacaraTableSeeder::class);
        $this->call(TbKramaTableSeeder::class);
        $this->call(TbGriyaRumahTableSeeder::class);
        $this->call(TbProvinsiBaruTableSeeder::class);
        $this->call(TbKecamatanTableSeeder::class);
        $this->call(TbKabupatenBaruTableSeeder::class);
        $this->call(TbDesaTableSeeder::class);
        $this->call(TbDesaadatTableSeeder::class);
        $this->call(TbTahapanUpacaraTableSeeder::class);
        $this->call(TbUpacarakuTableSeeder::class);
        $this->call(TbSulinggihTableSeeder::class);
        $this->call(TbSanggarTableSeeder::class);
        $this->call(TbSeratiTableSeeder::class);
        $this->call(TbReservasiTableSeeder::class);
        $this->call(TbDetailReservasiTableSeeder::class);

        Schema::enableForeignKeyConstraints();
        
    }
}
