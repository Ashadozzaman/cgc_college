<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('section_id');
            $table->bigInteger('session_id');
            $table->bigInteger('total_seat');
            $table->bigInteger('total_enrolled');
            $table->bigInteger('total_appeared');
            $table->bigInteger('ap')->default(0);
            $table->bigInteger('a')->default(0);
            $table->bigInteger('am')->default(0);
            $table->bigInteger('b')->default(0);
            $table->bigInteger('c')->default(0);
            $table->bigInteger('d')->default(0);
            $table->bigInteger('absent')->default(0);
            $table->bigInteger('fail')->default(0);
            $table->bigInteger('pass')->default(0);
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
        Schema::dropIfExists('result_histories');
    }
}
