<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSanggarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sanggar', function (Blueprint $table) {
            $table->integer('id_sanggar', true);
            $table->integer('id_user')->nullable()->index('id_user');
            $table->string('nama_sanggar', 100)->nullable();
            $table->string('alamat_sanggar')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('tb_sanggar');
    }
}
