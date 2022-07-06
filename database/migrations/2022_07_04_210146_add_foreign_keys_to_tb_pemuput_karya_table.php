<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbPemuputKaryaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_pemuput_karya', function (Blueprint $table) {
            $table->foreign(['id_griya'], 'tb_pemuput_karya_ibfk_2')->references(['id'])->on('tb_griya_rumah');
            $table->foreign(['id_atribut'], 'tb_pemuput_karya_ibfk_5')->references(['id'])->on('tb_atribut_pemuput');
            $table->foreign(['id_user'], 'tb_pemuput_karya_ibfk_1')->references(['id'])->on('tb_user_eyajamana');
            $table->foreign(['id_pasangan'], 'tb_pemuput_karya_ibfk_4')->references(['id'])->on('tb_pemuput_karya');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_pemuput_karya', function (Blueprint $table) {
            $table->dropForeign('tb_pemuput_karya_ibfk_2');
            $table->dropForeign('tb_pemuput_karya_ibfk_5');
            $table->dropForeign('tb_pemuput_karya_ibfk_1');
            $table->dropForeign('tb_pemuput_karya_ibfk_4');
        });
    }
}
