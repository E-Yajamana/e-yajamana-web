<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTahapanUpacaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tahapan_upacara', function (Blueprint $table) {
            $table->integer('id_tahapan_upacara', true);
            $table->integer('id_upacara')->nullable()->index('id_upacara');
            $table->string('nama_tahapan')->nullable();
            $table->string('desc_tahapan')->nullable();
            $table->enum('status_upacara', ['awal', 'puncak', 'akhir'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tahapan_upacara');
    }
}
