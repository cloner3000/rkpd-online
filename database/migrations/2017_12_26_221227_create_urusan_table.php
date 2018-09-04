<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urusan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', '2')->nullable();
            $table->string('nama')->nullable();
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
        Schema::dropIfExists('urusan');
    }
}
