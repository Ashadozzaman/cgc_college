<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('designation_id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->bigInteger('age');
            $table->string('gender');
            $table->string('joining_date')->nullable();
            $table->string('email')->nullable();
            $table->text('details')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('status')->default(1);
            $table->bigInteger('order_by')->default(100);
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
        Schema::dropIfExists('staff');
    }
}
