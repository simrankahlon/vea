@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/testscheduler') }}">Test Schedule</a>
            </li>
            <li class="breadcrumb-item active">Add</li>
</ol>
@endsection
@php
$branch=Session::get('branch');
$fromyear=Session::get('fromyear');
$toyear=Session::get('toyear');
@endphp
@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
<input type="hidden"  value="{{$fromyear}}" id="from_year"/>
<input type="hidden"  value="{{$toyear}}" id="to_year"/>
<input type="hidden"  value="{{$branch}}" id="branch"/>

@section('content')
<div class="card">
                            <form action="{{ url('/testscheduler/create') }}" method="post" name="addtestscheduler" id="addtestscheduler">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New Test Schedule</strong>
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
                                            <label for="ann_date">Announcement Date</label>
                                            <input name ="ann_date" type="date" class="form-control" id="ann_date"  placeholder="Announcement Date" value="{{ old('ann_date') }}">
                                            <span style="color:red">{{ $errors->first('ann_date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label>
                                    <select id="standard" name="standard" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            <option value="{{$code}}" @if (old('standard') == $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="batch">Batch</label>
                                        <select id="batch" name="batch" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        </select>
                                        <span style="color:red">{{ $errors->first('batch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="test_date">Test Date</label>
                                            <input name ="test_date" type="date" class="form-control" id="test_date"  placeholder="Test Date" value="{{ old('test_date') }}">
                                            <span style="color:red">{{ $errors->first('test_date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="portion">Portion (Set)</label> 
                                        <input name ="portion" type="text" class="form-control" id="portion" placeholder="Portion (Set)" value="{{ old('portion') }}">
                                        <span style="color:red">{{ $errors->first('portion') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="marks">Marks</label> 
                                        <input name ="marks" type="text" class="form-control" id="marks" placeholder="Marks" value="{{ old('marks') }}" pattern="[0-9]{1,3}">
                                        <span style="color:red">{{ $errors->first('marks') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="qp_ready">Question paper ready</label>
                                    <select id="qp_ready" name="qp_ready" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            <option value="{{$code}}" @if (old('qp_ready') === $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('qp_ready') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="xerox">Xerox ready</label>
                                    <select id="xerox" name="xerox" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            <option value="{{$code}}" @if (old('xerox') === $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('xerox') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="corr_done">Correction done by</label>
                                        <input name ="corr_done" type="text" class="form-control" id="corr_done" placeholder="Correction done by" value="{{ old('corr_done') }}" pattern="[a-zA-Z\s]+">
                                        <span style="color:red">{{ $errors->first('corr_done') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dis_date">Distribution Date</label>
                                            <input name ="dis_date" type="date" class="form-control" id="dis_date"  placeholder="Distribution Date" value="{{ old('dis_date') }}">
                                            <span style="color:red">{{ $errors->first('dis_date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="an_uploaded">Answer key uploaded</label>
                                    <select id="an_uploaded" name="an_uploaded" class="form-control" size="1" >
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            <option value="{{$code}}" @if (old('an_uploaded') === $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('an_uploaded') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="msg_sent">Msg sent</label>
                                    <select id="msg_sent" name="msg_sent" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            <option value="{{$code}}" @if (old('msg_sent') === $code) selected="selected" @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('msg_sent') }}</span>
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
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
        } 

    else if(standard==='IX') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })

            
        }
    else if(standard==='X'){

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
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
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
        } 

    else if(standard==='IX') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })

            
        }
    else if(standard==='X'){

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                   
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
    }
    
}


    
});
</script>
@endsection

