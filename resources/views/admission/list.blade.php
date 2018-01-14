@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/batch/'.$batch.'/'.$admission->standard.'/admission') }}">{{ $admission->standard }} - {{ $admission->admissionbatch}}</a></li>
            <li class="breadcrumb-item active">{{$admission->studentname}}</li>
</ol>
@endsection

@section('content')
<div class="card">
                            <div class="card-header">
                                <strong>Admission Details</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Branch : </label>
                                    <div class="col-md-9">
                                    {{$admission->branch}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Date : </label>
                                    <div class="col-md-9">
                                    {{$admission->date}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Student Name : </label>
                                    <div class="col-md-9">
                                    {{$admission->studentname}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Address : </label>
                                    <div class="col-md-9">
                                    {{$admission->address}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Father's No : </label>
                                    <div class="col-md-9">
                                    {{$admission->fatherno}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Mother's No : </label>
                                    <div class="col-md-9">
                                    {{$admission->motherno}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Whatsapp Text on : </label>
                                    @foreach(App\Http\AcatUtilities\Whatsappon::all() as $value => $code)
                                          @if($admission->whatsappon == $code)
                                                <div class="col-md-9">
                                                      {{$value}}
                                                </div>
                                          @endif
                                    @endforeach
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Landline : </label>
                                    <div class="col-md-9">
                                    {{$admission->landline}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Email ID : </label>
                                    <div class="col-md-9">
                                    {{$admission->email}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Standard : </label>
                                    <div class="col-md-9">
                                    {{$admission->standard}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Admission for Batch : </label>
                                    <div class="col-md-9">
                                    {{$admission->admissionbatch}}
                                    </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Day : </label>
                                    <div class="col-md-3">
                                    {{$admission->day1}}
                                    </div>
                                    <label class="col-md-3 form-control-label" for="hf-email">Timings : </label>
                                    <div class="col-md-3">
                                    {{$admission->timing1}}
                                    </div>
                                    </div>
                                    @if($admission->day2!="")
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Day : </label>
                                    <div class="col-md-3">
                                    {{$admission->day2}}
                                    </div>
                                    <label class="col-md-3 form-control-label" for="hf-email">Timings : </label>
                                    <div class="col-md-3">
                                    {{$admission->timing2}}
                                    </div>
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                    
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Parent's Name : </label>
                                    <div class="col-md-9">
                                    {{$admission->parentname}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Occupation : </label>
                                    <div class="col-md-9">
                                    {{$admission->occupation}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Office Address : </label>
                                    <div class="col-md-9">
                                    {{$admission->officeaddress}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Office Number : </label>
                                    <div class="col-md-9">
                                    {{$admission->officenumber}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Last Term Exam % : </label>
                                    <div class="col-md-9">
                                    {{$admission->lasttermpercent}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">English I : </label>
                                    <div class="col-md-9">
                                    {{$admission->english1}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">English II : </label>
                                    <div class="col-md-9">
                                    {{$admission->english2}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Overall % : </label>
                                    <div class="col-md-9">
                                    {{$admission->overallpercent}}
                                    </div>
                                    </div>
                                    @if($admission->remedial_list==1)
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Remedial Branch : </label>
                                    <div class="col-md-9">
                                    {{$admission->remedialbranch}}
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">Remedial Batch : </label>
                                    <div class="col-md-9">
                                    {{$admission->remedialbatch}}
                                    </div>
                                    </div>
                                    @endif
                            </div>
</div>
@endsection


