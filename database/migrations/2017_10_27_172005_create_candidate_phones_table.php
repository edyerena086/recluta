<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->integer('phone_type_id')->unsigned();
            $table->string('phone');
            $table->timestamps();

            /**
             * Foreign keys
             */
            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates')
                ->onDelete('cascade');

            $table->foreign('phone_type_id')
                ->references('id')
                ->on('phone_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_phones');
    }
}
