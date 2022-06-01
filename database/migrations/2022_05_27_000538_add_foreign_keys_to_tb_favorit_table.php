<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbFavoritTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_favorit', function (Blueprint $table) {
            $table->foreign(['id_user'], 'tb_favorit_ibfk_3')->references(['id'])->on('tb_user_eyajamana')->onDelete('CASCADE');
            $table->foreign(['id_sanggar'], 'tb_favorit_ibfk_2')->references(['id'])->on('tb_sanggar')->onDelete('CASCADE');
            $table->foreign(['id_pemuput_karya'], 'tb_favorit_ibfk_1')->references(['id'])->on('tb_pemuput_karya')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_favorit', function (Blueprint $table) {
            $table->dropForeign('tb_favorit_ibfk_3');
            $table->dropForeign('tb_favorit_ibfk_2');
            $table->dropForeign('tb_favorit_ibfk_1');
        });
    }
}
