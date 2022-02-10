<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMDesaDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_m_desa_dinas', function (Blueprint $table) {
            $table->char('id', 10)->primary();
            $table->char('kecamatan_id', 7)->index('villages_district_id_index');
            $table->string('name', 255);
            $table->timestamps();
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
        Schema::dropIfExists('tb_m_desa_dinas');
    }
}
