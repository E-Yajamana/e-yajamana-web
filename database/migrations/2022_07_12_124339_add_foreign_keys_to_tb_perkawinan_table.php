<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbPerkawinanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_perkawinan', function (Blueprint $table) {
            $table->foreign(['status_approval_pihak_purusa'], 'tb_perkawinan_ibfk_3')->references(['id'])->on('tb_user');
            $table->foreign(['pradana_id'], 'tb_perkawinan_ibfk_2')->references(['id'])->on('tb_penduduk');
            $table->foreign(['status_approval_pihak_pradana'], 'tb_perkawinan_ibfk_4')->references(['id'])->on('tb_user');
            $table->foreign(['purusa_id'], 'tb_perkawinan_ibfk_1')->references(['id'])->on('tb_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_perkawinan', function (Blueprint $table) {
            $table->dropForeign('tb_perkawinan_ibfk_3');
            $table->dropForeign('tb_perkawinan_ibfk_2');
            $table->dropForeign('tb_perkawinan_ibfk_4');
            $table->dropForeign('tb_perkawinan_ibfk_1');
        });
    }
}
