<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbSulinggihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_sulinggih', function (Blueprint $table) {
            $table->foreign(['id_griya'], 'tb_sulinggih_ibfk_2')->references(['id'])->on('tb_griya_rumah');
            $table->foreign(['id_pasangan'], 'tb_sulinggih_ibfk_4')->references(['id'])->on('tb_sulinggih');
            $table->foreign(['id_user'], 'tb_sulinggih_ibfk_1')->references(['id'])->on('tb_user_eyajamana');
            $table->foreign(['id_nabe'], 'tb_sulinggih_ibfk_3')->references(['id'])->on('tb_sulinggih');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_sulinggih', function (Blueprint $table) {
            $table->dropForeign('tb_sulinggih_ibfk_2');
            $table->dropForeign('tb_sulinggih_ibfk_4');
            $table->dropForeign('tb_sulinggih_ibfk_1');
            $table->dropForeign('tb_sulinggih_ibfk_3');
        });
    }
}
