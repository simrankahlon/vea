@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/batch/'.$batch->id.'/'.$admission->standard.'/admission') }}">{{ $admission->standard }} - {{ $batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{$admission->studentname}}</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/admission/'.$admission->id.'/'.$installment.'/emailreceipt') }}"><i class="icon-arrow-down"></i> &nbsp;Email </a>
                </div>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/admission/'.$admission->id.'/'.$installment.'/downloadreceipt') }}"><i class="icon-arrow-down"></i> &nbsp;Download PDF </a>
                </div>
            </li> 
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
<div class="card-group">
<div class="card">
                            
                            <div class="card-block">
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Branch : </label>
                                    <div class="col-md-2">
                                    {{$admission->branch}}
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Receipt Id : </label>
                                    <div class="col-md-2">
                                    {{$admission["receipt_no".$installment]}}
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Receipt Date : </label>
                                    <div class="col-md-2">
                                    {{ date('d-m-Y', strtotime($admission["installment_date".$installment])) }}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Student Name : </label>
                                    <div class="col-md-2">
                                    {{$admission->studentname}}
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Std : </label>
                                    <div class="col-md-2">
                                    {{$admission->standard}}
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Batch : </label>
                                    <div class="col-md-2">
                                    {{$admission->admissionbatch}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="paymentmode" class="col-md-2 form-control-label">Installment :</label>
                                        @if($val==1)
                                        <div class="col-md-4">
                                            1st Installment (On Admission)
                                        </div>
                                        @elseif($val==2)
                                        <div class="col-md-4">
                                            2nd Installment
                                        </div>
                                        @elseif($val==3)
                                        <div class="col-md-4">
                                            3rd Installment
                                        </div>
                                        @elseif($val==0)
                                        <div class="col-md-4">
                                            Full Payment
                                        </div>
                                        @endif
                                        <label for="paymentmode" class="col-md-2 form-control-label">GST No. :</label>
                                        <div class="col-md-4">
                                            {{$admission["gst_no".$installment]}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="paymentmode" class="col-md-2 form-control-label">Payment Mode :</label>
                                        @foreach(App\Http\AcatUtilities\PaymentMode::all() as $value => $code)
                                            @if($admission["installment_mode".$val]==$code)
                                            <div class="col-md-4">
                                            @php
                                            $paytype=$value;
                                            @endphp
                                            {{$value}}
                                            </div>
                                            @endif
                                        @endforeach
                                        <label class="col-md-2 form-control-label" for="hf-email">Academic Year : </label>
                                        <div class="col-md-4">
                                            {{$admission->fromyear}} - {{$admission->toyear}}
                                        </div>
                                    </div>
                                    @if($paytype=='Cheque')
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Bank : </label>
                                    <div class="col-md-2">
                                    {{$admission["bank".$installment]}}
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Branch : </label>
                                    <div class="col-md-2">
                                    {{$admission["branch".$installment]}}
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Cheque No : </label>
                                    <div class="col-md-2">
                                    {{$admission["chequeno".$installment]}}
                                    </div>
                                    </div>
                                    @endif

                                    @if($paytype=='Online Payment')
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Transaction Id : </label>
                                    <div class="col-md-4">
                                    {{$admission["transactionid".$installment]}}
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Bank : </label>
                                    <div class="col-md-4">
                                    {{$admission["bank_transactionid".$installment]}}
                                    </div>
                                    </div>
                                    @endif
                                    
                                    <div class="form-group row">
                                    @foreach($fee as $fe)
                                    <label class="col-md-2 form-control-label" for="hf-email">Fees : </label>
                                    <div class="col-md-2">
                                        @if($val==1){{ $fe["1stinstallment"] }}
                                        @elseif($val==2){{ $fe["2ndinstallment"] }}
                                        @elseif($val==3){{ $fe["3rdinstallment"] }}
                                        @elseif($val==0){{ $fe["totalinstallment"] }}
                                        @endif
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">GST(18%):</label>
                                    <div class="col-md-2">
                                        @if($val==1){{ $fe["1gst"] }}
                                        @elseif($val==2){{ $fe["2gst"] }}
                                        @elseif($val==3){{ $fe["3gst"] }}
                                        @elseif($val==0){{ $fe["totalgst"] }}
                                        @endif
                                    </div>
                                    <label class="col-md-2 form-control-label" for="hf-email">Total :</label>
                                    <div class="col-md-2">
                                        @if($val==1){{ $fe["1total"] }}
                                        @elseif($val==2){{ $fe["2total"] }}
                                        @elseif($val==3){{ $fe["3total"] }}
                                        @elseif($val==0){{ $fe["totalfee"] }}
                                        @endif
                                    </div>
                                    @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>

@endsection
