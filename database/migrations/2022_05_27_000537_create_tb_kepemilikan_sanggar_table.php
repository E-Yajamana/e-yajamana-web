<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKepemilikanSanggarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kepemilikan_sanggar', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_sanggar')->index('id_sanggar');
            $table->integer('id_user')->index('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kepemilikan_sanggar');
    }
}
