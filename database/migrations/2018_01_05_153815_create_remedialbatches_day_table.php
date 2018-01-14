<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemedialbatchesDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remedialbatches_day', function (Blueprint $table) {
            $table->primary(['remedial_batch_id','day_id']);
            $table->integer('remedial_batch_id')->unsigned()->index();
            $table->foreign('remedial_batch_id')->references('id')->on('remedialbatches')->onDelete('cascade');
            $table->integer('day_id')->unsigned()->index();
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
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
        Schema::dropIfExists('remedialbatches_day');
    }
}
