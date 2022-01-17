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
            $table->integer('id_upacaraku')->nullable()->index('id_upacaraku');
            $table->enum('tipe', ['sulinggih_pemangku', 'sangar'])->nullable();
            $table->enum('status', ['batal', 'sedang berlangsung', 'selesai', 'in progress'])->nullable();
            $table->date('tgl_tangkil')->nullable();
            $table->string('desc')->nullable();
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
