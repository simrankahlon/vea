<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear');
            $table->integer('toyear');
            $table->string('standard');
            $table->double('cgst');
            $table->double('sgst');
            $table->double('1stinstallment');
            $table->double('1gst');
            $table->double('1total');
            $table->double('2ndinstallment');
            $table->double('2gst');
            $table->double('2total');
            $table->double('3rdinstallment');
            $table->double('3gst');
            $table->double('3total');
            $table->double('totalinstallment');
            $table->double('totalgst');
            $table->double('totalfee');
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
        Schema::dropIfExists('fees');
    }
}
