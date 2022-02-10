<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbUserEyajamanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_user_eyajamana', function (Blueprint $table) {
            $table->foreign(['id_penduduk'], 'tb_user_eyajamana_ibfk_1')->references(['id'])->on('tb_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_user_eyajamana', function (Blueprint $table) {
            $table->dropForeign('tb_user_eyajamana_ibfk_1');
        });
    }
}
