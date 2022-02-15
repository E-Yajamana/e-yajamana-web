<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbGriyaRumahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_griya_rumah', function (Blueprint $table) {
            $table->foreign(['id_banjar_dinas'], 'tb_griya_rumah_ibfk_1')->references(['id'])->on('tb_m_banjar_dinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_griya_rumah', function (Blueprint $table) {
            $table->dropForeign('tb_griya_rumah_ibfk_1');
        });
    }
}
