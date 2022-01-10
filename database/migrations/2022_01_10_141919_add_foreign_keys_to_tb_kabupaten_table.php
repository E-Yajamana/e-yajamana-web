<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKabupatenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_kabupaten', function (Blueprint $table) {
            $table->foreign(['id_provinsi'], 'tb_kabupaten_ibfk_1')->references(['id_provinsi'])->on('tb_provinsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_kabupaten', function (Blueprint $table) {
            $table->dropForeign('tb_kabupaten_ibfk_1');
        });
    }
}
