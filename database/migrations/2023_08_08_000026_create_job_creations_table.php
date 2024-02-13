<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCreationsTable extends Migration
{
    public function up()
    {
        Schema::create('job_creations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job')->nullable();
            $table->string('location')->nullable();
            $table->longText('job_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
