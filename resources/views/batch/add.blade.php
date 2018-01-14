@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/batch') }}">Batch</a>
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
<div class="card">
                            <form action="{{ url('/batch/create') }}" method="post" name="addbatch" id="addbatch">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New Batch</strong>
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
                                        <label for="bname">Batch Name</label> <span style="color:red"> *</span>
                                        <input name ="bname" type="text" class="form-control" id="bname" placeholder="Batch name" value="{{ old('bname') }}" required="">
                                        <span style="color:red">{{ $errors->first('bname') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-1 form-control-label">Days <span style="color:red"> *</span></label> 
                                        <div class="col-md-11">
                                            <div class="checkbox">
                                            @foreach($days as $day)
                                            <label for="checkbox-{{$day->id}}">
                                                <input type="checkbox" class="cb" id="checkbox-{{$day->id}}" name="days[]" value="{{$day->id}}" {{ (collect(old('days'))->contains($day->id)) ? 'selected':'' }}> {{$day->days}}
                                            </label>
                                            </br>
                                            @endforeach
                                            </div>
                                        </div>
                                        <span style="color:red">{{ $errors->first('days') }}</span>
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-sm-1">
                                        <div><strong>Day 1</strong></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="from">Timing From</label><span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="from" name="from" placeholder="Timings from" value="{{ old('from') }}" required="">
                                             <span style="color:red">{{ $errors->first('from') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="to">Timing till</label>
                                            <span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="to" name="to"placeholder="Timings till" value="{{ old('to') }}" required="">
                                             <span style="color:red">{{ $errors->first('to') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-5">
                                    </div>
                                    </div>

                                    <div id="onemore" style="display:none;">
                                    <div class="form-group row">
                                    <div class="col-sm-1">
                                        <div><strong>Day 2</strong></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="from">Timing From</label><span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="from1" name="from1" placeholder="Timings from" value="{{ old('from1') }}">
                                             <span style="color:red">{{ $errors->first('from1') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="to">Timing till</label>
                                            <span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="to1" name="to1"placeholder="Timings till" value="{{ old('to1') }}">
                                             <span style="color:red">{{ $errors->first('to1') }}</span>
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
$('.cb').click(function () {
   var check = $('#addbatch').find('input[type=checkbox]:checked').length;
   if(check==2)
   {
        $('#onemore').show();
   }
   else
   {
        $('#onemore').hide();
   }
});

$("#addbatch").submit(function(){

    var check = $('#addbatch').find('input[type=checkbox]:checked').length;
    var start=$('#from1').val();
    var end=$('#to1').val();
    
    if(check==2)
    {
       
        if(start=="" || end=="")
        {
            alert('Please enter the timings.');
            return false;
        }
    }
   
});
</script>
@endsection
