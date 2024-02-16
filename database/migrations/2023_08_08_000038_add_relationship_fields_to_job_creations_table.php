<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobCreationsTable extends Migration
{
    public function up()
    {
        Schema::table('job_creations', function (Blueprint $table) {
            $table->unsignedBigInteger('job_category_id')->nullable();
            $table->foreign('job_category_id', 'job_category_fk_8846638')->references('id')->on('job_categories');
            $table->unsignedBigInteger('job_role_id')->nullable();
            $table->foreign('job_role_id', 'job_role_fk_8846639')->references('id')->on('job_roles');
        });
    }
}
