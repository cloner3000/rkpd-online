<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidangUrusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidang_urusan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', '2')->nullable();
            $table->string('nama')->nullable();
            $table->timestamps();
            $table->integer('urusan_id')->unsigned()->nullable();
            $table->foreign('urusan_id')->references('id')->on('urusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bidang_urusan');
    }
}
