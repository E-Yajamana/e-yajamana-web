<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKramaTamiuDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_krama_tamiu_desa_adat', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->unsignedInteger('banjar_adat_id')->nullable()->index('tb_krama_tamiu_desa_adat_ibfk_1');
            $table->unsignedBigInteger('penduduk_id')->nullable()->index('penduduk_id');
            $table->unsignedInteger('banjar_dinas_id')->nullable()->index('banjar_dinas_id');
            $table->char('nomor_krama_tamiu', 18)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable()->comment('Klo sudah nggak aktif, tanggal keluar nggak kosong');
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
        Schema::dropIfExists('tb_krama_tamiu_desa_adat');
    }
}
