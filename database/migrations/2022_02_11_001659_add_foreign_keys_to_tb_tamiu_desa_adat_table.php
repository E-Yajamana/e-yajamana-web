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
            $table->foreign(['wna_id'], 'tb_tamiu_desa_adat_ibfk_1')->references(['id'])->on('tb_wna');
            $table->foreign(['penduduk_id'], 'tb_tamiu_desa_adat_ibfk_2')->references(['id'])->on('tb_penduduk');
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
            $table->dropForeign('tb_tamiu_desa_adat_ibfk_1');
            $table->dropForeign('tb_tamiu_desa_adat_ibfk_2');
        });
    }
}
