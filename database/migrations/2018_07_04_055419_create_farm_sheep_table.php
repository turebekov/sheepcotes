<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmSheepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_sheep', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('count');
            $table->integer('day');
            $table->unsignedInteger('farm_id');
            $table->timestamps();

            $table->foreign('farm_id')->references('id')->on('farms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_sheep');
    }
}
