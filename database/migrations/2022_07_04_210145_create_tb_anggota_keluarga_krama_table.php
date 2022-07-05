<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAnggotaKeluargaKramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_anggota_keluarga_krama', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('keluarga_krama_id')->nullable()->index('keluarga_kecil_krama_id');
            $table->unsignedBigInteger('krama_id')->nullable()->index('tb_anggota_keluarga_kecil_krama_ibfk_1');
            $table->enum('status_anggota_keluarga', ['kepala_keluarga', 'suami', 'istri', 'anak', 'orang_tua'])->nullable();
            $table->unsignedBigInteger('ayah_id')->nullable()->index('ayah_id');
            $table->unsignedBigInteger('ibu_id')->nullable()->index('ibu_id');
            $table->string('nama_ayah', 100)->nullable();
            $table->string('nama_ibu', 100)->nullable();
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
        Schema::dropIfExists('tb_anggota_keluarga_krama');
    }
}
