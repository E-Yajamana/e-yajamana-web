<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_desa_adat', function (Blueprint $table) {
            $table->foreign(['id_desa'], 'tb_desa_adat_ibfk_1')->references(['id_desa'])->on('tb_desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_desa_adat', function (Blueprint $table) {
            $table->dropForeign('tb_desa_adat_ibfk_1');
        });
    }
}
