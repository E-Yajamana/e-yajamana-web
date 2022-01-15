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
            $table->integer('id', true);
            $table->string('email', 100);
            $table->string('password');
            $table->string('nomor_telepon', 15);
            $table->string('user_profile', 200)->nullable();
            $table->enum('role', ['admin', 'sulinggih', 'sanggar', 'pemangku', 'serati', 'krama_bali']);
            $table->text('json_token_lupa_password')->nullable();
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
        Schema::dropIfExists('tb_user');
    }
}
