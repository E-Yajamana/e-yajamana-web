<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_reservasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_reservasi')->index('id_resevarsi');
            $table->integer('id_tahapan_upacara')->index('id_tahapan_upacara');
            $table->dateTime('tanggal_mulai')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->enum('status', ['diterima', 'ditolak', 'pending', 'selesai', 'batal'])->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('tb_detail_reservasi');
    }
}
