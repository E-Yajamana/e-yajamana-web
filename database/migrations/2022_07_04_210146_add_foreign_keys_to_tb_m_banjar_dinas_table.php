<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbMBanjarDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_m_banjar_dinas', function (Blueprint $table) {
            $table->foreign(['desa_dinas_id'], 'tb_m_banjar_dinas_ibfk_2')->references(['id'])->on('tb_m_desa_dinas');
            $table->foreign(['desa_adat_id'], 'tb_m_banjar_dinas_ibfk_1')->references(['id'])->on('tb_m_desa_adat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_m_banjar_dinas', function (Blueprint $table) {
            $table->dropForeign('tb_m_banjar_dinas_ibfk_2');
            $table->dropForeign('tb_m_banjar_dinas_ibfk_1');
        });
    }
}
