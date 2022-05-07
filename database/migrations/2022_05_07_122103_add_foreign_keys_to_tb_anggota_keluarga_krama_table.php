<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbAnggotaKeluargaKramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_anggota_keluarga_krama', function (Blueprint $table) {
            $table->foreign(['ibu_id'], 'tb_anggota_keluarga_krama_ibfk_4')->references(['id'])->on('tb_krama_mipil_desa_adat');
            $table->foreign(['krama_id'], 'tb_anggota_keluarga_krama_ibfk_1')->references(['id'])->on('tb_krama_mipil_desa_adat');
            $table->foreign(['ayah_id'], 'tb_anggota_keluarga_krama_ibfk_3')->references(['id'])->on('tb_krama_mipil_desa_adat');
            $table->foreign(['keluarga_krama_id'], 'tb_anggota_keluarga_krama_ibfk_2')->references(['id'])->on('tb_keluarga_krama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_anggota_keluarga_krama', function (Blueprint $table) {
            $table->dropForeign('tb_anggota_keluarga_krama_ibfk_4');
            $table->dropForeign('tb_anggota_keluarga_krama_ibfk_1');
            $table->dropForeign('tb_anggota_keluarga_krama_ibfk_3');
            $table->dropForeign('tb_anggota_keluarga_krama_ibfk_2');
        });
    }
}
