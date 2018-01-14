<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestschedulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testscheduler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear')->nullable();
            $table->integer('toyear')->nullable();
            $table->string('branch')->nullable();
            $table->date('announcement_date')->nullable();
            $table->string('standard')->nullable();
            $table->string('batch')->nullable();
            $table->date('test_date')->nullable();
            $table->string('portion_set')->nullable();
            $table->double('marks')->nullable();
            $table->boolean('question_paper_ready')->nullable();
            $table->boolean('xerox')->nullable();
            $table->string('correction_done_by')->nullable();
            $table->date('distribution_date')->nullable();
            $table->boolean('answer_key_uploaded')->nullable();
            $table->boolean('msg_send')->nullable();
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
        Schema::dropIfExists('testscheduler');
    }
}
