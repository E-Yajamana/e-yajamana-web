<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKeluargaKramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_keluarga_krama', function (Blueprint $table) {
            $table->foreign(['banjar_adat_id'], 'tb_keluarga_krama_ibfk_1')->references(['id'])->on('tb_m_banjar_adat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_keluarga_krama', function (Blueprint $table) {
            $table->dropForeign('tb_keluarga_krama_ibfk_1');
        });
    }
}
