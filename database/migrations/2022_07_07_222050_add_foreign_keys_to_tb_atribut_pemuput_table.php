<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbAtributPemuputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_atribut_pemuput', function (Blueprint $table) {
            $table->foreign(['id_nabe'], 'tb_atribut_pemuput_ibfk_1')->references(['id'])->on('tb_pemuput_karya');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_atribut_pemuput', function (Blueprint $table) {
            $table->dropForeign('tb_atribut_pemuput_ibfk_1');
        });
    }
}
