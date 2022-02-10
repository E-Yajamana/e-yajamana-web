<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('role', ['super_admin', 'bendesa', 'krama', 'penyarikan', 'patengen', 'admin_desa_adat', 'pangliman', 'kelihan_adat', 'pangliman_banjar', 'penyarikan_banjar', 'patengen_banjar'])->nullable()->index('role_id');
            $table->string('email', 50)->nullable();
            $table->string('password', 255)->nullable();
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
        Schema::dropIfExists('tb_user');
    }
}
