<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMBanjarDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_m_banjar_dinas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('desa_adat_id')->nullable()->index('desa_adat_id');
            $table->char('desa_dinas_id', 10)->nullable()->index('desa_dinas_id');
            $table->char('kode_banjar_dinas', 12)->nullable();
            $table->string('nama_banjar_dinas', 100)->nullable();
            $table->enum('jenis_banjar_dinas', ['lingkungan', 'dusun'])->nullable();
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
        Schema::dropIfExists('tb_m_banjar_dinas');
    }
}
