<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKeteranganKonfirmasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_keterangan_konfirmasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_sulinggih')->index('id_sulinggih');
            $table->integer('id_detail_reservasi')->index('id_detail_reservasi');
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
        Schema::dropIfExists('tb_keterangan_konfirmasi');
    }
}
