@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Export</li>
</ol>
@endsection
@php
$branch=Session::get('branch');
$fromyear=Session::get('fromyear');
$toyear=Session::get('toyear');
@endphp

@section('content')
<div class="card">
                            <form action="{{ url('/export/create') }}" method="post" name="export" id="export">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Export</strong>
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
                                        <div class="col-md-1">
                                            <label for="Month">Month : </label><span style="color:red"> *</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="month" id="month" name="month" required="" 
                                            value="{{ old('month') }}" class="form-control">
                                        </div>
                                            <span style="color:red">{{ $errors->first('month') }}</span>
                                        </div>
                                        <div class="col-md-9">     
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="save" class="btn btn-primary">Export</button>
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
                            </div>
                            </form>
                        </div>
@endsection

