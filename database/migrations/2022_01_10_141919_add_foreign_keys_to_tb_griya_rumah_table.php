<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbGriyaRumahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_griya_rumah', function (Blueprint $table) {
            $table->foreign(['id_desa_adat'], 'tb_griya_rumah_ibfk_1')->references(['id_desa_adat'])->on('tb_desa_adat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_griya_rumah', function (Blueprint $table) {
            $table->dropForeign('tb_griya_rumah_ibfk_1');
        });
    }
}
