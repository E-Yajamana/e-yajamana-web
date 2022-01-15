<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSeratiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_serati', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->index('id_user');
            $table->char('id_desa', 10)->index('id_desa');
            $table->unsignedInteger('id_desa_adat')->index('id_desa_adat');
            $table->string('nama_serati', 50)->nullable();
            $table->string('tempat_lahir', 150)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('alamat_serati', 100)->nullable();
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
        Schema::dropIfExists('tb_serati');
    }
}
