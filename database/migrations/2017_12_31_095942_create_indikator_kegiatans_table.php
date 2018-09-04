<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndikatorKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('kode');
            $table->string('tolak_ukur');
            $table->integer('indikator_hasil_id')->unsigned();
            $table->integer('satuan_id')->unsigned();
            $table->integer('kegiatan_id')->unsigned();
            $table->foreign('indikator_hasil_id')->references('id')->on('indikator_hasil')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('indikator_kegiatans');
    }
}
