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
            $table->foreign(['id_user'], 'tb_sulinggih_ibfk_1')->references(['id'])->on('tb_user');
            $table->foreign(['nabe'], 'tb_sulinggih_ibfk_3')->references(['id_sulinggih'])->on('tb_sulinggih');
            $table->foreign(['id_griya'], 'tb_sulinggih_ibfk_2')->references(['id_griya'])->on('tb_griya_rumah');
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
            $table->dropForeign('tb_sulinggih_ibfk_1');
            $table->dropForeign('tb_sulinggih_ibfk_3');
            $table->dropForeign('tb_sulinggih_ibfk_2');
        });
    }
}
