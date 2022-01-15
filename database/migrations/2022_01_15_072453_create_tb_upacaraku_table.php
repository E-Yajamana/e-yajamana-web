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
            $table->integer('id_upacara')->index('id_upacara');
            $table->integer('id_krama')->index('id_krama');
            $table->string('nama_upacara')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('desc')->nullable();
            $table->enum('status', ['pending', 'proses tangkil', 'proses muput', 'selesai', 'batal'])->nullable();
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
