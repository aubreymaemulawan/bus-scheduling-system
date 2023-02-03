<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusTrip extends Migration
{
    public function up()
    {
        Schema::create('status_trip',function(Blueprint $table){
            $table->increments('id');
            $table->integer('status_id')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->integer('trip_duration');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('status_id')
            ->references('id')
            ->on('status')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('trip_id')
            ->references('id')
            ->on('trip')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_trip');
    }
};
