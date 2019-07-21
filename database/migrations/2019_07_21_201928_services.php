<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Services extends Migration
{
   public function up()
    {
         Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }
    

  
    public function down()
    {
        Schema::drop('services');
    }
}
