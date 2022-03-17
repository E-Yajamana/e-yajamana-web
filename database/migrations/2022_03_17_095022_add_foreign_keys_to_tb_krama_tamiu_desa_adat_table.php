<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKramaTamiuDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_krama_tamiu_desa_adat', function (Blueprint $table) {
            $table->foreign(['banjar_adat_id'], 'tb_krama_tamiu_desa_adat_ibfk_1')->references(['id'])->on('tb_m_banjar_adat');
            $table->foreign(['banjar_dinas_id'], 'tb_krama_tamiu_desa_adat_ibfk_3')->references(['id'])->on('tb_m_banjar_dinas');
            $table->foreign(['penduduk_id'], 'tb_krama_tamiu_desa_adat_ibfk_2')->references(['id'])->on('tb_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_krama_tamiu_desa_adat', function (Blueprint $table) {
            $table->dropForeign('tb_krama_tamiu_desa_adat_ibfk_1');
            $table->dropForeign('tb_krama_tamiu_desa_adat_ibfk_3');
            $table->dropForeign('tb_krama_tamiu_desa_adat_ibfk_2');
        });
    }
}
