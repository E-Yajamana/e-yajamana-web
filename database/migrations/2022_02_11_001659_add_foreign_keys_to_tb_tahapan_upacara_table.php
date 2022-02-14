<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbTahapanUpacaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_tahapan_upacara', function (Blueprint $table) {
            $table->foreign(['id_upacara'], 'tb_tahapan_upacara_ibfk_1')->references(['id'])->on('tb_upacara')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_tahapan_upacara', function (Blueprint $table) {
            $table->dropForeign('tb_tahapan_upacara_ibfk_1');
        });
    }
}
