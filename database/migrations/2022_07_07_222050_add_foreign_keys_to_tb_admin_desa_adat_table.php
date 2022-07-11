<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbAdminDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_admin_desa_adat', function (Blueprint $table) {
            $table->foreign(['desa_adat_id'], 'tb_admin_desa_adat_ibfk_1')->references(['id'])->on('tb_m_desa_adat');
            $table->foreign(['user_id'], 'tb_admin_desa_adat_ibfk_2')->references(['id'])->on('tb_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_admin_desa_adat', function (Blueprint $table) {
            $table->dropForeign('tb_admin_desa_adat_ibfk_1');
            $table->dropForeign('tb_admin_desa_adat_ibfk_2');
        });
    }
}
