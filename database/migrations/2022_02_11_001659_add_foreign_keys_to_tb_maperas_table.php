<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbMaperasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_maperas', function (Blueprint $table) {
            $table->foreign(['keluarga_lama_id'], 'tb_maperas_ibfk_1')->references(['id'])->on('tb_keluarga_krama');
            $table->foreign(['penduduk_id'], 'tb_maperas_ibfk_3')->references(['id'])->on('tb_penduduk');
            $table->foreign(['keluarga_baru_id'], 'tb_maperas_ibfk_2')->references(['id'])->on('tb_keluarga_krama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_maperas', function (Blueprint $table) {
            $table->dropForeign('tb_maperas_ibfk_1');
            $table->dropForeign('tb_maperas_ibfk_3');
            $table->dropForeign('tb_maperas_ibfk_2');
        });
    }
}
