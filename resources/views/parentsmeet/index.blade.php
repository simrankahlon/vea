@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Parent Meet Details</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/parentsmeet/create') }}"><i class="icon-plus"></i> &nbsp;Create Parent Meet Details </a>
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
                <form action="{{ url('/parentsmeet/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                  
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Parent Meet Details" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
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
                                                    <th>Standard</th>
                                                    <th>Batch</th>
                                                    <th>Date</th>
                                                    <th>Student Name</th>
                                                    <th>To Meet</th>
                                                    <th>Reason</th>
                                                    <th>Remarks</th>
                                                    <th>Activity</th>
                                                    <th>Action</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($parentsmeet as $pm)
                                                <tr>
                                                    <td>
                                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                                            @if($pm->standard == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div>{{$pm->batch}}</div>
                                                    </td>
                                                    <td>
                                                        <div><strong>Date of Text/Call :</strong>
                                                        {{ date('d-m-Y', strtotime($pm->date_of_call)) }}
                                                        </div>
                                                        <div><strong>Date of Meet :</strong> {{ date('d-m-Y', strtotime($pm->date_of_meet)) }}</div>
                                                        @if($pm->timing!=null)
                                                        <div><strong>Timing :</strong> {{$pm->timing}}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/parentsmeet/'.$pm->id.'/edit') }}">{{$pm->studentname }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>{{$pm->tomeet}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$pm->reason}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$pm->remarks}}</div>
                                                    </td>
                                                    <td>
                                                        <strong>{{$pm->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/parentsmeet/'.$pm->id.'/edit') }}'" >Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/parentsmeet/'.$pm->id.'/delete') }}')">Delete</button>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="9" align="right">
                                                        <nav>
                                                            {{$parentsmeet->links()}}
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