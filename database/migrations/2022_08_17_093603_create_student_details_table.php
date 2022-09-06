<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->bigInteger('ssc_roll');
            $table->bigInteger('ssc_reg');
            $table->string('school');
            $table->string('ssc_gpa');
            $table->string('ssc_gpa_forth');
            $table->string('dob');
            $table->string('nationality');
            $table->string('father_name');
            $table->bigInteger('father_nid')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name');
            $table->bigInteger('mother_nid')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('father_yearly_income')->nullable();
            $table->string('parents_phone');
            $table->string('mother_yearly_income')->nullable();
            $table->bigInteger('birth_registration');
            $table->string('marital_status');
            $table->string('religion')->nullable();
            $table->string('permanent_address');
            $table->string('present_address')->nullable();
            $table->string('local_guardian_name')->nullable();
            $table->string('relation_local_guardian')->nullable();
            $table->string('local_guardian_mobile')->nullable();
            $table->string('blood_group')->nullable();
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
        Schema::dropIfExists('student_details');
    }
}
