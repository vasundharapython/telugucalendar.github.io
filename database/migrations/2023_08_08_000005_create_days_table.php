<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('suryodayam');
            $table->time('suryastamam');
            $table->string('thidhi');
            $table->string('nakshatram');
            $table->string('rahukalam');
            $table->string('yamagandam');
            $table->string('durmuhurtham');
            $table->string('varjyamu');
            $table->string('heading')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
