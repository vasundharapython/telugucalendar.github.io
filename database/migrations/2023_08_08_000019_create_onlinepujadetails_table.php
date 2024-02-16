<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlinepujadetailsTable extends Migration
{
    public function up()
    {
        Schema::create('onlinepujadetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->longText('details_of_program')->nullable();
            $table->string('place_of_program')->nullable();
            $table->datetime('date_time');
            $table->string('contact_details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
