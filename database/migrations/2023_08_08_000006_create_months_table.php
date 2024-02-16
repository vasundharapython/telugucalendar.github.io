<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthsTable extends Migration
{
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->date('date')->nullable();
            $table->string('pandugalu')->nullable();
            $table->string('govtselavu')->nullable();
            $table->string('upavasalu')->nullable();
            $table->string('importantdays')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
