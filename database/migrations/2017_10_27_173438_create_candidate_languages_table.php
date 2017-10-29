<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->integer('proficiency');
            $table->timestamps();

            /**
             * Foreign keys
             */
            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
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
        Schema::dropIfExists('candidate_languages');
    }
}
