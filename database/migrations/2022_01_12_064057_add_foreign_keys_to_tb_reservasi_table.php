<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_reservasi', function (Blueprint $table) {
            $table->foreign(['id_upacaraku'], 'tb_reservasi_ibfk_7')->references(['id'])->on('tb_upacaraku');
            $table->foreign(['id_relasi'], 'tb_reservasi_ibfk_6')->references(['id'])->on('tb_sulinggih');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_reservasi', function (Blueprint $table) {
            $table->dropForeign('tb_reservasi_ibfk_7');
            $table->dropForeign('tb_reservasi_ibfk_6');
        });
    }
}
