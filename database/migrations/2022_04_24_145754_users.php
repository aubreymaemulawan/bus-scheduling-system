<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('dispatcher_id')->unsigned()->unique()->nullable();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('userType');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
