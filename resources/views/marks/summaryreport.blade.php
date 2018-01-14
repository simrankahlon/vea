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
            <li class="breadcrumb-item"><a href="{{ url('/marks/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/marks/'.$batch->id.'/'.$standard.'/listmarks') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">Summary Marks Report</li>
</ol>
@endsection
@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
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
                            <th>RL</th>
                            <th>Name</th>
                            @foreach($marks as $mark)
                            <th>
                                <table style="table-layout:fixed;width: 200px;height: 100px;font-family: Calibri;font-size: 95%;font-style: regular">
                                    <thead>
                                        <tr>
                                            <th>Topic : {{$mark->topic_name}}</th>
                                        </tr>
                                        <tr>
                                            <th>Date: {{ date('d-m-Y', strtotime($mark->date)) }}</th>
                                        </tr>
                                        <tr>
                                            <th>Total marks: {{$mark->total_marks}}</th>
                                        </tr>
                                        <tr>
                                            <th>Passing marks: {{$mark->passing_marks}}</th>
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
                                                        <div class="checkbox">
                                                            <label for="checkbox1">
                                                                @if($adm->remedial_list==1)
                                                                    <input type="checkbox" id="remedial_list" name="remedial_list" class="remedial_list" value="{{$adm->id}}" checked>
                                                                @else
                                                                    <input type="checkbox" id="remedial_list" name="remedial_list" class="remedial_list" value="{{$adm->id}}">
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>{{$adm->studentname}}</div>
                                                    </td>
                                                        @foreach($marks as $mark)
                                                            @php
                                                                $found=0;
                                                            @endphp
                                                            @foreach($adm->marks as $ad)
                                                                @if($ad->pivot->mark_id==$mark->id)
                                                                    @if($ad->pivot->marks_obtained!="")
                                                                    <td>
                                                                        <div>
                                                                            @if($ad->pivot->marks_obtained < $mark->passing_marks)
                                                                                <strong style="color:red;">{{$ad->pivot->marks_obtained}}</strong>
                                                                            @else
                                                                                <strong>{{$ad->pivot->marks_obtained}}</strong>
                                                                            @endif
                                                                            @php
                                                                                $found=1;
                                                                            @endphp
                                                                        </div>
                                                                    </td>
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

@section('javascriptfunctions')
<script>
$(document).ready(function()
{
        var url = $('#url').val();    
            
            $(".remedial_list").on('click',function()
            { 
               
                var admission_id = $(this).val();
                
                var check=0;
                if($(this).is(':checked'))
                {
                    check=1;
                }
                $.ajax
                ({
                    type: "GET",
                    url: url + '/ajax/remedial_list/' + admission_id + '/'+check,
                    success: function (data) 
                    {
                        
                    },
                    statusCode: 
                    {
                        401: function()
                        { 
                            window.location.href =url+'/login';
                        }
                    },
                    error: function (data) 
                    {
                        console.log('Error:', data);
                    }
                });
            });

});
</script>
@endsection
