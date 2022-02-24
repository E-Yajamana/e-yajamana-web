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
            $table->integer('id_pasangan')->nullable()->index('id_pasangan');
            $table->integer('id_nabe')->nullable()->index('nabe');
            $table->string('nama_walaka', 100)->nullable();
            $table->string('nama_sulinggih', 100)->nullable();
            $table->string('nama_pasangan', 100)->nullable();
            $table->string('nama_nabe', 100)->nullable();
            $table->date('tanggal_diksha')->nullable();
            $table->enum('status', ['sulinggih', 'pemangku'])->nullable();
            $table->string('sk_kesulinggihan', 255)->nullable();
            $table->enum('status_konfirmasi_akun', ['pending', 'disetujui', 'ditolak'])->nullable();
            $table->text('keterangan_konfirmasi_akun')->nullable();
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
