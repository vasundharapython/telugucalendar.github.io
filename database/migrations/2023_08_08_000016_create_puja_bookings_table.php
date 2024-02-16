<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePujaBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('puja_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('gotram');
            $table->string('phone_no');
            $table->string('email');
            $table->longText('address');
            $table->longText('requirement_of_puja')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
