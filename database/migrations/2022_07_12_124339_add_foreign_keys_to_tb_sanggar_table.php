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
            $table->foreign(['id_banjar_dinas'], 'tb_sanggar_ibfk_1')->references(['id'])->on('tb_m_banjar_dinas');
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
            $table->dropForeign('tb_sanggar_ibfk_1');
        });
    }
}
