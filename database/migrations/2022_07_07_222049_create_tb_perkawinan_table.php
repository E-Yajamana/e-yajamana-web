<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPerkawinanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_perkawinan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('purusa_id')->nullable()->index('tb_perkawinan_ibfk_1');
            $table->unsignedBigInteger('pradana_id')->nullable()->index('tb_perkawinan_ibfk_2');
            $table->unsignedBigInteger('status_approval_pihak_purusa')->nullable()->index('status_approval_pihak_purusa');
            $table->unsignedBigInteger('status_approval_pihak_pradana')->nullable()->index('status_approval_pihak_pradana');
            $table->date('tanggal_perkawinan')->nullable();
            $table->tinyInteger('status_perkawinan')->nullable();
            $table->text('lampiran')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_perkawinan');
    }
}
