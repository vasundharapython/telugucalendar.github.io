<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuhurthambookingsTable extends Migration
{
    public function up()
    {
        Schema::create('muhurthambookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('spouse_name');
            $table->string('stars');
            $table->time('seeking_muhurtham');
            $table->string('place_of_muhurtham');
            $table->string('contact_details');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
