<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbPrajuruBanjarAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_prajuru_banjar_adat', function (Blueprint $table) {
            $table->foreign(['user_id'], 'tb_prajuru_banjar_adat_ibfk_3')->references(['id'])->on('tb_user');
            $table->foreign(['krama_mipil_id'], 'tb_prajuru_banjar_adat_ibfk_2')->references(['id'])->on('tb_krama_mipil_desa_adat');
            $table->foreign(['banjar_adat_id'], 'tb_prajuru_banjar_adat_ibfk_1')->references(['id'])->on('tb_m_banjar_adat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_prajuru_banjar_adat', function (Blueprint $table) {
            $table->dropForeign('tb_prajuru_banjar_adat_ibfk_3');
            $table->dropForeign('tb_prajuru_banjar_adat_ibfk_2');
            $table->dropForeign('tb_prajuru_banjar_adat_ibfk_1');
        });
    }
}