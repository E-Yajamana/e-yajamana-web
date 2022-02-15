<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penduduk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('desa_id', 10)->nullable()->index('desa_id');
            $table->char('nomor_induk_krama', 16)->nullable();
            $table->unsignedTinyInteger('profesi_id')->nullable()->index('profesi_id');
            $table->unsignedTinyInteger('pendidikan_id')->nullable()->index('pendidikan_id');
            $table->enum('agama', ['islam', 'protestan', 'katolik', 'hindu', 'buddha', 'khonghucu'])->nullable()->index('agama_id');
            $table->char('nik', 16)->nullable();
            $table->string('gelar_depan', 50)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('gelar_belakang', 50)->nullable();
            $table->string('nama_alias', 50)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->nullable();
            $table->string('alamat', 255)->nullable();
            $table->date('tanggal_kematian')->nullable();
            $table->boolean('status_perkawinan')->nullable()->comment('0 = tidak nikah, 1 nikah');
            $table->text('foto')->nullable();
            $table->unsignedBigInteger('ayah_kandung_id')->nullable()->index('ayah_id');
            $table->unsignedBigInteger('ibu_kandung_id')->nullable()->index('ibu_id');
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
        Schema::dropIfExists('tb_penduduk');
    }
}
