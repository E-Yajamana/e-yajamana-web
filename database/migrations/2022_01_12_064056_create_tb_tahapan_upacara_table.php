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
            $table->integer('id', true);
            $table->integer('id_upacara')->index('tb_tahapan_upacara_ibfk_1');
            $table->string('nama_tahapan', 100);
            $table->text('deskripsi_tahapan');
            $table->enum('status_tahapan', ['awal', 'puncak', 'akhir']);
            $table->string('image', 100)->nullable();
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
        Schema::dropIfExists('tb_tahapan_upacara');
    }
}
