<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBhakthiGeethaCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('bhakthi_geetha_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}