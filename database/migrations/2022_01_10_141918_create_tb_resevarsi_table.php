<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbResevarsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_resevarsi', function (Blueprint $table) {
            $table->integer('id_resevarsi', true);
            $table->integer('id_relasi')->nullable()->index('id_relasi');
            $table->integer('id_upacaraku')->nullable()->index('id_upacaraku');
            $table->enum('tipe', ['sulinggih_pemangku', 'sangar'])->nullable();
            $table->enum('status', ['batal', 'sedang berlangsung', 'selesai', 'in progress'])->nullable();
            $table->date('tgl_tangkil')->nullable();
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
        Schema::dropIfExists('tb_resevarsi');
    }
}
