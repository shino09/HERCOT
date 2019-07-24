<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Appointments extends Migration
{
   public function up()
    {
         Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            //$table->date('date')->format('d-m-Y');
            $table->integer('price')->nullable();
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->integer('dentist_id')->unsigned();
            $table->foreign('dentist_id')->references('id')->on('dentists')->onDelete('cascade');
            $table->timestamps();
        });
    }


  
    public function down()
    {
        Schema::drop('appointments');
    }
}
