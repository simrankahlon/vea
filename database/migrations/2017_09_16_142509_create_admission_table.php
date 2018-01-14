<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear');
            $table->integer('toyear');
            $table->string('branch');
            $table->date('date');
            $table->string('studentname');
            $table->string('address');
            $table->string('school');
            $table->string('otherschool')->nullable();
            $table->string('fatherno')->nullable();
            $table->string('motherno')->nullable();
            $table->string('landline')->nullable();
            $table->string('whatsappon')->nullable();
            $table->string('email')->nullable();
            $table->string('standard');
            $table->string('admissionbatch');
            $table->string('timing1');
            $table->string('day1');
            $table->string('timing2')->nullable();
            $table->string('day2')->nullable();
            $table->string('parentname')->nullable();
            $table->string('occupation')->nullable();
            $table->string('officeaddress')->nullable();
            $table->string('officenumber')->nullable();
            $table->float('lasttermpercent')->nullable();
            $table->integer('english1')->nullable();
            $table->integer('english2')->nullable();
            $table->float('overallpercent')->nullable();
            $table->integer('fee_id')->unsigned()->index();
            $table->date('installment_date1')->nullable();
            $table->string('installment_mode1')->nullable();
            $table->string('bank1')->nullable();
            $table->string('branch1')->nullable();
            $table->string('chequeno1')->nullable();
            $table->string('transactionid1')->nullable();
            $table->string('bank_transactionid1')->nullable();
            $table->string('serial_no1')->nullable();
            $table->string('receipt_no1')->nullable();
            $table->date('installment_date2')->nullable();
            $table->string('installment_mode2')->nullable();
            $table->string('bank2')->nullable();
            $table->string('branch2')->nullable();
            $table->string('chequeno2')->nullable();
            $table->string('transactionid2')->nullable();
            $table->string('bank_transactionid2')->nullable();
            $table->string('serial_no2')->nullable();
            $table->string('receipt_no2')->nullable();
            $table->date('installment_date3')->nullable();
            $table->string('installment_mode3')->nullable();
            $table->string('bank3')->nullable();
            $table->string('branch3')->nullable();
            $table->string('chequeno3')->nullable();
            $table->string('transactionid3')->nullable();
            $table->string('bank_transactionid3')->nullable();
            $table->string('serial_no3')->nullable();
            $table->string('receipt_no3')->nullable();
            $table->date('installment_date0')->nullable();
            $table->string('installment_mode0')->nullable();
            $table->string('bank0')->nullable();
            $table->string('branch0')->nullable();
            $table->string('chequeno0')->nullable();
            $table->string('transactionid0')->nullable();
            $table->string('bank_transactionid0')->nullable();
            $table->string('serial_no0')->nullable();
            $table->string('receipt_no0')->nullable();
            $table->boolean('remedial_list')->nullable();
            $table->string('remedialbatch')->nullable();
            $table->string('remedialbranch')->nullable();
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
        Schema::dropIfExists('admission');
    }
}
