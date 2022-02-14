<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbDetailReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_detail_reservasi', function (Blueprint $table) {
            $table->foreign(['id_reservasi'], 'tb_detail_reservasi_ibfk_1')->references(['id'])->on('tb_reservasi')->onDelete("cascade");
            $table->foreign(['id_tahapan_upacara'], 'tb_detail_reservasi_ibfk_2')->references(['id'])->on('tb_tahapan_upacara')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_detail_reservasi', function (Blueprint $table) {
            $table->dropForeign('tb_detail_reservasi_ibfk_1');
            $table->dropForeign('tb_detail_reservasi_ibfk_2');
        });
    }
}
