<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKeluargaKramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_keluarga_krama', function (Blueprint $table) {
            $table->increments('id');
            $table->char('nomor_keluarga', 16)->nullable();
            $table->unsignedInteger('banjar_adat_id')->nullable()->index('banjar_adat_id');
            $table->boolean('status')->nullable()->comment('0 = tidak aktif, 1 aktif');
            $table->text('alasan_perubahan')->nullable();
            $table->date('tanggal_registrasi')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_keluarga_krama');
    }
}
