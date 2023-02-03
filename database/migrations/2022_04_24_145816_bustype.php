<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bustype extends Migration
{
    public function up()
    {
        Schema::create('bustype',function(Blueprint $table){
            $table->increments('id');
            $table->string('bus_type');
            $table->timestamps();
        });

        \DB::table('bustype')->insert([
            'bus_type' => 'Airconditioned'
        ]);

        \DB::table('bustype')->insert([
            'bus_type' => 'Non-Airconditioned'
        ]);
              
    }

    
    public function down()
    {
        Schema::dropIfExists('bustype');
    }
};
