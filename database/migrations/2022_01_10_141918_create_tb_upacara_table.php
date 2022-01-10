<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUpacaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_upacara', function (Blueprint $table) {
            $table->integer('id_upacara', true);
            $table->string('nama_upacara')->nullable();
            $table->enum('katagori', ['Dewa Yadnya', 'Ptira Yadnya', 'Manusa Yadnya', 'Rsi Yadnya', 'Bhuta Yadnya'])->nullable();
            $table->string('desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_upacara');
    }
}
