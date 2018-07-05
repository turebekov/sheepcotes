<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheepTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheep_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('count');
            $table->integer('day');
            $table->unsignedInteger('from_farm_id')->nullable();
            $table->unsignedInteger('to_farm_id')->nullable();
            $table->timestamps();

            $table->foreign('from_farm_id')->references('id')->on('farms');
            $table->foreign('to_farm_id')->references('id')->on('farms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheep_transfers');
    }
}
