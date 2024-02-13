<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoroscopedetailsTable extends Migration
{
    public function up()
    {
        Schema::create('horoscopedetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->time('time_of_birth');
            $table->string('place_of_birth');
            $table->longText('problem_details');
            $table->string('contact_details');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
