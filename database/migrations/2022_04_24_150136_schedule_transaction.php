<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScheduleTransaction extends Migration
{
    public function up()
    {
        Schema::create('schedule_transaction',function(Blueprint $table){
            $table->increments('id');
            $table->integer('schedule_id')->unsigned();
            $table->integer('transaction_id')->unsigned();
            $table->integer('total_passengers');
            $table->float('total_amount');
            $table->timestamps();

            $table->foreign('schedule_id')
            ->references('id')
            ->on('schedule')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('transaction_id')
            ->references('id')
            ->on('transaction')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule_transaction');
    }
};
