<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbMDesaDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_m_desa_dinas', function (Blueprint $table) {
            $table->foreign(['kecamatan_id'], 'villages_district_id_foreign')->references(['id'])->on('tb_m_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_m_desa_dinas', function (Blueprint $table) {
            $table->dropForeign('villages_district_id_foreign');
        });
    }
}
