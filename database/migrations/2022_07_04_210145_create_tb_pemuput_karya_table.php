<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPemuputKaryaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pemuput_karya', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->index('tb_sulinggih_ibfk_1');
            $table->integer('id_griya')->index('id_griya');
            $table->integer('id_pasangan')->nullable()->index('id_pasangan');
            $table->integer('id_atribut')->index('id_atribut');
            $table->string('nama_pemuput', 50)->nullable();
            $table->enum('status_konfirmasi_akun', ['pending', 'disetujui', 'ditolak'])->nullable();
            $table->text('keterangan_konfirmasi_akun')->nullable();
            $table->enum('tipe', ['pemangku', 'sulinggih'])->nullable();
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
        Schema::dropIfExists('tb_pemuput_karya');
    }
}
