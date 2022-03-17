<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbGambarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_gambar', function (Blueprint $table) {
            $table->foreign(['id_detail_reservarsi'], 'tb_gambar_ibfk_2')->references(['id'])->on('tb_detail_reservasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_gambar', function (Blueprint $table) {
            $table->dropForeign('tb_gambar_ibfk_2');
        });
    }
}
