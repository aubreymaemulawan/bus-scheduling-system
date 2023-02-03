<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Routes extends Migration
{
    public function up()
    {
        Schema::create('route',function(Blueprint $table){
            $table->increments('id');
            $table->string('from_to_location')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('route');
    }
};
