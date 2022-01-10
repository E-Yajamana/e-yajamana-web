<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahapanUpacarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tahapan_upacara', function (Blueprint $table) {
            $table->increments('id_tahapan_upacara');
            $table->integer('upacara_id')->unsigned();
            $table->foreign("upacara_id")->references("id_upacara")->on("tb_upacara")->onDelete("cascade");
            $table->string('nama_tahapan',100);
            $table->text('deskripsi_tahapan');
            $table->enum('status_tahapan',['awal','puncak','akhir']);
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
        Schema::dropIfExists('tb_tahapan_upacara');
    }
}
