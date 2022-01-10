<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpacarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_upacara', function (Blueprint $table) {
            $table->increments('id_upacara')->unsigned();
            $table->string('nama_upacara',100);
            $table->enum('katagori_upacara',['admin','sulinggih','sanggar','pemangku','serati','krama_bali']);
            $table->text('deskripsi_upacara');
            $table->string('image',100);
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
