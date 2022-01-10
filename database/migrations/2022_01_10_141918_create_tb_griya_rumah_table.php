<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbGriyaRumahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_griya_rumah', function (Blueprint $table) {
            $table->integer('id_griya', true);
            $table->integer('id_desa_adat')->nullable()->index('id_desa_adat');
            $table->string('nama_griya_rumah', 100)->nullable();
            $table->string('alamat_griya_rumah', 100)->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_griya_rumah');
    }
}
