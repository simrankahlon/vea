@extends('layouts.pdf')
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
@section('content')
<br>
<br>
<div class="page">
<div class="h3 text-success mb-0 mt-h" style="font-family: Monotype Corsiva;font-style: Italic Bold; font-size: 38px;"><center>Received with thanks</center></div></th>
<table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;" width="60%"></th>
        <th style="border:0px;" width="0%"></th> 
        <th style="border:0px;" width="40%"></th>
        </tr>
        <tr>
            <td>
                <div class="h4 text-primary mb-0 mt-h">Receipt Id : <span class="text-muted">{{$admission["receipt_no".$installment]}}</span></div>
            </td>
            <td></td>
            <td>
                <div class="h4 text-primary mb-0 mt-h">Receipt Date : <span class="text-muted">{{ date('d-m-Y', strtotime($admission["installment_date".$installment])) }}</span></div>
            </td>
        </tr>
        <tr>
            <td width="100%">
                <div class="h4 text-primary mb-0 mt-h">Name : <span class="text-muted">{{$admission->studentname}}</span></div>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td width="100%">
                <div class="h4 text-primary mb-0 mt-h">Std : <span class="text-muted">{{$admission->standard}}</span> </div>
            </td>
            <td>
            </td>
            <td width="100%">
                <div class="h4 text-primary mb-0 mt-h ">Batch : <span class="text-muted">{{$admission->admissionbatch}}</span> </div>
            </td>
        </tr>
        <tr>
            <td width="90%">
                <div class="h4 text-primary mb-0 mt-h ">Installment : <span class="text-muted">
                    @if($val==1)
                        1st Installment (On Admission)
                    @elseif($val==2)
                        2nd Installment
                    @elseif($val==3)
                        3rd Installment
                    @elseif($val==0)
                        Full Payment
                    @endif</span> 
                </div>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <div class="h4 text-primary mb-0 mt-h ">Academic Year : <span class="text-muted"> {{$admission->fromyear}} - {{$admission->toyear}} </span> </div>
            </td> 
            <td></td>
            <td>
                <div class="h4 text-primary mb-0 mt-h ">Branch : <span class="text-muted"> {{$admission->branch}}</span> </div>
            </td> 
        </tr>
        <tr>
            <td width="100%">
                <div class="h4 text-primary mb-0 mt-h ">Payment Mode : <span class="text-muted">
                    @foreach(App\Http\AcatUtilities\PaymentMode::all() as $value => $code)
                        @if($admission["installment_mode".$val]==$code)
                            @php
                                $paytype=$value;
                            @endphp
                            {{$value}}
                        @endif
                    @endforeach
                </span></div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="h4 text-primary mb-0 mt-h ">GST No. : <span class="text-muted">{{$admission["gst_no".$installment]}}</span></div>
            </td>
        </tr>
        @if($paytype=='Cheque')
        <tr>
            <td>
                <div class="h4 text-primary mb-0 mt-h ">Bank : <span class="text-muted">{{$admission["bank".$installment]}}</span></div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="h4 text-primary mb-0 mt-h ">Branch : <span class="text-muted">{{$admission["branch".$installment]}}</span> </div>
            </td>
        </tr>
        <tr> 
            <td>
                <div class="h4 text-primary mb-0 mt-h ">Cheque No : <span class="text-muted">{{$admission["chequeno".$installment]}}</span> </div>
            </td>
        </tr>
        @endif
        @if($paytype=='Online Payment')
        <tr>
            <td>
                <div class="h4 text-primary mb-0 mt-h ">Transaction Id :  <span class="text-muted">          {{$admission["transactionid".$installment]}}</span></div>
            </td>
            <td></td>
            <td>
                <div class="h4 text-primary mb-0 mt-h ">Bank :  <span class="text-muted">          {{$admission["bank_transactionid".$installment]}}</span></div>
            </td>
        </tr>
        @endif
        <tr>
        @foreach($fee as $fe)
        <td width="33%">
            <div class="h4 text-primary mb-0 mt-h ">Fees :  <span class="text-muted">@if($val==1){{ $fe["1stinstallment"] }}
            @elseif($val==2){{ $fe["2ndinstallment"] }}
            @elseif($val==3){{ $fe["3rdinstallment"] }}
            @elseif($val==0){{ $fe["totalinstallment"] }}
            @endif</span></div>
        </td>
        <td>
        </td>
        <td>
        </td>
        </tr>
        <tr>
         <td width="33%">
             <div class="h4 text-primary mb-0 mt-h">GST (18%) : <span class="text-muted">
             @if($val==1){{ $fe["1gst"] }}
             @elseif($val==2){{ $fe["2gst"] }}
             @elseif($val==3){{ $fe["3gst"] }}
             @elseif($val==0){{ $fe["totalgst"] }}
             @endif</span> </div>
        </td> 
        <td>
        </td>
        <td>
        </td>
        </tr>
        <tr>
        <td width="33%">
             <div class="h4 text-primary mb-0 mt-h">Total : <span class="text-muted">
             @if($val==1){{ $fe["1total"] }}
             @elseif($val==2){{ $fe["2total"] }}
             @elseif($val==3){{ $fe["3total"] }}
             @elseif($val==0){{ $fe["totalfee"] }}
             @endif</span> </div>
        </td>
        <td>
        </td>
        <td>
        </td>
        </tr>
        
        @endforeach
        </tr>
 </table>
</div>

@endsection
