<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailKeluargaBesarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_keluarga_besar', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_keluarga_besar')->nullable()->index('id_keluarga_besar');
            $table->unsignedInteger('id_keluarga_krama')->nullable()->index('tb_detail_keluarga_besar_ibfk_1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_keluarga_besar');
    }
}
