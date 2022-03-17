<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUpacarakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_upacaraku', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('id_banjar_dinas')->nullable()->index('id_banjar_dinas');
            $table->integer('id_upacara')->index('id_upacara');
            $table->integer('id_krama')->index('id_krama');
            $table->string('nama_upacara', 255)->nullable();
            $table->string('alamat_upacaraku', 255)->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('deskripsi_upacaraku')->nullable();
            $table->enum('status', ['pending', 'berlangsung', 'selesai', 'batal'])->nullable();
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
        Schema::dropIfExists('tb_upacaraku');
    }
}
