<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbSeratiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_serati', function (Blueprint $table) {
            $table->foreign(['id_desa_adat'], 'tb_serati_ibfk_3')->references(['desadat_id'])->on('tb_desaadat');
            $table->foreign(['id_desa'], 'tb_serati_ibfk_2')->references(['id_desa'])->on('tb_desa');
            $table->foreign(['id_user'], 'tb_serati_ibfk_1')->references(['id'])->on('tb_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_serati', function (Blueprint $table) {
            $table->dropForeign('tb_serati_ibfk_3');
            $table->dropForeign('tb_serati_ibfk_2');
            $table->dropForeign('tb_serati_ibfk_1');
        });
    }
}
