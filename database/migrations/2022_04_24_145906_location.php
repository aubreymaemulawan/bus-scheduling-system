<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Location extends Migration
{
    public function up()
    {
        Schema::create('location',function(Blueprint $table){
            $table->increments('id');
            $table->string('place')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('location');
    }
};
