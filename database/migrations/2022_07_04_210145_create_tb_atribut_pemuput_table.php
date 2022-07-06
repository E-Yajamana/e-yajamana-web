<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAtributPemuputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_atribut_pemuput', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_nabe')->nullable()->index('id_nabe');
            $table->string('sk_pemuput', 100)->nullable();
            $table->date('tanggal_diksha')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_atribut_pemuput');
    }
}
