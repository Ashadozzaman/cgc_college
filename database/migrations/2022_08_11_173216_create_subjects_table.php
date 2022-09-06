<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('certificate_id');
            $table->bigInteger('main_subject_id');
            $table->bigInteger('section_id');
            $table->string('subject_status');
            $table->bigInteger('subject_code');
            $table->bigInteger('order_by')->default(1);
            $table->timestamps();
            
            // $table->bigInteger('is_cq');
            // $table->bigInteger('cq_exam_mark')->default(0);
            // $table->bigInteger('cq_pass_mark')->default(0);
            // $table->bigInteger('is_mcq')->default(0);
            // $table->bigInteger('mcq_exam_mark')->default(0);
            // $table->bigInteger('mcq_pass_mark')->default(0);
            // $table->bigInteger('is_practical')->default(0);
            // $table->bigInteger('practical_exam_mark')->default(0);
            // $table->bigInteger('practical_pass_mark')->default(0);
            // $table->bigInteger('total_mark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
