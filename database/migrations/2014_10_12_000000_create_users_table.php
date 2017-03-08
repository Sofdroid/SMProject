<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('lastname');
            $table->integer('weight');
            $table->integer('size');
            $table->string('gender');
            $table->string('manuality');
            $table->date('birthday');      
            $table->string('job');
            $table->unsignedBigInteger('phonenumber');
            $table->string('adress'); 
            $table->string('favoritemusic');
            $table->string('favoritemovies');
            $table->string('politicalview');      
            $table->string('religiousview');
            $table->longText('aboutme');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
