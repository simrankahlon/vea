@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/attendance/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/attendance/'.$batch->id.'/'.$standard.'/listattendance') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{ date('d-m-Y', strtotime($attendances->date)) }}</li>
            <li class="breadcrumb-item active">Edit Attendance details</li>
</ol>
@endsection

@section('content')
<div class="card">
                            <form action="{{ url('/attendance/'.$attendances->id.'/'.$batch->id.'/'.$standard.'/editattendance') }}" method="post" name="editattedance" id="editattedance">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Edit Attendance Details</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                    <label for="standard">Academic Year</label> : {{$attendances->fromyear}} - {{ $attendances->toyear}}
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label> : 
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($attendances->branch==$code)
                                            {{$value}}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label> : {{$attendances->standard}}
                                    </div>
                                    <div class="form-group">
                                        <label for="batch">Batch</label> : {{$attendances->batch}} 
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Date of Attendance</label><span style="color:red"> *</span>
                                            <input name ="date" type="date" class="form-control" id="date"  placeholder="Date" value="{{ $attendances->date }}" size="1">
                                            <span style="color:red">{{ $errors->first('date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-9">     
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
@endsection
