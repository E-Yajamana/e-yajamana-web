<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbDetailKeluargaBesarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_detail_keluarga_besar', function (Blueprint $table) {
            $table->foreign(['id_keluarga_krama'], 'tb_detail_keluarga_besar_ibfk_1')->references(['id'])->on('tb_keluarga_krama');
            $table->foreign(['id_keluarga_besar'], 'tb_detail_keluarga_besar_ibfk_2')->references(['id'])->on('tb_keluarga_besar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_detail_keluarga_besar', function (Blueprint $table) {
            $table->dropForeign('tb_detail_keluarga_besar_ibfk_1');
            $table->dropForeign('tb_detail_keluarga_besar_ibfk_2');
        });
    }
}
