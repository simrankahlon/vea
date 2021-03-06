<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemedialbatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remedialbatches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear');
            $table->integer('toyear');
            $table->string('branch');
            $table->string('standard');
            $table->string('batchname');
            $table->string('start');
            $table->string('end');
            $table->string('start1')->nullable();
            $table->string('end1')->nullable();
            $table->string('teacher_name');
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
        Schema::dropIfExists('remedialbatches');
    }
}
