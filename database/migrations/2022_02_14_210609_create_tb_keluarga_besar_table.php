<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKeluargaBesarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_keluarga_besar', function (Blueprint $table) {
            $table->increments('id');
            $table->char('nomor_keluarga', 10)->nullable();
            $table->unsignedBigInteger('kepala_keluarga_besar_id')->nullable()->index('kepala_keluarga_besar_id');
            $table->unsignedInteger('banjar_adat_id')->nullable()->index('banjar_adat_id');
            $table->boolean('status')->nullable();
            $table->text('alasan_perubahan')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            // $table->softDeletes()->nullable(false)->default('0000-00-00 00:00:00');
            // $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_keluarga_besar');
    }
}
