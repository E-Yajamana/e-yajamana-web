<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_reservasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_relasi')->index('id_relasi');
            $table->integer('id_upacaraku')->index('id_upacaraku');
            $table->enum('status', ['pending', 'proses tangkil', 'proses muput', 'selesai', 'batal'])->nullable();
            $table->dateTime('tanggal_tangkil')->nullable();
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
        Schema::dropIfExists('tb_reservasi');
    }
}
