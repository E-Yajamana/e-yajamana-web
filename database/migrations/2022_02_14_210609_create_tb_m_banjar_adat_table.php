<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMBanjarAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_m_banjar_adat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('desa_adat_id')->nullable()->index('tb_m_banjar_adat_ibfk_1');
            $table->char('kode_banjar_adat', 7)->nullable();
            $table->string('nama_banjar_adat', 100)->nullable();
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
        Schema::dropIfExists('tb_m_banjar_adat');
    }
}
