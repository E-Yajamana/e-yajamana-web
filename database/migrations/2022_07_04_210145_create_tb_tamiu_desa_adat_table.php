<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTamiuDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tamiu_desa_adat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('banjar_adat_id')->nullable();
            $table->integer('banjar_dinas_id')->nullable();
            $table->char('nomor_tamiu', 18)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->unsignedBigInteger('penduduk_id')->nullable()->index('penduduk_id');
            $table->unsignedBigInteger('wna_id')->nullable()->index('wna_id');
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
        Schema::dropIfExists('tb_tamiu_desa_adat');
    }
}
