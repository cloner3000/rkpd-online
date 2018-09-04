<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidangUrusanOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidang_urusan_opd', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bidang_urusan_id')->unsigned();
            $table->integer('opd_id')->unsigned();
            $table->foreign('bidang_urusan_id')->references('id')->on('bidang_urusan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('opd_id')->references('id')->on('opd')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('bidang_urusan_opd');
    }
}
