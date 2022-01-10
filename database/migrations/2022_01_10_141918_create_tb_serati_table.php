<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSeratiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_serati', function (Blueprint $table) {
            $table->integer('id_serati', true);
            $table->integer('id_user')->nullable()->index('id_user');
            $table->string('nama_serati', 50)->nullable();
            $table->string('alamat_serati', 100)->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_serati');
    }
}
