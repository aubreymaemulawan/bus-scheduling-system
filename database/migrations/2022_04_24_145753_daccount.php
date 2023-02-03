<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Daccount extends Migration
{
    public function up()
    {
        Schema::create('daccount',function(Blueprint $table){
            $table->increments('id');
            $table->integer('dispatcher_id')->unsigned()->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();

            $table->foreign('dispatcher_id')
            ->references('id')
            ->on('dispatcher')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daccount');
    }
};
