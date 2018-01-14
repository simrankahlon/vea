@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">Enquiry</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="{{ url('/testscheduler/create') }}"><i class="icon-plus"></i> &nbsp;Create Test Scheduler </a>
                </div>
            </li>
        </ol>
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-xs-5">
            </div>
            <div class="col-xs-6"> 
                @php
                $search = (isset($_GET['filters'])) ? htmlentities($_GET['filters']) : '';
                @endphp
                <form action="{{ url('/testscheduler/filters') }}" method="get" id="testscheduler_filter">
                    {{ csrf_field() }}
                    <!--  <div class="form-control"> -->

                    <select id="filters" name="filters" class="form-control" size="1">
                        <option value="">Please select</option>
                        @foreach(App\Http\AcatUtilities\Filters::all() as $value => $code)
                            <option value="{{$code}}" @if (old('filters') == $code) selected="selected" @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <span style="color:red">{{ $errors->first('filters') }}</span>
                    </div>
                    <button type="submit"  form="testscheduler_filter" class="btn btn-primary right"  style="margin-left:-15px;height:39px">Filter</button> 
                </form>
                <br><br>
            <div class="col-xs-6">
            </div>
            <div class="col-xs-5">
                @php
                    $search = (isset($_GET['searchtxt'])) ? htmlentities($_GET['searchtxt']) : '';
                @endphp
                <form action="{{ url('/testscheduler/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                    <!--  <div class="form-control"> -->
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Test Schedule" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
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
                                                    <th>Class</th>
                                                    <th>Date</th>
                                                    <th>Portion Set</th>
                                                    <th>Marks</th>
                                                    <th>Correction done by</th>
                                                    <th>Details</th>
                                                    <th>Activity</th>
                                                    <th>Action</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($testscheduler as $ts)
                                                <tr>
                                                    <td>
                                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                                            @if($ts->standard == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                        <div><strong>Batch : </strong>{{$ts->batch}}</div>
                                                    </td>
                                                    <td>
                                                        <div><strong>Ann. Date : </strong>{{ date('d-m-Y', strtotime($ts->announcement_date)) }}</div>
                                                        <div><strong>Test Date : </strong>{{ date('d-m-Y', strtotime($ts->test_date)) }}</div>
                                                        <div><strong>Distribution Date : </strong>{{ date('d-m-Y', strtotime($ts->distribution_date)) }}</div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/testscheduler/'.$ts->id.'/edit') }}">{{$ts->portion_set }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>{{$ts->marks}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$ts->correction_done_by}}</div>
                                                    </td>
                                                    <td>
                                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                                            @if($ts->question_paper_ready == $code)
                                                                <div><strong>Quest. paper ready : </strong>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                                            @if($ts->xerox == $code)
                                                                <div><strong>Xerox ready : </strong>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                                            @if($ts->answer_key_uploaded == $code)
                                                                <div><strong>Answer key uploaded : </strong>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                                            @if($ts->msg_send== $code)
                                                                <div><strong>Msg. Sent : </strong>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <strong>{{$ts->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/testscheduler/'.$ts->id.'/edit') }}'">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/testscheduler/'.$ts->id.'/delete') }}')" disabled="">Delete</button>
                                                    </div>
                                                </td>
                                                   
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="8" align="right">
                                                        <nav>
                                                            {{$testscheduler->links()}}
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

</script>
@endsection

