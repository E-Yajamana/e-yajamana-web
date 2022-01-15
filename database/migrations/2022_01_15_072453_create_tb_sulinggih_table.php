<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSulinggihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sulinggih', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_griya')->index('id_griya');
            $table->integer('id_user')->index('tb_sulinggih_ibfk_1');
            $table->integer('nabe')->nullable()->index('nabe');
            $table->string('nama_walaka', 100)->nullable();
            $table->string('nama_sulinggih', 100)->nullable();
            $table->string('nama_pasangan', 100)->nullable();
            $table->string('tempat_lahir', 150)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->enum('pendidikan', ['SD', 'SMP', 'SMA/SMK', 'SARJANA', 'MAGISTER', 'Doktor'])->nullable();
            $table->date('tanggal_diksha')->nullable();
            $table->string('sk_kesulinggihan')->nullable();
            $table->enum('status_konfirmasi_akun', ['pending', 'disetujui', 'ditolak'])->nullable();
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
        Schema::dropIfExists('tb_sulinggih');
    }
}
