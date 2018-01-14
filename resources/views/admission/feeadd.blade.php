@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/batch/'.$batch->id.'/'.$admission->standard.'/admission') }}">{{ $admission->standard }} - {{ $batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{$admission->studentname}}</li>
</ol>
@endsection

@section('content')
@php
$val="";
if($installment==1)
$val=1;
elseif($installment==2)
$val=2;
elseif($installment==3)
$val=3;
elseif($installment==0)
$val=0;
@endphp

<div class="card">
                            <form action="{{ url('/admission/'.$admission->id.'/'.$installment.'/fee') }}" method="post" name="addfee" id="addfee">
                                {{ csrf_field() }}
                            <div class="card-header">
                                @if($val==1)
                                <strong>1st Installment (On Admission)</strong>
                                @elseif($val==2)
                                <strong>2nd Installment</strong>
                                @elseif($val==3)
                                <strong>3rd Installment</strong>
                                @elseif($val==0)
                                <strong>Full Payment</strong>
                                @endif
                            </div>
                            <div class="card-block">
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Student Name : </label>
                                    <div class="col-md-10">
                                    {{$admission->studentname}}
                                    </div>
                                    </div>
                                    @foreach($fee as $fe)
                                    <div class="form-group row">
                                        @if($val==1)
                                        <label for="name" class="col-md-2 form-control-label">1st Installment (On Admission) : </label> 
                                        @elseif($val==2)
                                        <label for="name" class="col-md-2 form-control-label">2nd Installment :</label> 
                                        @elseif($val==3)
                                        <label for="name" class="col-md-2 form-control-label">3rd Installment : </label>
                                        @elseif($val==0)
                                        <label for="name" class="col-md-2 form-control-label">Total Installment : </label>
                                        @endif
                                        <div class="col-md-10">
                                        @if($val==1){{ $fe["1stinstallment"] }}
                                        @elseif($val==2){{ $fe["2ndinstallment"] }}
                                        @elseif($val==3){{ $fe["3rdinstallment"] }}
                                        @elseif($val==0){{ $fe["totalinstallment"] }}
                                        @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gst" class="col-md-2 form-control-label">GST : </label>
                                        <div class="col-md-10">
                                        @if($val==1){{ $fe["1gst"] }}
                                        @elseif($val==2){{ $fe["2gst"] }}
                                        @elseif($val==3){{ $fe["3gst"] }}
                                        @elseif($val==0){{ $fe["totalgst"] }}
                                        @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gst" class="col-md-2 form-control-label">Total : </label>
                                        <div class="col-md-10">
                                        @if($val==1){{ $fe["1total"] }}
                                        @elseif($val==2){{ $fe["2total"] }}
                                        @elseif($val==3){{ $fe["3total"] }}
                                        @elseif($val==0){{ $fe["totalfee"] }}
                                        @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Date of Payment</label><span style="color:red"> *</span>
                                            <input name ="date" required="" type="date" class="form-control" id="date" size="1" value=
                                            @if($val==1)
                                            {{$admission->installment_date1}}
                                            @elseif($val==2)
                                            {{$admission->installment_date2}}
                                            @elseif($val==3)
                                            {{$admission->installment_date3}}
                                            @elseif($val==0)
                                            {{$admission->installment_date0}}
                                            @else
                                            {{old('date')}}
                                            @endif>
                                            <span style="color:red">{{ $errors->first('date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-9">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="serialno">Serial No.</label><span style="color:red"> *</span>
                                    <select id="serialno" name="serialno" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Serialno::all() as $value => $code)
                                            @if($admission["serial_no".$val]==$code)
                                            <option value="{{$code}}" selected="selected" >{{$value}}</option>
                                            @else
                                            <option value="{{$code}}" @if (old('serialno') == $code) selected="selected" @endif>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('serialno') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="paymentmode">Mode of Payment</label><span style="color:red"> *</span>
                                    <select id="paymentmode" name="paymentmode" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\PaymentMode::all() as $value => $code)
                                            @if($admission["installment_mode".$val]==$code)
                                            <option value="{{$code}}" selected="selected" >{{$value}}</option>
                                            @else
                                            <option value="{{$code}}" @if (old('paymentmode') == $code) selected="selected" @endif>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('paymentmode') }}</span>
                                    </div>
                                    <div class="cheque" style="display: none;" id="cheque">
                                    <div class="form-group">
                                        <label for="bank">Bank</label> <span style="color:red"> *</span>
                                        <input name ="bank" type="bank" class="form-control" id="bank" placeholder="Bank" value=@if($admission["bank".$val]!=null)
                                        {{$admission["bank".$val]}}
                                         @else
                                        {{ old('bank') }}
                                        @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch</label> <span style="color:red"> *</span>
                                        <input name ="branch" type="branch" class="form-control" id="branch" placeholder="Branch" value=@if($admission["branch".$val]!=null)
                                        {{$admission["branch".$val]}}
                                         @else
                                        {{ old('branch') }}
                                        @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="chequeno">Cheque no</label> <span style="color:red"> *</span>
                                        <input name ="chequeno" type="chequeno" class="form-control" id="chequeno" placeholder="Cheque no" pattern="[0-9]{6}" title="Six Digits Only"value=@if($admission["chequeno".$val]!=null)
                                        {{$admission["chequeno".$val]}}
                                         @else
                                        {{ old('chequeno') }}
                                        @endif >
                                    </div>
                                    </div>
                                    <div class="online" style="display: none;" id="online">
                                    <div class="form-group">
                                        <label for="transactionid">Transaction id</label> <span style="color:red"> *</span>
                                        <input name ="transactionid" type="transactionid" class="form-control" id="transactionid" placeholder="Transaction id " value=@if($admission["transactionid".$val]!=null)
                                        {{$admission["transactionid".$val]}}
                                         @else
                                        {{ old('transactionid') }}
                                        @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="transaction_bank">Bank</label> <span style="color:red"> *</span>
                                        <input name ="transaction_bank" type="transaction_bank" class="form-control" id="transaction_bank" placeholder="Bank" value=@if($admission["bank_transactionid".$val]!=null)
                                        {{$admission["bank_transactionid".$val]}}
                                         @else
                                        {{ old('transaction_bank') }}
                                        @endif>
                                    </div>
                                    </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" id="save" class="btn btn-primary">Save changes</button>
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
                            </div>
                            </form>
                        </div>
