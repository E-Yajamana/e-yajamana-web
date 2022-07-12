<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbMKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_m_kecamatan', function (Blueprint $table) {
            $table->foreign(['kabupaten_id'], 'districts_regency_id_foreign')->references(['id'])->on('tb_m_kabupaten');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_m_kecamatan', function (Blueprint $table) {
            $table->dropForeign('districts_regency_id_foreign');
        });
    }
}
