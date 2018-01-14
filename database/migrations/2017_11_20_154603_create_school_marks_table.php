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
            $table->integer('fromyear');
            $table->integer('toyear');
            $table->date('date');
            $table->string('branch');
            $table->string('standard');
            $table->string('batch');
            $table->string('topic_name');
            $table->string('portion');
            $table->integer('total_marks');
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
