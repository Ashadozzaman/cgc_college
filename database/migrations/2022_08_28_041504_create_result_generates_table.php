<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultGeneratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_generates', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('exam_id');
            $table->bigInteger('mark_setup_id');
            $table->bigInteger('subject_code');
            $table->bigInteger('student_id');
            $table->bigInteger('total_mark')->default(0);
            $table->bigInteger('cq')->default(0);
            $table->bigInteger('mcq')->default(0);
            $table->bigInteger('practical')->default(0);
            $table->double('gpa',5,2)->default(0);
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
        Schema::dropIfExists('result_generates');
    }
}
