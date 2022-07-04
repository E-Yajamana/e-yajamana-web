<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUserEyajamanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user_eyajamana', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('id_penduduk')->nullable()->index('id_penduduk');
            $table->string('email', 100)->unique('email');
            $table->string('password', 255);
            $table->string('nomor_telepon', 15);
            $table->string('user_profile', 200)->nullable();
            $table->text('json_token_lupa_password')->nullable();
            $table->text('fcm_token_key')->nullable();
            $table->text('fcm_token_web')->nullable();
            $table->decimal('lat', 20, 18)->nullable()->default(-8.578768);
            $table->decimal('lng', 21, 18)->nullable()->default(115.213947);
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
        Schema::dropIfExists('tb_user_eyajamana');
    }
}
