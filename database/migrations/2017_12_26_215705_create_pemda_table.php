<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemda', function (Blueprint $table) {
            $table->increments('id');
            $table->year('tahun')->nullable();
            $table->string('nama')->nullable();
            $table->string('ibu_kota')->nullable();
            $table->string('alamat')->nullable();
            $table->string('logo')->nullable();
            $table->string('nama_kepala_daerah')->nullable();
            $table->string('jabatan_kepala_daerah')->nullable();
            $table->string('nama_sekda')->nullable();
            $table->char('nip_sekda', 20)->nullable();
            $table->string('jabatan_sekda')->nullable();
            $table->timestamps();
            $table->integer('visi_id')->unsigned();
            $table->foreign('visi_id')->references('id')->on('visi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemda');
    }
}
