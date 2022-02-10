<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbKeteranganKonfirmasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_keterangan_konfirmasi', function (Blueprint $table) {
            $table->foreign(['id_sulinggih'], 'tb_keterangan_konfirmasi_ibfk_1')->references(['id'])->on('tb_sulinggih');
            $table->foreign(['id_detail_reservasi'], 'tb_keterangan_konfirmasi_ibfk_2')->references(['id'])->on('tb_detail_reservasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_keterangan_konfirmasi', function (Blueprint $table) {
            $table->dropForeign('tb_keterangan_konfirmasi_ibfk_1');
            $table->dropForeign('tb_keterangan_konfirmasi_ibfk_2');
        });
    }
}
