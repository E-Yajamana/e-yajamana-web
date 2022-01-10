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
            $table->foreign(['id_resevarsi'], 'tb_gambar_ibfk_1')->references(['id_resevarsi'])->on('tb_resevarsi');
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
            $table->dropForeign('tb_gambar_ibfk_1');
        });
    }
}
