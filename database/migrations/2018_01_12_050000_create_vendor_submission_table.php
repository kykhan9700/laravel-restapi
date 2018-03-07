<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_submission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->integer('requirement_id')->unsigned();            
            $table->string('status');
            $table->timestamp('submission_date');
            $table->timestamps();
        });

		Schema::table('vendor_submission', function($table) {
		   $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
		   $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
		   $table->foreign('requirement_id')->references('id')->on('requirements')->onDelete('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_submission');
    }
}
