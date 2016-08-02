<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobmarkets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('offer');
            $table->string('condition');
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->string('contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobmarkets');
    }
}
