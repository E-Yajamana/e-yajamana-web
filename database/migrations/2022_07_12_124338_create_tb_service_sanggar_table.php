<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbServiceSanggarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_service_sanggar', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_sanggar')->nullable()->index('id_sanggar');
            $table->integer('id_service')->nullable()->index('id_service');
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
        Schema::dropIfExists('tb_service_sanggar');
    }
}
