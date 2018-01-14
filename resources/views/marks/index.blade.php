@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/marks/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item active">{{$standard}} - {{$batch->batchname}}</li>
            <li class="breadcrumb-item active">Marks</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/marks/'.$batch->id.'/'.$standard.'/newmarks') }}"><i class="icon-plus"></i> &nbsp;Create Marks</a>
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
                <form action="{{ url('/marks/'.$batch->id.'/'.$standard.'/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                  
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Marks Details" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
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
                                                    <th>Date of Examination</th>
                                                    <th>Topic Name</th>
                                                    <th>Portion</th>
                                                    <th>Total Marks</th>
                                                    <th>Passing Percent</th>
                                                    <th>Passing Marks</th>
                                                    <th>Activity</th>
                                                    <th>Action</th>
                                                    <th><div class="float-xs-right">Student Marks</div></th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($marks as $mark)
                                                <tr>
                                                    <td>
                                                    <div>{{ date('d-m-Y', strtotime($mark->date)) }}</div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/marks/'.$mark->id.'/'.$batch->id.'/'.$standard.'/editmarks') }}">{{$mark->topic_name }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>{{$mark->portion}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$mark->total_marks}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$mark->passing_percent}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$mark->passing_marks}}</div>
                                                    </td>
                                                    <td>
                                                        <strong>{{$mark->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/marks/'.$mark->id.'/'.$batch->id.'/'.$standard.'/editmarks') }}'">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/marks/'.$mark->id.'/'.$batch->id.'/'.$standard.'/deletemarks') }}')">Delete</button>
                                                    </div>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/marks/'.$mark->id.'/'.$batch->id.'/'.$standard.'/addstudentmarks') }}'">Add</button>
                                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href='{{ url('/marks/'.$mark->id.'/'.$batch->id.'/'.$standard.'/liststudentmarks') }}'">List</button>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="9" align="right">
                                                        <nav>
                                                            {{$marks->links()}}
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