<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKeluargaBesarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_keluarga_besar', function (Blueprint $table) {
            $table->foreign(['kepala_keluarga_besar_id'], 'tb_keluarga_besar_ibfk_2')->references(['id'])->on('tb_penduduk');
            $table->foreign(['banjar_adat_id'], 'tb_keluarga_besar_ibfk_1')->references(['id'])->on('tb_m_banjar_adat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_keluarga_besar', function (Blueprint $table) {
            $table->dropForeign('tb_keluarga_besar_ibfk_2');
            $table->dropForeign('tb_keluarga_besar_ibfk_1');
        });
    }
}
