<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRolesTable extends Migration
{
    public function up()
    {
        Schema::create('job_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_role');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
