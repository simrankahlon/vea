<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear')->nullable();
            $table->integer('toyear')->nullable();
            $table->date('date')->nullable();
            $table->string('branch')->nullable();
            $table->string('standard')->nullable();
            $table->string('batch')->nullable();
            $table->string('topic_name')->nullable();
            $table->string('portion')->nullable();
            $table->integer('total_marks')->nullable();
            $table->double('passing_percent')->nullable();
            $table->double('passing_marks')->nullable();
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
        Schema::dropIfExists('school_marks');
    }
}
