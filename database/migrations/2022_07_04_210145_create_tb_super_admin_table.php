<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSuperAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_super_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('penduduk_id')->nullable()->index('penduduk_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
            $table->enum('status', ['aktif', 'tidak_aktif'])->nullable();
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
        Schema::dropIfExists('tb_super_admin');
    }
}
