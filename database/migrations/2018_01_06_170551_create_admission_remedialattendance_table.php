<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionRemedialattendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_remedialattendance', function (Blueprint $table) {
            $table->primary(['admission_id','remedialatt_id']);
            $table->integer('admission_id')->unsigned()->index();
            $table->foreign('admission_id')->references('id')->on('admission')->onDelete('cascade');
            $table->integer('remedialatt_id')->unsigned()->index();
            $table->foreign('remedialatt_id')->references('id')->on('remedialattendance')->onDelete('cascade');
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
        Schema::dropIfExists('admission_remedialattendance');
    }
}
