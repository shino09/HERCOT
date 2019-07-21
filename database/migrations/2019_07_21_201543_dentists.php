<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dentists extends Migration
{
   
    public function up()
    {
         Schema::create('dentists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }
    

  
    public function down()
    {
        Schema::drop('dentists');
    }
}
