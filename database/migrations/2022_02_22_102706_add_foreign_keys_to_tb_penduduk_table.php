<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_penduduk', function (Blueprint $table) {
            $table->foreign(['profesi_id'], 'tb_penduduk_ibfk_3')->references(['id'])->on('tb_m_profesi');
            $table->foreign(['ayah_kandung_id'], 'tb_penduduk_ibfk_5')->references(['id'])->on('tb_penduduk');
            $table->foreign(['pendidikan_id'], 'tb_penduduk_ibfk_4')->references(['id'])->on('tb_m_pendidikan');
            $table->foreign(['ibu_kandung_id'], 'tb_penduduk_ibfk_6')->references(['id'])->on('tb_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_penduduk', function (Blueprint $table) {
            $table->dropForeign('tb_penduduk_ibfk_3');
            $table->dropForeign('tb_penduduk_ibfk_5');
            $table->dropForeign('tb_penduduk_ibfk_4');
            $table->dropForeign('tb_penduduk_ibfk_6');
        });
    }
}
