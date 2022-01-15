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
            $table->integer('id', true);
            $table->string('nama_upacara', 100)->nullable();
            $table->enum('katagori_upacara', ['Dewa Yadnya', 'Pitra Yadnya', 'Manusa Yadnya', 'Rsi Yadnya', 'Bhuta Yadnya'])->nullable();
            $table->text('deskripsi_upacara')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('tb_upacara');
    }
}
