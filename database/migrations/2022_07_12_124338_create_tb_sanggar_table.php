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
            $table->unsignedInteger('id_banjar_dinas')->nullable()->index('id_banjar_dinas');
            $table->string('nama_sanggar', 100)->nullable();
            $table->text('alamat_sanggar')->nullable();
            $table->string('sk_tanda_usaha', 255)->nullable();
            $table->string('profile', 255)->nullable();
            $table->decimal('lat', 20, 18)->nullable();
            $table->decimal('lng', 21, 18)->nullable();
            $table->enum('status_konfirmasi_akun', ['pending', 'disetujui', 'ditolak'])->nullable();
            $table->text('keterangan_konfirmasi_akun')->nullable();
            $table->timestamps();
            $table->float('rating', 5, 1)->nullable();
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