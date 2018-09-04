<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpdKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id')->unsigned();
            $table->integer('kegiatan_id')->unsigned();

            $table->foreign('opd_id')->references('id')->on('opd')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade')->onUpdate('cascade');;
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
        Schema::dropIfExists('opd_kegiatan');
    }
}
