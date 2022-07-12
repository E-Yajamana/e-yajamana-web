<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFavoritTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_favorit', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_pemuput_karya')->nullable()->index('id_pemuput_karya');
            $table->integer('id_sanggar')->nullable()->index('id_sanggar');
            $table->integer('id_user')->nullable()->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_favorit');
    }
}
