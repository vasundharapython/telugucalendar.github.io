<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthMisTable extends Migration
{
    public function up()
    {
        Schema::create('month_mis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->string('rahukalam')->nullable();
            $table->string('yamagandam')->nullable();
            $table->string('durmuhurtham')->nullable();
            $table->string('thidhi')->nullable();
            $table->string('nakshatram')->nullable();
            $table->string('varjyam')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
