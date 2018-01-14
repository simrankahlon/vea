@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/attendance/'.$branch.'/create') }}">{{$branch}} - Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/attendance/'.$branch.'/'.$batch->id.'/'.$standard.'/listattendance') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">View Report</li>
</ol>
@endsection

@section('content')

@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
<div class="card">
                            <form action="{{ url('/attendance/'.$branch.'/'.$batch->id.'/'.$standard.'/summaryreport') }}" method="post" name="attendancereport" id="attendancereport">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>View Report </strong>
                            </div>
                            <div class="card-block">
                                    
                                    
                                    <div class="form-group row">
                                        <div class="col-md-1">
                                            <label for="year">From</label><span style="color:red"> *</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date" name="from_year"  class="form-control" id="from_year" value="{{$current}}" required="">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="year">To</label><span style="color:red"> *</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date" name="to_year" id="to_year" class="form-control" value="{{$next}}" required="">
                                            <span style="color:red">{{ $errors->first('to_year') }}</span>
                                        </div>
                                        <div class="col-md-6">     
                                        </div>
                                    
                                    
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="save" class="btn btn-primary">View Report</button>
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
                            </div>
                            </form>
                        </div>
@endsection

@section('javascriptfunctions')
@endsection
