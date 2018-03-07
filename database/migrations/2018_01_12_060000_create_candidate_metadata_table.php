<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_metadata', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->string('visa_status');
            $table->string('visa_expiration');
            $table->string('work_location_preference');
            $table->string('expected_salary');
            $table->string('references');
            $table->string('social_info');
            $table->string('resume_url');
            $table->timestamps();
        });

		Schema::table('candidate_metadata', function($table) {
			   $table->foreign('profile_id')->references('id')->on('profiles')->onDelete("cascade");
			   $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete("cascade");
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_metadata');
    }
}
