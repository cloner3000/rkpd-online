<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapaianProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capaian_program', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->nullable();
            $table->string('tolak_ukur')->nullable();
            $table->bigInteger('target')->nullable();
            $table->integer('satuan_id')->unsigned();
            $table->integer('program_id')->unsigned();

            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');
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
        Schema::dropIfExists('capaian_programs');
    }
}
