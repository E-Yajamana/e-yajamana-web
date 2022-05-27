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
            $table->integer('id', true);
            $table->unsignedInteger('id_banjar_dinas')->nullable()->index('id_banjar_dinas');
            $table->string('nama_griya_rumah', 100)->nullable();
            $table->string('alamat_griya_rumah', 100)->nullable();
            $table->decimal('lat', 20, 18)->nullable();
            $table->decimal('lng', 21, 18)->nullable();
            $table->timestamps();
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
