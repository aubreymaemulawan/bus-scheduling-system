<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Buses extends Migration
{
    public function up()
    {
        Schema::create('bus',function(Blueprint $table){
            $table->increments('id');
            $table->integer('bus_no')->unique();
            $table->integer('company_id')->unsigned();
            $table->integer('bustype_id');
            $table->string('plate_no')->unique();
            $table->string('chassis_no')->unique();
            $table->string('engine_no')->unique();
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('company_id')
            ->references('id')
            ->on('company')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }
        
    public function down()
    {
        Schema::dropIfExists('bus');
    }
};