@endsection

@section('javascriptfunctions')
<script type="text/javascript">
$(document).ready(function($){
    var paymentmode = $("#paymentmode").val();
    if(paymentmode=='CHEQUE')
    {
        $("#cheque").show();
    }
    else
    {
        $("#cheque").hide();
    }

    if(paymentmode=='ONLINEPAYMENT')
    {
        $("#online").show();
    }
    else
    {
        $("#online").hide();
    }
  
});
 $("#paymentmode" ).change(function() 
  {
   
    var paymentmode = $("#paymentmode").val();
    if(paymentmode=='CHEQUE')
    {
        $("#cheque").show();
    }
    else
    {
        $("#cheque").hide();
    }

    if(paymentmode=='ONLINEPAYMENT')
    {
        $("#online").show();
    }
    else
    {
        $("#online").hide();
    }
    
  });

  $("#addfee").submit(function() {

    $("#paymentmode").prop("disabled", false);
    var paymentmode = $("#paymentmode").val();
    if(paymentmode=='CHEQUE')
    {
        var bank=$('#bank').val();
        var branch=$('#branch').val();
        var chequeno=$('#chequeno').val();
        if(bank=="" || branch=="" || chequeno=="")
        {
            alert("Please enter cheque related details.");
            return false;
        }
    }
    else if(paymentmode=='ONLINEPAYMENT')
    {
        var transactionid=$('#transactionid').val();

        var transaction_bank=$('#transaction_bank').val();
       
        if(transactionid=="" || transaction_bank=="") 
        {
            alert("Please enter Online Payment related details.");
            return false;
        }
    }

  
});   
  $("#serialno").change(function()
  { //this is the #state dom element
      var serialno = $(this).val();
      if (serialno == 'B')
      {
          $("#paymentmode").val("CASH");
          $("#paymentmode").prop("disabled",true);
          $("#cheque").hide();
          $("#online").hide();
      }
      else
      { 
          $("#paymentmode").val("");
          $("#paymentmode").prop("disabled", false);
      }
  });
    
</script>
@endsection
