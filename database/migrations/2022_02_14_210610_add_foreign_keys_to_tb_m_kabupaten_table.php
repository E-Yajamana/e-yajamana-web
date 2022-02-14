<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbMKabupatenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_m_kabupaten', function (Blueprint $table) {
            $table->foreign(['provinsi_id'], 'regencies_province_id_foreign')->references(['id'])->on('tb_m_provinsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_m_kabupaten', function (Blueprint $table) {
            $table->dropForeign('regencies_province_id_foreign');
        });
    }
}
