<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbPerceraianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_perceraian', function (Blueprint $table) {
            $table->foreign(['perkawinan_id'], 'tb_perceraian_ibfk_1')->references(['id'])->on('tb_perkawinan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_perceraian', function (Blueprint $table) {
            $table->dropForeign('tb_perceraian_ibfk_1');
        });
    }
}
