@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/enquiry') }}">Fee</a>
            </li>
             <li class="breadcrumb-item"><a href="#">{{ $fee->standard }}</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')
<div class="card">
                           <form action="{{ url('/fee/'.$fee->id.'/edit') }}" method="post" name="editfee" id="editfee">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Edit Fee Structure</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                    <label for="year">Academic Year</label><span style="color:red"> *</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{$fee->fromyear}}">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{$fee->toyear}}">
                                            <span style="color:red">{{ $errors->first('to_year') }}</span>
                                        </div>
                                        <div class="col-md-8">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label><span style="color:red"> *</span>
                                    <select id="standard" name="standard" class="form-control" size="1">
                                       <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            @if($fee->standard == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">C.GST %</label> <span style="color:red"> *</span>
                                        <input name ="cgst" type="text" class="form-control" id="cgst" placeholder="C.GST %" value="{{ $fee->cgst }}">
                                        <span style="color:red">{{ $errors->first('cgst') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">S.GST %</label> <span style="color:red"> *</span>
                                        <input name ="sgst" type="text" class="form-control" id="sgst" placeholder="S.GST %" value="{{ $fee->sgst }}">
                                        <span style="color:red">{{ $errors->first('sgst') }}</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name">1st Installment (On Admission)</label> <span style="color:red"> *</span>
                                        <input name ="1stinstallment" type="text" class="form-control" id="1stinstallment" placeholder="1st Installment (On Admission)" value=" {{$fee["1stinstallment"]}} "  onkeyup="sum1();">
                                        <span style="color:red">{{ $errors->first('1stinstallment') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">GST</label> <span style="color:red"> *</span>
                                        <input name ="gst1" type="text" class="form-control" id="gst1" placeholder="GST" value="{{$fee["1gst"]}}"  onkeyup="sum1();">
                                        <span style="color:red">{{ $errors->first('gst1') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Total</label> <span style="color:red"> *</span>
                                        <input name ="total1" type="text" class="form-control" id="total1" placeholder="Total" value="{{$fee["1total"]}}">
                                        <span style="color:red">{{ $errors->first('total1') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">2nd Installment</label> <span style="color:red"> *</span>
                                        <input name ="2ndinstallment" type="text" class="form-control" id="2ndinstallment" placeholder="2nd Installment" value="{{$fee["2ndinstallment"]}}" onkeyup="sum2();">
                                        <span style="color:red">{{ $errors->first('2ndinstallment') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">GST</label> <span style="color:red"> *</span>
                                        <input name ="gst2" type="text" class="form-control" id="gst2" placeholder="GST" value="{{$fee["2gst"]}}" onkeyup="sum2();">
                                        <span style="color:red">{{ $errors->first('gst2') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Total</label> <span style="color:red"> *</span>
                                        <input name ="total2" type="text" class="form-control" id="total2" placeholder="Total" value="{{$fee["2total"]}}">
                                        <span style="color:red">{{ $errors->first('total2') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">3rd Installment</label> <span style="color:red"> *</span>
                                        <input name ="3rdinstallment" type="text" class="form-control" id="3rdinstallment" placeholder="3rd Installment" value="{{$fee["3rdinstallment"]}}" onkeyup="sum3();">
                                        <span style="color:red">{{ $errors->first('3rdinstallment') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">GST</label> <span style="color:red"> *</span>
                                        <input name ="gst3" type="text" class="form-control" id="gst3" placeholder="GST" value="{{$fee["3gst"]}}" onkeyup="sum3();">
                                        <span style="color:red">{{ $errors->first('gst3') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Total</label> <span style="color:red"> *</span>
                                        <input name ="total3" type="text" class="form-control" id="total3" placeholder="Total" value="{{$fee["3total"]}}">
                                        <span style="color:red">{{ $errors->first('total3') }}</span>
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

    $("#1stinstallment").on('input',function() {
       var first = document.getElementById('1stinstallment').value;
       var cgst=document.getElementById('cgst').value;
       var sgst=document.getElementById('sgst').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(first)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst1').value = gst;
       var gst1 = document.getElementById('gst1').value;
       var result = parseInt(first) + parseInt(gst1);
       if (!isNaN(result)) {
         document.getElementById('total1').value = result;
       }

    });
    
    $("#2ndinstallment").on('input',function() {
       var second = document.getElementById('2ndinstallment').value;
       var cgst=document.getElementById('cgst').value;
       var sgst=document.getElementById('sgst').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(second)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst2').value = gst;
       var gst2 = document.getElementById('gst2').value;
       var result = parseInt(second) + parseInt(gst2);
       if (!isNaN(result)) {
         document.getElementById('total2').value = result;
       }

    });

    $("#3rdinstallment").on('input',function() {
       var third = document.getElementById('3rdinstallment').value;
       var cgst=document.getElementById('cgst').value;
       var sgst=document.getElementById('sgst').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(third)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst3').value = gst;
       var gst3 = document.getElementById('gst3').value;
       var result = parseInt(third) + parseInt(gst3);
       if (!isNaN(result)) {
         document.getElementById('total3').value = result;
       }

    });

    $("#cgst").on('input',function() {
       var cgst=document.getElementById('cgst').value;
       var sgst=document.getElementById('sgst').value;

       var first = document.getElementById('1stinstallment').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(first)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst1').value = gst;
       var gst1 = document.getElementById('gst1').value;
       var result = parseInt(first) + parseInt(gst1);
       if (!isNaN(result)) {
         document.getElementById('total1').value = result;
       }

       var second = document.getElementById('2ndinstallment').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(second)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst2').value = gst;
       var gst2 = document.getElementById('gst2').value;
       var result = parseInt(second) + parseInt(gst2);
       if (!isNaN(result)) {
         document.getElementById('total2').value = result;
       }

       var third = document.getElementById('3rdinstallment').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(third)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst3').value = gst;
       var gst3 = document.getElementById('gst3').value;
       var result = parseInt(third) + parseInt(gst3);
       if (!isNaN(result)) {
         document.getElementById('total3').value = result;
       }

    });
    $("#sgst").on('input',function() {
       var cgst=document.getElementById('cgst').value;
       var sgst=document.getElementById('sgst').value;

       var first = document.getElementById('1stinstallment').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(first)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst1').value = gst;
       var gst1 = document.getElementById('gst1').value;
       var result = parseInt(first) + parseInt(gst1);
       if (!isNaN(result)) {
         document.getElementById('total1').value = result;
       }

       var second = document.getElementById('2ndinstallment').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(second)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst2').value = gst;
       var gst2 = document.getElementById('gst2').value;
       var result = parseInt(second) + parseInt(gst2);
       if (!isNaN(result)) {
         document.getElementById('total2').value = result;
       }

       var third = document.getElementById('3rdinstallment').value;
       var totalgst=parseInt(cgst)+parseInt(sgst);
       var gst=((parseInt(third)/parseInt(100))*parseInt(totalgst)).toFixed(); 
       document.getElementById('gst3').value = gst;
       var gst3 = document.getElementById('gst3').value;
       var result = parseInt(third) + parseInt(gst3);
       if (!isNaN(result)) {
         document.getElementById('total3').value = result;
       }

    });
</script>
@endsection
