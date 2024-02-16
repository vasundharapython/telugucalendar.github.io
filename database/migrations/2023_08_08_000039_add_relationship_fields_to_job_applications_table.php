<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('job_profile_id')->nullable();
            $table->foreign('job_profile_id', 'job_profile_fk_8846657')->references('id')->on('job_roles');
        });
    }
}
