@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/parentsmeet') }}">Parent Meet Details</a>
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
<input type="hidden"  value="{{$branch}}" id="branch"/>
<input type="hidden"  value="{{$fromyear}}" id="fromyear"/>
<input type="hidden"  value="{{$toyear}}" id="toyear"/>
<div class="card">
                            <form action="{{ url('/parentsmeet/create') }}" method="post" name="addparentsmeet" id="addparentsmeet">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New Parent Meet Details</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Academic Year : </label>
                                    <div class="col-md-10">
                                    {{$fromyear}} - {{$toyear}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Branch : </label>
                                    <div class="col-md-10">
                                    @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                        @if($code==$branch)
                                        {{$value}}
                                        @endif
                                    @endforeach
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="date_call">Date of Text/Call</label><span style="color:red"> *</span>
                                            <input name ="date_call" type="date" class="form-control" id="date_call"  placeholder="Date of Text/Call" value="{{ old('date_call') }}" size="1" required="">
                                            <span style="color:red">{{ $errors->first('date_call') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label><span style="color:red"> *</span>
                                    <select id="standard" name="standard" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            <option value="{{$code}}" @if (old('standard') == $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="batch">Batch</label><span style="color:red"> * </span>
                                        <select id="batch" name="batch" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        </select>
                                        <span style="color:red">{{ $errors->first('batch') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Students Name</label> <span style="color:red"> *</span>
                                        <input name ="name" type="text" class="form-control" id="name" placeholder="Student name" value="{{ old('name') }}" required="" pattern="[a-zA-Z\s]+">
                                        <span style="color:red">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="to_meet">To Meet</label> <span style="color:red"> *</span>
                                        <input name ="to_meet" type="text" class="form-control" id="to_meet" placeholder="To Meet" value="{{ old('to_meet') }}" required="" pattern="[a-zA-Z\s]+">
                                        <span style="color:red">{{ $errors->first('to_meet') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="date_meet">Date of Meet</label>
                                            <input name ="date_meet" type="date" class="form-control" id="date_meet"  placeholder="Date of Meet" value="{{ old('date_meet') }}" size="1">
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="timing">Timing</label>
                                            <input name ="timing" type="text" class="form-control" id="timing"  placeholder="Timing" value="{{ old('timing') }}">
                                        </div>   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <input name ="reason" type="text" class="form-control" id="reason" placeholder="Reason" value="{{ old('reason') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                        <input name ="remarks" type="text" class="form-control" id="remarks" placeholder="Remarks" value="{{ old('remarks') }}">
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
    var fromyear = $("#fromyear").val();
    
    var toyear = $("#toyear").val();
    if (standard === 'VIII') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    //success data
                    console.log(data);
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
        } 

    else if(standard==='IX') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    //success data
                    console.log(data);
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })

            
        }
    else if(standard==='X'){

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    //success data
                    console.log(data);
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
    }
    
  });


</script>
@endsection
