<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->bigInteger('role_id');
            $table->bigInteger('ssc_roll');
            $table->bigInteger('education_year');
            $table->bigInteger('section_id');
            $table->string('student_id')->unique();
            $table->string('class_roll');
            $table->string('certificate');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('image');
            $table->string('ssc_board');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
