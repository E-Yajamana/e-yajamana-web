<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbServiceSanggarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_service_sanggar', function (Blueprint $table) {
            $table->foreign(['id_service'], 'tb_service_sanggar_ibfk_2')->references(['id'])->on('tb_service');
            $table->foreign(['id_sanggar'], 'tb_service_sanggar_ibfk_1')->references(['id'])->on('tb_sanggar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_service_sanggar', function (Blueprint $table) {
            $table->dropForeign('tb_service_sanggar_ibfk_2');
            $table->dropForeign('tb_service_sanggar_ibfk_1');
        });
    }
}
