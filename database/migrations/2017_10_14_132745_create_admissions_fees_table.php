<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions_fees', function (Blueprint $table) {
            $table->primary(['admission_id','fee_id']);
            $table->integer('admission_id')->unsigned()->index();
            $table->foreign('admission_id')->references('id')->on('admission')->onDelete('cascade');
            $table->integer('fee_id')->unsigned()->index();
            $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade');
            $table->date('installment_date1')->nullable();
            $table->string('installment_mode1')->nullable();
            $table->string('bank1')->nullable();
            $table->string('branch1')->nullable();
            $table->string('chequeno1')->nullable();
            $table->string('transcriptid1')->nullable();
            $table->date('installment_date2')->nullable();
            $table->string('installment_mode2')->nullable();
            $table->string('bank2')->nullable();
            $table->string('branch2')->nullable();
            $table->string('chequeno2')->nullable();
            $table->string('transcriptid2')->nullable();
            $table->date('installment_date3')->nullable();
            $table->string('installment_mode3')->nullable();
            $table->string('bank3')->nullable();
            $table->string('branch3')->nullable();
            $table->string('chequeno3')->nullable();
            $table->string('transcriptid3')->nullable();
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
        Schema::dropIfExists('admissions_fees');
    }
}
