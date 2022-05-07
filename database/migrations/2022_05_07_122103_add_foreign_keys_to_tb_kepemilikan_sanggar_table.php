<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKepemilikanSanggarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_kepemilikan_sanggar', function (Blueprint $table) {
            $table->foreign(['id_user'], 'tb_kepemilikan_sanggar_ibfk_1')->references(['id'])->on('tb_user_eyajamana');
            $table->foreign(['id_sanggar'], 'tb_kepemilikan_sanggar_ibfk_2')->references(['id'])->on('tb_sanggar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_kepemilikan_sanggar', function (Blueprint $table) {
            $table->dropForeign('tb_kepemilikan_sanggar_ibfk_1');
            $table->dropForeign('tb_kepemilikan_sanggar_ibfk_2');
        });
    }
}
