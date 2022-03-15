<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createalltables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('site', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->text('keywords');
            $table->string('favicon');
            $table->text('scriptheader')->nullable();
            $table->text('scriptend')->nullable();
            $table->timestamps();

        });

        Schema::create('articles', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('cover');
            $table->text('text');
            $table->timestamps();

        });

        Schema::create('projects', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('cover');
            $table->string('portifolio');
            $table->timestamps();

        });

        Schema::create('newsletters', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->timestamps();

        });

        Schema::create('banners', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('cover');
            $table->timestamps();

        });

        Schema::create('form_recived', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('from');
            $table->string('title');
            $table->string('email');
            $table->string('subject');
            $table->text('body');
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
        Schema::dropIfExists('site');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('newsletters');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('form_recived');
    }
}
