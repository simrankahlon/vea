@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a>
            </li>
            <li class="breadcrumb-item active"><a href="{{ url('/batch/'.$batch_id.'/'.$admission->standard.'/admission') }}">{{ $admission->standard }} - {{ $admission->admissionbatch}}</a></li>
            <li class="breadcrumb-item"><a href="#">{{$admission->studentname}}</a></li>
            <li class="breadcrumb-item"><a href="#">Remedial Batch Details</a></li>
</ol>
@endsection
@php
$fromyear=Session::get('fromyear');
$toyear=Session::get('toyear');
$url= url("/");
$standard=$admission->standard;
@endphp

@section('content')
<input type="hidden"  value="{{$url}}" id="url"/>
<input type="hidden"  value="{{$fromyear}}" id="fromyear"/>
<input type="hidden"  value="{{$toyear}}" id="toyear"/>
<input type="hidden"  value="{{$standard}}" id="standard"/>
<div class="card">
                            <form action="{{ url('/admission/'.$admission->id.'/remedialdetails') }}" method="post" name="remedialdetails" id="remedialdetails">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New Admission</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="hf-email">Academic Year : </label>
                                    <div class="col-md-10">
                                    {{$fromyear}} - {{$toyear}}
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label><span style="color:red"> * </span>
                                    <select id="branch" name="branch" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($admission->remedialbranch!=null)
                                                @if($admission->remedialbranch==$code)
                                                    <option value="{{$code}}" selected="">{{$value}}</option>
                                                @else
                                                     <option value="{{$code}}">{{$value}}</option>
                                                @endif
                                            @else
                                            <option value="{{$code}}" @if (old('branch') == $code) selected="selected" @endif>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('branch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Standard : </label>
                                    <div class="col-md-10">
                                    @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                        @if($code==$admission->standard)
                                        {{$value}}
                                        @endif
                                    @endforeach
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="batch">Remedial Batch</label><span style="color:red"> * </span>
                                        <select id="batch" name="batch" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @if($admission->remedialbatch!=null)
                                            @foreach($batch as $bat)
                                                @if($admission->remedialbatch==$bat->batchname)
                                                    <option value="{{$bat->batchname}}" selected="">{{$bat->batchname}}</option>
                                                @else
                                                    <option value="{{$bat->batchname}}">{{$bat->batchname}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        </select>
                                        <span style="color:red">{{ $errors->first('batch') }}</span>
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
$("#branch" ).change(function() 
  {
   
    var standard = $("#standard").val();
    var branch = $("#branch").val();
    var url = $('#url').val();
    var fromyear = $("#fromyear").val();
    var toyear = $("#toyear").val();
   

        $.get(url + '/ajax/admissionremedial/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
    
  });


</script>
@endsection


