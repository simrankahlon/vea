<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionSchoolMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_school_marks', function (Blueprint $table) {
            $table->primary(['admission_id','schoolmark_id']);
            $table->integer('admission_id')->unsigned()->index();
            $table->foreign('admission_id')->references('id')->on('admission')->onDelete('cascade');
            $table->integer('schoolmark_id')->unsigned()->index();
            $table->foreign('schoolmark_id')->references('id')->on('school_marks')->onDelete('cascade');
            $table->string('schoolmarks_obtained');
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
        Schema::dropIfExists('admission_school_marks');
    }
}
