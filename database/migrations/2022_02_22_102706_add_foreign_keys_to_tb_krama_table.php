<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_krama', function (Blueprint $table) {
            $table->foreign(['id_user'], 'tb_krama_ibfk_1')->references(['id'])->on('tb_user_eyajamana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_krama', function (Blueprint $table) {
            $table->dropForeign('tb_krama_ibfk_1');
        });
    }
}
