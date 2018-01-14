@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
           <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/batch/'.$batch_id.'/'.$admission->standard.'/admission') }}">{{ $admission->standard }} - {{ $admission->admissionbatch}}</a></li>
            <li class="breadcrumb-item active">{{$admission->studentname}}</li>
            <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')
@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
<div class="card">
                            <form action="{{ url('/admission/'.$admission->id.'/edit') }}" method="post" name="addadmission" id="addadmission">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Edit Admission</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                    <label for="year">Academic Year</label><span style="color:red"> *</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{$admission->fromyear}}">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{$admission->toyear}}">
                                            <span style="color:red">{{ $errors->first('to_year') }}</span>
                                        </div>
                                        <div class="col-md-8">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label><span style="color:red"> * </span>
                                    <select id="branch" name="branch" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($admission->branch == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('branch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Date</label><span style="color:red"> *</span>
                                            <input name ="date" type="date" class="form-control" id="date"  placeholder="Date" value="{{$admission->date}}" size="1">
                                            <span style="color:red">{{ $errors->first('date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-9">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label> <span style="color:red"> *</span>
                                        <input name ="name" type="text" class="form-control" id="name" placeholder="Enquirer name" value="{{ $admission->studentname }}">
                                        <span style="color:red">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label><span style="color:red"> * </span>
                                        <textarea name ="address" class="form-control" id="address" placeholder="Address">{{ $admission->address }}</textarea>
                                        <span style="color:red">{{ $errors->first('address') }}</span>
                                    </div> 
                                    <div class="form-group">
                                    <label for="school">School</label> <span style="color:red"> *</span>
                                    <select id="school" name="school" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                                            @if($admission->school == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('school') }}</span>
                                    </div>
                                    <div class="form-group" style="display: none;" id="other">
                                        <label for="otherschool">School Name</label> <span style="color:red"> *</span>
                                        <input name ="otherschool" type="text" class="form-control" id="otherschool" placeholder="School name" value="{{ $admission->otherschool }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fatherno">Father's Number</label> 
                                        <input name ="fatherno" type="tel" class="form-control" id="fatherno" placeholder="Father's Number" value="{{ $admission->fatherno }}">
                                        <span style="color:red">{{ $errors->first('fatherno') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="motherno">Mother's Number</label>
                                        <input name ="motherno" type="tel" class="form-control" id="motherno" placeholder="Mother's Number" value="{{ $admission->motherno }}">
                                        <span style="color:red">{{ $errors->first('motherno') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Whatsapp Text on</label><span style="color:red"> * </span>
                                    <select id="whatsapptext" name="whatsapptext" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Whatsappon::all() as $value => $code)
                                            @if($admission->whatsappon == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('whatsapptext') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="landline">Landline</label>
                                        <input name ="landline" type="tel" class="form-control" id="landline" placeholder="Landline" value="{{ $admission->landline }}">
                                        <span style="color:red">{{ $errors->first('landline') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email ID</label>
                                        <input name ="email" type="email" class="form-control" id="email" placeholder="Email ID" value="{{ $admission->email }}">
                                        <span style="color:red">{{ $errors->first('email') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label><span style="color:red"> *</span>
                                    <select id="standard" name="standard" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            @if($admission->standard == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>
                                   <div class="form-group">
                                        <label for="admbatch">Admission for Batch</label><span style="color:red"> * </span>
                                        <select id="admbatch" name="admbatch" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach($batch as $bat)
                                            @if($admission->admissionbatch == $bat->batchname)
                                                <option value="{{$bat->batchname}}" selected>{{$bat->batchname}}</option>
                                            @else
                                                <option value="{{$bat->batchname}}">{{$bat->batchname}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->first('admbatch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="days">Day</label><span style="color:red"> * </span>
                                                  <input name ="days" type="text" class="form-control" id="days" placeholder="Day" value="{{ $admission->day1 }}" required="">
                                                  <span style="color:red">{{ $errors->first('days') }}</span>
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                 <label for="timings">Timings</label><span style="color:red"> * </span>
                                                 <input name ="timings" type="text" class="form-control" id="timings" placeholder="Timing" value="{{ $admission->timing1 }}" required="">
                                                 <span style="color:red">{{ $errors->first('timings') }}</span>
                                             </div>
                                        </div>

                                    </div>
                                    <div class="onemore" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="days">Day</label><span style="color:red"> * </span>
                                                  <input name ="days1" type="text" class="form-control" id="days1" placeholder="Day" value="{{ $admission->day2 }}">
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                 <label for="timings">Timings</label><span style="color:red"> * </span>
                                                 <input name ="timings1" type="text" class="form-control" id="timings1" placeholder="Timing" value="{{ $admission->timing2 }}">
                                             </div>
                                        </div>

                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pname">Parent's Name</label>
                                        <input name ="pname" type="text" class="form-control" id="pname" placeholder="Parent's Name" value="{{ $admission->parentname }}">
                                        <span style="color:red">{{ $errors->first('pname') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <input name ="occupation" type="text" class="form-control" id="occupation" placeholder="Occupation" value="{{ $admission->occupation }}">
                                        <span style="color:red">{{ $errors->first('occupation') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="oaddress">Office Address</label>
                                        <textarea name ="oaddress" class="form-control" id="oaddress" placeholder="Office Address">{{$admission->officeaddress}}</textarea>
                                        <span style="color:red">{{ $errors->first('oaddress') }}</span>
                                    </div> 
                                    <div class="form-group">
                                        <label for="onumber">Office Number</label>
                                        <input name ="onumber" type="tel" class="form-control" id="onumber" placeholder="Office Number" value="{{ $admission->officenumber }}">
                                        <span style="color:red">{{ $errors->first('onumber') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="lasttermpercent">Last Term Exam %</label>
                                        <input name ="lasttermpercent" type="text" class="form-control" id="lasttermpercent" placeholder="Last Term Exam %" value="{{ $admission->lasttermpercent }}">
                                        <span style="color:red">{{ $errors->first('lasttermpercent') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="english1">English I</label>
                                        <input name ="english1" type="text" class="form-control" id="english1" placeholder="English I" value="{{ $admission->english1 }}">
                                        <span style="color:red">{{ $errors->first('english1') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="english2">English II</label>
                                        <input name ="english2" type="text" class="form-control" id="english2" placeholder="English II" value="{{ $admission->english2 }}">
                                        <span style="color:red">{{ $errors->first('english2') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="overallpercent">Overall %</label>
                                        <input name ="overallpercent" type="text" class="form-control" id="overallpercent" placeholder="Overall %" value="{{ $admission->overallpercent }}">
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
$( document ).ready(function() {

    var school = $('#school').val();
    if (school === 'OTHERS') {
           $('#other').show();
        } else {
            $('#other').hide();
        }

});
$("#school" ).change(function() 
  {
   
    var school = $("#school").val();
    if (school === 'OTHERS') {
         
           $('#other').show();
        } else {

            $('#other').hide();
        }
    
  });
$("#addadmission").submit(function() {

  var fatherno=$('#fatherno').val();
  var motherno=$('#motherno').val();
  var landline=$('#landline').val();
  
  if(fatherno=="" & motherno=="" & landline=="")
  {
    alert("Please enter atlease one number.");
    return false;
  }
});

$("#standard" ).change(function() 
  {
   
    var standard = $("#standard").val();
    var branch = $("#branch").val();
    var url = $('#url').val();
    if (standard === 'VIII') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch, function (data) {
                    //success data
                    console.log(data);
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
        } 

    else if(standard==='IX') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch, function (data) {
                    //success data
                    console.log(data);
                    $('#admbatch').empty();
                    $("#admbatch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#admbatch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })

            
        }
    else if(standard==='X'){

        $.get(url + '/ajax/admission/'+standard+'/'+branch, function (data) {
                    //success data
                    console.log(data);
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

    var url = $('#url').val();

        $.get(url + '/ajax/admissionbatch/'+admbatch+'/'+standard+'/'+branch, function (data) {
                    //success data
                    console.log(data);
                     $('#timings').val(data.timings);
                     $('#days').val(data.day1);
                     if(data.day2exists==1)
                     {
                            $('.onemore').show();
                            $('#timings1').val(data.timings1);
                            $('#days1').val(data.day2);
                     }
                   
                })
         
  });
</script>
@endsection
