<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Schedule extends Migration
{
    public function up()
    {
        Schema::create('schedule',function(Blueprint $table){
            $table->increments('id');
            $table->date('date');
            $table->integer('company_id')->unsigned();
            $table->integer('bus_id')->unsigned();
            $table->integer('operator_id')->unsigned();
            $table->integer('dispatcher_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->time('first_trip');
            $table->time('last_trip');
            $table->integer('interval_mins');
            $table->integer('max_trips');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('company_id')
            ->references('id')
            ->on('company')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('bus_id')
            ->references('id')
            ->on('bus')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('operator_id')
            ->references('id')
            ->on('operator')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('dispatcher_id')
            ->references('id')
            ->on('dispatcher')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('route_id')
            ->references('id')
            ->on('route')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule');
    }
};
