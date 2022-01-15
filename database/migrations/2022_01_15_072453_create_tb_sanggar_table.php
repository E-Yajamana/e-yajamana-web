<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSanggarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sanggar', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->index('id_user');
            $table->char('id_desa', 10)->index('id_desa');
            $table->unsignedInteger('id_desa_adat')->index('id_desa_adat');
            $table->string('nama_sanggar', 100)->nullable();
            $table->string('nama_pengelola', 100)->nullable();
            $table->string('alamat_sanggar')->nullable();
            $table->string('sk_tanda_usaha')->nullable();
            $table->enum('status_konfirmasi', ['pending', 'disetujui', 'ditolak'])->nullable();
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
        Schema::dropIfExists('tb_sanggar');
    }
}
