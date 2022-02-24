<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMaperasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_maperas', function (Blueprint $table) {
            $table->unsignedInteger('id')->nullable();
            $table->unsignedInteger('keluarga_lama_id')->nullable()->index('keluarga_lama_id');
            $table->unsignedInteger('keluarga_baru_id')->nullable()->index('keluarga_baru_id');
            $table->unsignedBigInteger('penduduk_id')->nullable()->index('penduduk_id');
            $table->date('tanggal')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_maperas');
    }
}
