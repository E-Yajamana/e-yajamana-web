<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbResevarsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_resevarsi', function (Blueprint $table) {
            $table->foreign(['id_relasi'], 'tb_resevarsi_ibfk_6')->references(['id_sulinggih'])->on('tb_sulinggih');
            $table->foreign(['id_upacaraku'], 'tb_resevarsi_ibfk_7')->references(['id_upacaraku'])->on('tb_upacaraku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_resevarsi', function (Blueprint $table) {
            $table->dropForeign('tb_resevarsi_ibfk_6');
            $table->dropForeign('tb_resevarsi_ibfk_7');
        });
    }
}
