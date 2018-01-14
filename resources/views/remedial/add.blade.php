@php
$branch=Session::get('branch');
$fromyear=Session::get('fromyear');
$toyear=Session::get('toyear');
@endphp
@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/'.$batch->id.'/'.$standard.'/listattendance') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">Remedial Attendance Details</li>
</ol>
@endsection

@section('content')
<div class="card">
                            <form action="{{ url('/remedial/'.$batch->id.'/'.$standard.'/newattendance') }}" method="post" name="addremedialattendance" id="addremedialattendance">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Remedial Attendance Details</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                    <label for="standard">Academic Year</label> : {{$fromyear}} - {{$toyear}}
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label> : 
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($branch==$code)
                                            {{$value}}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label> : {{$standard}}
                                    </div>
                                    <div class="form-group">
                                        <label for="batch">Batch</label> : {{$batch->batchname}} 
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="date">Date of Attendance</label><span style="color:red"> *</span>
                                            <input name ="date" type="date" class="form-control" id="date"  placeholder="Date" value="{{ old('date') }}" size="1" required="">
                                            <span style="color:red">{{ $errors->first('date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="topic">Topic Taken</label> <span style="color:red"> *</span>
                                        <input name ="topic" type="text" class="form-control" id="topic" placeholder="Topic Taken" value="{{ old('topic') }}" required="">
                                        <span style="color:red">{{ $errors->first('topic') }}</span>
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
@endsection
