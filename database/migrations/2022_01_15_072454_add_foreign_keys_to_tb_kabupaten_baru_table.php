<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKabupatenBaruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_kabupaten_baru', function (Blueprint $table) {
            $table->foreign(['id_provinsi'], 'tb_kabupaten_baru_ibfk_1')->references(['id_provinsi'])->on('tb_provinsi_baru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_kabupaten_baru', function (Blueprint $table) {
            $table->dropForeign('tb_kabupaten_baru_ibfk_1');
        });
    }
}
