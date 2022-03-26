<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbSuperAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_super_admin', function (Blueprint $table) {
            $table->foreign(['user_id'], 'tb_super_admin_ibfk_4')->references(['id'])->on('tb_user');
            $table->foreign(['penduduk_id'], 'tb_super_admin_ibfk_5')->references(['id'])->on('tb_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_super_admin', function (Blueprint $table) {
            $table->dropForeign('tb_super_admin_ibfk_4');
            $table->dropForeign('tb_super_admin_ibfk_5');
        });
    }
}
