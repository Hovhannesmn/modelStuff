<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->string('name');

            $table->string('contact_email');
            $table->string('cellphone');

            $table->string('nationality');

            $table->text('languages');

            $table->integer('age')->unsigned();
            $table->integer('weight')->unsigned();
            $table->integer('height')->unsigned();
            $table->integer('breast_number')->unsigned();
            $table->string('breast_letter');
            $table->string('haircolor');

            $table->string('intimicy');

            $table->boolean('smoke');
            $table->boolean('drink');

            $table->text('about_short');
            $table->text('about_full');

            $table->boolean('confirmed');

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
        Schema::drop('profiles');
    }
}
