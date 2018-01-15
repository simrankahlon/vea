@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a>
            </li>
            <li class="breadcrumb-item active"><a href="{{ url('/batch/'.$batch_id.'/'.$admission->standard.'/admission') }}">{{ $admission->standard }} - {{ $admission->admissionbatch}}</a></li>
            <li class="breadcrumb-item active">{{$admission->studentname}}</li>
</ol>
@endsection
@php
$branch=Session::get('branch');
$fromyear=Session::get('fromyear');
$toyear=Session::get('toyear');
@endphp
@section('content')

@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
<input type="hidden"  value="1" id="feecheck"/>

<div class="card">
                            <form action="{{ url('/admission/'.$admission->id.'/transferadm') }}" method="post" name="addadmission" id="addadmission">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New Admission</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                    <label for="year">Academic Year</label><span style="color:red"> *</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="" required="">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="" required="">
                                            <span style="color:red">{{ $errors->first('to_year') }}</span>
                                        </div>
                                        <div class="col-md-8">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label><span style="color:red"> * </span>
                                    <select id="branch" name="branch" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($branch==$code)
                                            <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                            <option value="{{$code}}" @if (old('branch') == $code) selected="selected" @endif>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('branch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="date">Date</label><span style="color:red"> *</span>
                                            <input name ="date" type="date" class="form-control" id="date"  placeholder="Date" value="" size="1" required="">
                                            <span style="color:red">{{ $errors->first('date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label><span style="color:red"> *</span>
                                    <select id="standard" name="standard" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @if($admission->standard=='VIII')
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            @if($admission->standard!=$code)
                                            <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                        @endif
                                        @if($admission->standard=='IX')
                                            <option value="X">X</option>
                                        @endif
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="admbatch">Admission for Batch</label><span style="color:red"> * </span>
                                        <select id="admbatch" name="admbatch" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        </select>
                                        <span style="color:red">{{ $errors->first('admbatch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="days">Day</label><span style="color:red"> * </span>
                                                  <input name ="days" type="text" class="form-control" id="days" placeholder="Day" value="{{ old('days') }}" required="">
                                                  <span style="color:red">{{ $errors->first('days') }}</span>
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                 <label for="timings">Timings</label><span style="color:red"> * </span>
                                                 <input name ="timings" type="text" class="form-control" id="timings" placeholder="Timing" value="{{ old('timings') }}" required="">
                                                 <span style="color:red">{{ $errors->first('timings') }}</span>
                                             </div>
                                        </div>

                                    </div>
                                    <div class="onemore" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="days">Day</label><span style="color:red"> * </span>
                                                  <input name ="days1" type="text" class="form-control" id="days1" placeholder="Day" value="{{ old('days') }}">
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                 <label for="timings">Timings</label><span style="color:red"> * </span>
                                                 <input name ="timings1" type="text" class="form-control" id="timings1" placeholder="Timing" value="{{ old('timings') }}">
                                             </div>
                                        </div>

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
<script>

$("#standard" ).change(function() 
  {
   
    var standard = $("#standard").val();
    var branch = $("#branch").val();
    var url = $('#url').val();
    var fromyear = $("#from_year").val();
    var toyear = $("#to_year").val();
    if (standard === 'VIII') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
        } 

    else if(standard==='IX') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })

            
        }
    else if(standard==='X'){

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
    }
    
  });

$("#admbatch" ).change(function() 
  {
   
    var admbatch = $("#admbatch").val();
    var standard = $("#standard").val();
    var branch= $("#branch").val();
    var fromyear = $("#from_year").val();
    var toyear = $("#to_year").val();

    var url = $('#url').val();

        $.get(url + '/ajax/admissionbatch/'+admbatch+'/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                     $('#timings').val(data.timings);
                     $('#days').val(data.day1);
                     if(data.day2exists==1)
                     {
                            $('.onemore').show();
                            $('#timings1').val(data.timings1);
                            $('#days1').val(data.day2);
                     }
                   
                })

          $.ajax({
            
            type: "GET",
            url: url + '/ajax/feecheck/' + standard + '/' +fromyear +'/' +toyear,
            success: function (data) 
            {
                $("#feecheck").val(data);
            },
            statusCode: 
            {
                401: function()
                { 
                    window.location.href =url+'/login';
                }
            },
            error: function (data) 
            {
                console.log('Error:', data);
            }
        });
  });

$("#addadmission").submit(function() {

    var from_year=$('#from_year').val();
    var to_year=$('#to_year').val();
    var my_val=parseInt(from_year)+1;
    if(my_val !=to_year)
    {
        alert('Please enter correct academic year...')
        return false;
    }
    var feeval=$("#feecheck").val();
    if(feeval!=null)
    {
        if(feeval === '0')
        {
            alert("Please add fee details for this academic year and standrad.");
            return false;
        } 
    
    }
});

$(document).ready(function()
{
    
    var standard = $("#standard").val();
    var branch = $("#branch").val();
    var fromyear = $("#from_year").val();
    var toyear = $("#to_year").val();
    var url = $('#url').val();

    if(standard!=null && branch!=null)
    {
    if (standard === 'VIII') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
        } 

    else if(standard==='IX') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })

            
        }
    else if(standard==='X'){

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                   
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
    }
    
}
    
});
</script>
@endsection
