<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsMeetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents_meet_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear');
            $table->integer('toyear');
            $table->date('date_of_call');
            $table->date('date_of_meet')->nullable();
            $table->string('branch');
            $table->string('standard');
            $table->string('batch');
            $table->string('studentname');
            $table->string('tomeet')->nullable();
            $table->string('reason')->nullable();
            $table->string('remarks')->nullable();
            $table->string('timing')->nullable();
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
        Schema::dropIfExists('parents_meet_details');
    }
}
