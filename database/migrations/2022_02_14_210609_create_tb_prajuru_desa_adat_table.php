<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPrajuruDesaAdatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_prajuru_desa_adat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
            $table->unsignedInteger('desa_adat_id')->nullable()->index('desa_adat_id');
            $table->unsignedBigInteger('krama_mipil_id')->nullable()->index('krama_mipil_id');
            $table->enum('jabatan', ['bendesa', 'pangliman', 'penyarikan', 'patengen'])->nullable();
            $table->boolean('status_prajuru_desa_adat')->nullable();
            $table->year('tahun_mulai_menjabat')->nullable();
            $table->year('tahun_akhir_menjabat')->nullable();
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
        Schema::dropIfExists('tb_prajuru_desa_adat');
    }
}
