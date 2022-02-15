<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAdminDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admin_desa_adat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('desa_adat_id')->nullable()->index('desa_adat_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
            $table->enum('status', ['aktif', 'tidak_aktif'])->nullable()->default('aktif');
            $table->timestamps();
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
        Schema::dropIfExists('tb_admin_desa_adat');
    }
}
