<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbWnaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_wna', function (Blueprint $table) {
            $table->foreign(['negara_id'], 'tb_wna_ibfk_1')->references(['id'])->on('tb_m_negara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_wna', function (Blueprint $table) {
            $table->dropForeign('tb_wna_ibfk_1');
        });
    }
}
