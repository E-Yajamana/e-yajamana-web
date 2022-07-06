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
            $table->integer('id_relasi')->nullable()->index('id_relasi');
            $table->integer('id_sanggar')->nullable()->index('id_sanggar');
            $table->integer('id_upacaraku')->index('id_upacaraku');
            $table->enum('tipe', ['sanggar', 'pemuput_karya'])->nullable();
            $table->enum('status', ['pending', 'proses tangkil', 'proses muput', 'selesai', 'batal', 'ditolak'])->nullable();
            $table->dateTime('tanggal_tangkil')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->boolean('rating')->nullable();
            $table->text('keterangan_rating')->nullable();
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
