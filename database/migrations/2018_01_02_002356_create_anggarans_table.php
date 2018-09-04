<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggaran', function (Blueprint $table) {
            $table->increments('id');
            $table->year('tahun');
            $table->integer('opd_id')->unsigned();
            $table->integer('opd_pelaksana_id')->unsigned();
            $table->integer('tahapan_id')->unsigned();
            $table->integer('kegiatan_id')->unsigned();
            $table->integer('status_kegiatan_id')->unsigned();
            $table->integer('target_hk')->nullable();
            $table->integer('sumber_anggaran_id')->unsigned();
            $table->integer('jenis_lokasi_id')->unsigned();
            $table->string('lokasi')->nullable();
            $table->string('file_kak')->nullable();
            $table->string('file_foto')->nullable();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('is_transfer')->default(false);
            $table->tinyInteger('is_verifikasi')->default(false);

            $table->foreign('opd_id')->references('id')->on('opd')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('opd_pelaksana_id')->references('id')->on('opd')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tahapan_id')->references('id')->on('tahapan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_kegiatan_id')->references('id')->on('status_kegiatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sumber_anggaran_id')->references('id')->on('sumber_anggaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jenis_lokasi_id')->references('id')->on('jenis_lokasi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('anggarans');
    }
}
