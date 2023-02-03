<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Status extends Migration
{
    public function up()
    {
        Schema::create('status',function(Blueprint $table){
            $table->increments('id');
            $table->integer('busstatus_id')->unsigned();
            $table->string('current_location');
            $table->timestamps();

            $table->foreign('busstatus_id')
            ->references('id')
            ->on('busstatus')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('status');
    }
};
