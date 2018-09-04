<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_anggaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anggaran_id')->unsigned();
            $table->integer('indikator_kegiatan_id')->unsigned();
            $table->bigInteger('target')->default(0);

            $table->foreign('anggaran_id')->references('id')->on('anggaran')->onDelete('cascade');
            $table->foreign('indikator_kegiatan_id')->references('id')->on('indikator_kegiatan')->onDelete('cascade');
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
        Schema::dropIfExists('target_anggaran');
    }
}
