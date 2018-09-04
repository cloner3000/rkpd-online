<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('kode');
            $table->string('nama')->unique();
            $table->string('deskripsi')->nullable();
            $table->string('keyword')->nullable();
            $table->integer('program_id')->unsigned();
            $table->integer('indikator_sasaran_id')->unsigned();

            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('indikator_sasaran_id')->references('id')->on('indikator_sasaran')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('kegiatan');
    }
}
