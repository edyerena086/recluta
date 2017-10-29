<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->string('job_title');
            $table->string('company_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('actual_job')->default(0);
            $table->text('job_description')->nullable();
            $table->timestamps();

            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_histories');
    }
}
