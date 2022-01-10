<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbDetailResevarsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_detail_resevarsi', function (Blueprint $table) {
            $table->foreign(['id_resevarsi'], 'tb_detail_resevarsi_ibfk_3')->references(['id_resevarsi'])->on('tb_resevarsi');
            $table->foreign(['id_tahapan_upacara'], 'tb_detail_resevarsi_ibfk_5')->references(['id_tahapan_upacara'])->on('tb_tahapan_upacara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_detail_resevarsi', function (Blueprint $table) {
            $table->dropForeign('tb_detail_resevarsi_ibfk_3');
            $table->dropForeign('tb_detail_resevarsi_ibfk_5');
        });
    }
}
