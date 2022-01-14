<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_krama', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->index('id_user');
            $table->string('nama_krama', 50);
            $table->string('alamat_krama', 50);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->decimal('lat', 20, 18);
            $table->decimal('lng', 21, 18);
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
        Schema::dropIfExists('tb_krama');
    }
}
