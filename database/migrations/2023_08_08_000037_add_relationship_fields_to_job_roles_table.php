<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobRolesTable extends Migration
{
    public function up()
    {
        Schema::table('job_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('job_category_id')->nullable();
            $table->foreign('job_category_id', 'job_category_fk_8846623')->references('id')->on('job_categories');
        });
    }
}
