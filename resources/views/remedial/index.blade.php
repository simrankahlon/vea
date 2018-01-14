@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item active">{{$standard}} - {{$batch->batchname}}</li>
            <li class="breadcrumb-item active">Attendance</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/remedial/'.$batch->id.'/'.$standard.'/newattendance') }}"><i class="icon-plus"></i> &nbsp;Create Remedial Attendance</a>
                </div>
            </li>
</ol>
@endsection
@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-xs-6">
            </div>
            <div class="col-xs-5">
                @php
                    $search = (isset($_GET['searchtxt'])) ? htmlentities($_GET['searchtxt']) : '';
                @endphp
                <form action="{{ url('/remedial/'.$batch->id.'/'.$standard.'/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                  
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Attendance Details" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
                    </div>
                    <button type="submit"  form="frmserch" class="btn btn-primary right" style="margin-left:-15px;height:35px;width:65px;">Go</button>  
                </form>
            </div>
        </div><!--END DIV ROW-->
    </div><!--END CARD-BLOCK-->
@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>

<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>Academic Year</th>
                                                    <th>Date of Attendance</th>
                                                    <th>Topic Taken</th>
                                                    <th>Activity</th>
                                                    <th>Action</th>
                                                    <th><div class="float-xs-right">Student Attendance</div></th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($attendance as $att)
                                                <tr>
                                                    <td>
                                                        <div>{{$att->fromyear }}-{{ $att->toyear}}</div>
                                                    </td>
                                                    <td>
                                                    <div>{{ date('d-m-Y', strtotime($att->date)) }}</div>
                                                    </td>
                                                    
                                                    <td>
                                                        <div>{{$att->topic_taken }}</div>
                                                    </td>
                                                    
                                                    <td>
                                                        <strong>{{$att->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/remedial/'.$att->id.'/'.$batch->id.'/'.$standard.'/editattendance') }}'">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/remedial/'.$att->id.'/'.$batch->id.'/'.$standard.'/deleteattendance') }}')">Delete</button>
                                                    </div>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/remedial/'.$att->id.'/'.$batch->id.'/'.$standard.'/addstudentattendance') }}'">Add</button>
                                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href='{{ url('/remedial/'.$att->id.'/'.$batch->id.'/'.$standard.'/liststudentattendance') }}'">List</button>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="6" align="right">
                                                        <nav>
                                                            {{$attendance->links()}}
                                                        </nav>
                                                    </td>
                                                </tr>
                                            </tbody>
                                </table>
                
                </div>
                </div>
        </div>
@endsection
@section('javascriptfunctions')
<script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
   document.location = delUrl;
  }
}


$(document).ready(function($){
  $('select').find('option[value=pleaseselect]').attr('selected','selected');
});
</script>
@endsection