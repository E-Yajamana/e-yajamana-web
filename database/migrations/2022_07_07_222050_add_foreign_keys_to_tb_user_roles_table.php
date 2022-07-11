<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_user_roles', function (Blueprint $table) {
            $table->foreign(['id_user'], 'tb_user_roles_ibfk_1')->references(['id'])->on('tb_user_eyajamana');
            $table->foreign(['id_role'], 'tb_user_roles_ibfk_2')->references(['id'])->on('tb_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_user_roles', function (Blueprint $table) {
            $table->dropForeign('tb_user_roles_ibfk_1');
            $table->dropForeign('tb_user_roles_ibfk_2');
        });
    }
}
