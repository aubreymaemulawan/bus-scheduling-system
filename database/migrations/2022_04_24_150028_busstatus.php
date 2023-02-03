<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Busstatus extends Migration
{
    public function up()
    {
        Schema::create('busstatus',function(Blueprint $table){
            $table->increments('id');
            $table->string('bus_status');
            $table->timestamps();
        });
        \DB::table('busstatus')->insert([
            'bus_status' => 'LoadingPassenger'
        ]);

        \DB::table('busstatus')->insert([
            'bus_status' => 'Departed'
        ]);
        \DB::table('busstatus')->insert([
            'bus_status' => 'Arrived'
        ]);

        \DB::table('busstatus')->insert([
            'bus_status' => 'Break'
        ]);
        \DB::table('busstatus')->insert([
            'bus_status' => 'OnStandby'
        ]);

        \DB::table('busstatus')->insert([
            'bus_status' => 'Cancelled'
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('busstatus');
    }
};
