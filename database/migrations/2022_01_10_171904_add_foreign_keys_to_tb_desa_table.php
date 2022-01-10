<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_desa', function (Blueprint $table) {
            $table->foreign(['id_kecamatan'], 'tb_desa_ibfk_1')->references(['id_kecamatan'])->on('tb_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_desa', function (Blueprint $table) {
            $table->dropForeign('tb_desa_ibfk_1');
        });
    }
}
