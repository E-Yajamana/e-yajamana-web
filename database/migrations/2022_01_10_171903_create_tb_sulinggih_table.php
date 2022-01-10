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
            $table->integer('id_sulinggih', true);
            $table->integer('id_griya')->nullable()->index('id_griya');
            $table->integer('id_user')->nullable()->index('tb_sulinggih_ibfk_1');
            $table->integer('nabe')->nullable()->index('nabe');
            $table->string('nama_walaka', 100)->nullable();
            $table->string('nama_sulinggih', 100)->nullable();
            $table->date('tgl_diksha')->nullable();
            $table->enum('status_konfirmasi_akun', ['terkonfirmasi', 'reject'])->nullable();
            $table->string('sk_kesulinggihan')->nullable();
            $table->string('image')->nullable();
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
