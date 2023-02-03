<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trip extends Migration
{
    public function up()
    {
        Schema::create('trip',function(Blueprint $table){
            $table->increments('id');
            $table->integer('schedule_id')->unsigned();
            $table->integer('trip_no');
            $table->timestamps();

            $table->foreign('schedule_id')
            ->references('id')
            ->on('schedule')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trip');
    }
};
