@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a>
            </li>
            <li class="breadcrumb-item active">Add</li>
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
<input type="hidden"  value="1" id="feecheck" class="feecheck"/>

<div class="card">
                            <form action="{{ url('/admission/create') }}" method="post" name="addadmission" id="addadmission">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New Admission</strong>
                            </div>
                            <input type="hidden"  value="{{$check}}" id="enquirycheck" name="enquirycheck"/>
                            @if($check==2)
                                <input type="hidden"  value="{{$enquiry->id}}" id="enquiryid" name="enquiryid"/>
                            @endif
                            <div class="card-block">
                                    <div class="form-group">
                                    <label for="year">Academic Year</label><span style="color:red"> *</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{$fromyear}}" required="">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{$toyear}}" required="">
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
                                        <label for="name">Name</label> <span style="color:red"> *</span>
                                        @if($check==2)
                                        <input name ="name" type="text" class="form-control" id="name" placeholder="Student name" value="{{$enquiry->name}}" required="" pattern="[A-Z a-z\s]{3,}">
                                        @else
                                        <input name ="name" type="text" class="form-control" id="name" placeholder="Student name" value="{{ old('name') }}" required="" pattern="[A-Z a-z\s]{3,}">
                                        @endif
                                        <span style="color:red">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label><span style="color:red"> * </span>
                                        <textarea name ="address" class="form-control" id="address" placeholder="Address" required="">{{old('address')}}</textarea>
                                        <span style="color:red">{{ $errors->first('address') }}</span>
                                    </div> 
                                    <div class="form-group">
                                    <label for="school">School</label> <span style="color:red"> *</span>
                                    @if($check==2)
                                    <select id="school" name="school" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                                                @if($enquiry->school==$code)
                                                <option value="{{$code}}" selected="selected">{{$value}}</option>
                                                @else
                                                <option value="{{$code}}" @if (old('school') == $code) selected="selected" @endif>{{$value}}</option>
                                                @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <select id="school" name="school" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                                                <option value="{{$code}}" @if (old('school') == $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <span style="color:red">{{ $errors->first('school') }}</span>
                                    </div>
                                    @if($check==2)
                                        @if($enquiry->school=='OTHERS')
                                        <div class="form-group" id="other">
                                            <label for="otherschool">School Name</label> <span style="color:red"> *</span>
                                            <input name ="otherschool" type="text" class="form-control" id="otherschool" placeholder="School name" value="{{ $enquiry->otherschool }}">
                                        </div>
                                        @endif
                                    @else
                                    <div class="form-group" style="display: none;" id="other">
                                        <label for="otherschool">School Name</label> <span style="color:red"> *</span>
                                        <input name ="otherschool" type="text" class="form-control" id="otherschool" placeholder="School name" value="{{ old('otherschool') }}">
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="fatherno">Father's Number</label>
                                        @if($check==2)
                                        <input name ="fatherno" type="tel" class="form-control" id="fatherno" placeholder="Father's Number" value="{{ $enquiry->fatherno }}" pattern="[789][0-9]{9}">
                                        @else
                                        <input name ="fatherno" type="tel" class="form-control" id="fatherno" placeholder="Father's Number" value="{{ old('fatherno') }}" pattern="[789][0-9]{9}">
                                        @endif
                                        <span style="color:red">{{ $errors->first('fatherno') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="motherno">Mother's Number</label>
                                        @if($check==2)
                                        <input name ="motherno" type="tel" class="form-control" id="motherno" placeholder="Mother's Number" value="{{ $enquiry->motherno }}" pattern="[789][0-9]{9}">
                                        @else
                                        <input name ="motherno" type="tel" class="form-control" id="motherno" placeholder="Mother's Number" value="{{ old('motherno') }}" pattern="[789][0-9]{9}">
                                        @endif
                                        <span style="color:red">{{ $errors->first('motherno') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Whatsapp Text on</label><span style="color:red"> * </span>
                                    <select id="whatsapptext" name="whatsapptext" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Whatsappon::all() as $value => $code)
                                            <option value="{{$code}}" @if (old('whatsapptext') == $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('whatsapptext') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="landline">Landline</label>
                                        @if($check==2)
                                        <input name ="landline" type="tel" class="form-control" id="landline" placeholder="Landline" value="{{ $enquiry->landline }}" pattern="[0-9]{8}">
                                        @else
                                        <input name ="landline" type="tel" class="form-control" id="landline" placeholder="Landline" value="{{ old('landline') }}" pattern="[0-9]{8}">
                                        @endif
                                        <span style="color:red">{{ $errors->first('landline') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email ID</label>
                                        <input name ="email" type="email" class="form-control" id="email" placeholder="Email ID" value="{{ old('email') }}">
                                        <span style="color:red">{{ $errors->first('email') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label><span style="color:red"> *</span>
                                    @if($check==2)
                                    <select id="standard" name="standard" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            @if($enquiry->standard==$code)
                                            <option value="{{$code}}" selected="selected">{{$value}}</option>
                                            @else
                                            <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <select id="standard" name="standard" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            <option value="{{$code}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @endif
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
                                    
                                    <div class="form-group">
                                        <label for="pname">Parent's Name</label>
                                        <input name ="pname" type="text" class="form-control" id="pname" placeholder="Parent's Name" value="{{ old('pname') }}" pattern="[a-zA-Z\s]+">
                                        <span style="color:red">{{ $errors->first('pname') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <input name ="occupation" type="text" class="form-control" id="occupation" placeholder="Occupation" value="{{ old('occupation') }}">
                                        <span style="color:red">{{ $errors->first('occupation') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="oaddress">Office Address</label>
                                        <textarea name ="oaddress" class="form-control" id="oaddress" placeholder="Office Address">{{old('oaddress')}}</textarea>
                                        <span style="color:red">{{ $errors->first('oaddress') }}</span>
                                    </div> 
                                    <div class="form-group">
                                        <label for="onumber">Office Number</label>
                                        <input name ="onumber" type="tel" class="form-control" id="onumber" placeholder="Office Number" value="{{ old('onumber') }}" pattern="[0-9]{8}">
                                        <span style="color:red">{{ $errors->first('onumber') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="lasttermpercent">Last Term Exam %</label>
                                        <input name ="lasttermpercent" type="text" class="form-control" id="lasttermpercent" placeholder="Last Term Exam %" value="{{ old('lasttermpercent') }}" pattern="[0-9]+(\.[0-9]{0,2})?%?">
                                        <span style="color:red">{{ $errors->first('lasttermpercent') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="english1">English I</label>
                                        <input name ="english1" type="text" class="form-control" id="english1" placeholder="English I" value="{{ old('english1') }}" pattern="[0-9]+(\.[0-9]{0,2})?%?">
                                        <span style="color:red">{{ $errors->first('english1') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="english2">English II</label>
                                        <input name ="english2" type="text" class="form-control" id="english2" placeholder="English II" value="{{ old('english2') }}" pattern="[0-9]+(\.[0-9]{0,2})?%?">
                                        <span style="color:red">{{ $errors->first('english2') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="overallpercent">Overall %</label>
                                        <input name ="overallpercent" type="text" class="form-control" id="overallpercent" placeholder="Overall %" value="{{ old('overallpercent') }}" pattern="[0-9]+(\.[0-9]{0,2})?%?">
                                        <span style="color:red">{{ $errors->first('overallpercent') }}</span>
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
$("#school" ).change(function() 
  {
   
    var school = $("#school").val();
    if (school === 'OTHERS') {
         
           $('#other').show();
        } else {

            $('#other').hide();
        }
    
  });

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

  var fatherno=$('#fatherno').val();
  var motherno=$('#motherno').val();
  
  var texton=$('#whatsapptext').val();

  if(texton=="MCELL" & motherno=="")
  {
      alert("Please enter mother's number.");
      return false;
  }
  else if(texton=="FCELL" & fatherno=="")
  {
      alert("Please enter father's number.");
      return false;
  }

    var from_year=$('#from_year').val();
    var to_year=$('#to_year').val();
    var my_val=parseInt(from_year)+1;
    if(my_val !=to_year)
    {
        alert('Please enter correct academic year...')
        return false;
    }
    var school = $("#school").val();
    var school1=$("#otherschool").val();
    if (school === 'OTHERS' && school1=="") 
    {
        alert("Please enter School name.");
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
    var url = $('#url').val();
    var fromyear = $("#from_year").val();
    var toyear = $("#to_year").val();

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
