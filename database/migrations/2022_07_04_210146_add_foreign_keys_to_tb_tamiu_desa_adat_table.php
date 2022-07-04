<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbTamiuDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_tamiu_desa_adat', function (Blueprint $table) {
            $table->foreign(['penduduk_id'], 'tb_tamiu_desa_adat_ibfk_2')->references(['id'])->on('tb_penduduk');
            $table->foreign(['wna_id'], 'tb_tamiu_desa_adat_ibfk_1')->references(['id'])->on('tb_wna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_tamiu_desa_adat', function (Blueprint $table) {
            $table->dropForeign('tb_tamiu_desa_adat_ibfk_2');
            $table->dropForeign('tb_tamiu_desa_adat_ibfk_1');
        });
    }
}
