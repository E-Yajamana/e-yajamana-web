<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDesaadatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_desaadat_tes', function (Blueprint $table) {
            $table->increments('desadat_id');
            $table->tinyInteger('desadat_jenis_id')->nullable()->comment('FK ke tb_master_jenis_desaadat');
            $table->string('desadat_nama', 50)->nullable();
            $table->string('desadat_kode', 20)->nullable();
            $table->double('desadat_kantor_long')->nullable();
            $table->double('desadat_kantor_lat')->nullable();
            $table->string('desadat_bendesa_nama', 50)->nullable();
            $table->string('desadat_penyarikan_nama', 50)->nullable();
            $table->string('desadat_petengen', 50)->nullable();
            $table->char('desadat_nomor_register', 30)->nullable();
            $table->string('desadat_alamat_kantor', 250)->nullable();
            $table->string('desadat_telpon_kantor', 20)->nullable();
            $table->string('desadat_fax_kantor', 20)->nullable();
            $table->string('desadat_email', 50)->nullable();
            $table->string('desadat_web', 100)->nullable();
            $table->double('desadat_luas')->nullable();
            $table->text('desadat_sejarah')->nullable();
            $table->string('desadat_file_struktur_pem', 250)->nullable();
            $table->string('desadat_hp_kontak1', 20)->nullable();
            $table->string('desadat_hp_kontak2', 20)->nullable();
            $table->string('desadat_wa_kontak_1', 20)->nullable();
            $table->string('desadat_wa_kontak_2', 20)->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->smallInteger('kabkot_id')->nullable();
            $table->string('desadat_ttd_lokasi')->nullable();
            $table->tinyInteger('desadat_punya_lpd')->nullable()->default(0)->comment('1 = punya');
            $table->tinyInteger('desadat_jum_staf')->nullable()->default(0);
            $table->tinyInteger('desadat_jum_banjar')->nullable()->default(0);
            $table->integer('desadat_jum_kk_mipil')->nullable()->default(0);
            $table->integer('desadat_jum_krama_mipil')->nullable()->default(0);
            $table->integer('desadat_jum_kk_krama_tamiu')->nullable()->default(0);
            $table->integer('desadat_jum_krama_tamiu')->nullable()->default(0);
            $table->integer('desadat_jum_kk_tamiu')->nullable()->default(0);
            $table->integer('desadat_jum_tamiu')->nullable()->default(0);
            $table->string('desadat_sebutan_pemimpin', 25)->nullable()->default('Bendesa');
            $table->boolean('desadat_status_aktif')->nullable()->default(false)->comment('1=aktif; 0 = tidak aktif');
            $table->string('password_temp')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_desaadat');
    }
}
