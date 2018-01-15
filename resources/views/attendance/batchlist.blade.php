@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Attendance</li>
        </ol>
@endsection

@section('content')
<div class="container-fluid">
<div id="ui-view" style="opacity: 1;">
<div class="animated fadeIn">
<div class="row">
<div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> VIII BATCH
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $standard="VIII";
                            @endphp
                            @foreach ($eight as $eight)
                            <tr>
                                <td> <a href="#">{{$eight->batchname }}</a>
                            </td>
                            <td> 
                                <div> 
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/attendance/'.$eight->id.'/'.$standard.'/newattendance') }}'">Add</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="window.location.href='{{ url('/attendance/'.$eight->id.'/'.$standard.'/listattendance') }}'">List</button>
                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href='{{ url('/attendance/'.$eight->id.'/'.$standard.'/summaryreport') }}'">Summary Report</button>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
<div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> IX BATCH
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $standard1="IX";
                            @endphp
                            @foreach ($ninth as $nine)
                            <tr>
                                <td> <a href="#">{{$nine->batchname }}</a></td>
                            <td> 
                                <div> 
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/attendance/'.$nine->id.'/'.$standard1.'/newattendance') }}'">Add</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="window.location.href='{{ url('/attendance/'.$nine->id.'/'.$standard1.'/listattendance') }}'">List</button>
                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href='{{ url('/attendance/'.$nine->id.'/'.$standard1.'/summaryreport') }}'">Summary Report</button>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> X BATCH
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $standard2="X";
                            @endphp
                            @foreach ($tenth as $ten)
                            <tr>
                                <td> 
                                    <a href="#">{{$ten->batchname }}</a>
                                </td>
                            <td> 
                                <div> 
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/attendance/'.$ten->id.'/'.$standard2.'/newattendance') }}'">Add</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="window.location.href='{{ url('/attendance/'.$ten->id.'/'.$standard2.'/listattendance') }}'">List</button>
                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href='{{ url('/attendance/'.$ten->id.'/'.$standard2.'/summaryreport') }}'">Summary Report</button>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>

@endsection
@section('javascriptfunctions')
<script>
</script>
@endsection

