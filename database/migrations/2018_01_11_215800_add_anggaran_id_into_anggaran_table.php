<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnggaranIdIntoAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::table('anggaran', function (Blueprint $table) {
                $table->integer('anggaran_id')->nullable();
                $table->integer('district_id')->nullable();
                $table->integer('village_id')->nullable();
            });
        } catch (Exception $e) {

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            Schema::table('anggaran', function (Blueprint $table) {
                $table->dropColumn('anggaran_id');
                $table->dropColumn('district_id');
                $table->dropColumn('village_id');
            });
        } catch (Exception $e) {

        }
    }
}
