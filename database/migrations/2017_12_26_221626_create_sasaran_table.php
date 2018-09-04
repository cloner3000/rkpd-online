<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSasaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sasaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->timestamps();
            $table->integer('tujuan_id')->unsigned();
            $table->foreign('tujuan_id')->references('id')->on('tujuan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sasaran');
    }
}
