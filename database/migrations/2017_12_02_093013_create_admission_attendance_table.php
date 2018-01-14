<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_attendance', function (Blueprint $table) {
            $table->primary(['admission_id','attendance_id']);
            $table->integer('admission_id')->unsigned()->index();
            $table->foreign('admission_id')->references('id')->on('admission')->onDelete('cascade');
            $table->integer('attendance_id')->unsigned()->index();
            $table->foreign('attendance_id')->references('id')->on('attendance')->onDelete('cascade');
            $table->string('attendance');
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
        Schema::dropIfExists('admission_attendance');
    }
}
