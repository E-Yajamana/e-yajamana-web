<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbUpacarakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_upacaraku', function (Blueprint $table) {
            $table->foreign(['id_banjar_dinas'], 'tb_upacaraku_ibfk_3')->references(['id'])->on('tb_m_banjar_dinas');
            $table->foreign(['id_upacara'], 'tb_upacaraku_ibfk_2')->references(['id'])->on('tb_upacara');
            $table->foreign(['id_krama'], 'tb_upacaraku_ibfk_1')->references(['id'])->on('tb_user_eyajamana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_upacaraku', function (Blueprint $table) {
            $table->dropForeign('tb_upacaraku_ibfk_3');
            $table->dropForeign('tb_upacaraku_ibfk_2');
            $table->dropForeign('tb_upacaraku_ibfk_1');
        });
    }
}
