@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">Admission</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/admission/create') }}"><i class="icon-plus"></i> &nbsp;Create Admission </a>
                </div>
            </li>
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
                                <th>Batch Names</th>
                                <th>Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $standard="VIII";
                            @endphp
                            @foreach ($eight as $eight)
                            <tr>
                                <td> <a href="{{ url('/batch/'.$eight->id.'/'.$standard.'/admission') }}">{{$eight->batchname }}</a></td>
                            <td>
                                <strong>{{$eight->updated_at->diffForHumans()}}</strong>
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
                                <th>Batch Names</th>
                                <th>Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $standard1="IX";
                            @endphp
                            @foreach ($ninth as $nine)
                            <tr>
                                <td> <a href="{{ url('/batch/'.$nine->id.'/'.$standard1.'/admission') }}">{{$nine->batchname }}</a></td>
                            <td>
                                <strong>{{$nine->updated_at->diffForHumans()}}</strong>
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
                                <th>Batch Names</th>
                                <th>Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $standard2="X";
                            @endphp
                            @foreach ($tenth as $ten)
                            <tr>
                                <td> <a href="{{ url('/batch/'.$ten->id.'/'.$standard2.'/admission') }}">{{$ten->batchname }}</a></td>
                            <td>
                                <strong>{{$ten->updated_at->diffForHumans()}}</strong>
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


