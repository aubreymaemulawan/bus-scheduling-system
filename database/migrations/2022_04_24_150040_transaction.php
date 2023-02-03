<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaction extends Migration
{
    public function up()
    {
        Schema::create('transaction',function(Blueprint $table){
            $table->increments('id');
            $table->integer('fare_id')->unsigned();
            $table->integer('discount_id')->unsigned();
            $table->integer('no_passenger');
            $table->float('amount');
            $table->timestamps();

            $table->foreign('fare_id')
            ->references('id')
            ->on('fare')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('discount_id')
            ->references('id')
            ->on('discount')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction');
    }
};
