<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVedasDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('vedas_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
