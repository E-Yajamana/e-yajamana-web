<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbSanggarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_sanggar', function (Blueprint $table) {
            $table->foreign(['id_desa_adat'], 'tb_sanggar_ibfk_3')->references(['desadat_id'])->on('tb_desaadat');
            $table->foreign(['id_desa'], 'tb_sanggar_ibfk_2')->references(['id_desa'])->on('tb_desa');
            $table->foreign(['id_user'], 'tb_sanggar_ibfk_1')->references(['id'])->on('tb_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_sanggar', function (Blueprint $table) {
            $table->dropForeign('tb_sanggar_ibfk_3');
            $table->dropForeign('tb_sanggar_ibfk_2');
            $table->dropForeign('tb_sanggar_ibfk_1');
        });
    }
}
