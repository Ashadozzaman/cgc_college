<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('exam_id');
            $table->bigInteger('teacher_id')->nullable();
            $table->bigInteger('subject_code');
            $table->bigInteger('section_id');
            $table->bigInteger('total_mark');
            $table->bigInteger('cq');
            $table->bigInteger('mcq')->default(0);
            $table->bigInteger('practical')->default(0);
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
        Schema::dropIfExists('mark_setups');
    }
}
