<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear');
            $table->integer('toyear');
            $table->string('branch');
            $table->string('standard');
            $table->date('date');
            $table->string('name');
            $table->string('school');
            $table->string('otherschool')->nullable();
            $table->string('fatherno')->nullable();
            $table->string('motherno')->nullable();
            $table->string('landline')->nullable();
            $table->date('date1')->nullable();
            $table->string('response1')->nullable();
            $table->string('attendance1')->nullable();
            $table->date('date2')->nullable();
            $table->string('response2')->nullable();
            $table->string('attendance2')->nullable();
            $table->date('date3')->nullable();
            $table->string('response3')->nullable();
            $table->string('attendance3')->nullable();
            $table->boolean('waiting_list')->nullable();
            $table->string('remark')->nullable();
            $table->integer('adm_id')->nullable();
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
        Schema::dropIfExists('enquiry');
    }
}
