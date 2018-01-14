@extends('layouts.app')
<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/'.$batch->id.'/'.$standard.'/listattendance') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">Summary Attendance Report</li>
</ol>
@endsection
@section('content')
@php
$found=0;
@endphp
<div class="row">                       
        <div class="card">
            <div style="overflow-x:auto;">
                <table class="table table-hover table-outline mb-0 hidden-sm-down">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    @foreach($attendances as $att)
                                                        <th>
                                                            <table style="table-layout:fixed;width: 200px;height: 100px;font-family: Calibri;font-size: 95%;font-style: regular">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date: {{ date('d-m-Y', strtotime($att->date)) }}</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Topic: {{$att->topic_taken}}</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </th>
                                                    @endforeach
                                                    </tr>
                                            </thead>
                                            <tbody>
                                             @foreach ($admission as $adm)
                                                <tr>
                                                    <td>
                                                        <div>{{$adm->studentname}}</div>
                                                    </td>
                                                        @foreach($attendances as $att)
                                                            @foreach($adm->remedialattendances as $ad)
                                                                @if($ad->pivot->remedialatt_id==$att->id)
                                                                    @if($ad->pivot->attendance!="")
                                                                    <td>
                                                                        <div>
                                                                            @if($ad->pivot->attendance=='PRESENT')
                                                                                <strong style="color:green">P</strong>
                                                                            @elseif($ad->pivot->attendance=='ABSENT')
                                                                                <strong style="color:red">A</strong>
                                                                            @elseif($ad->pivot->attendance=='LATE')
                                                                                <strong style="color:yellow">L</strong>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                        @php
                                                                            $found=1;
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @if($found==0)
                                                                <td><strong> - </strong></td>
                                                            @endif
                                                        @endforeach
                                                </tr>
                                            @endforeach
                                            </tbody>
                                </table>
                                
           
        </div>
    </div>   
</div>  
@endsection
