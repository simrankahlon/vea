@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">Batch</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="{{ url('/batch/create') }}"><i class="icon-plus"></i> &nbsp;Create Batch </a>
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
                <form action="{{ url('/batch/filters') }}" method="get" id="batch_filter">
                    {{ csrf_field() }}
                    <!--  <div class="form-control"> -->

                    <select id="filters" name="filters" class="form-control" size="1">
                        <option value="">Please select</option>
                        @foreach(App\Http\AcatUtilities\Filters::all() as $value => $code)
                            <option value="{{$code}}" @if ($search == $code) selected="selected" @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <span style="color:red">{{ $errors->first('filters') }}</span>
                    </div>
                    <button type="submit"  form="batch_filter" class="btn btn-primary right"  style="margin-left:-15px;height:39px">Filter</button> 
                </form>
                <br><br>
            <div class="col-xs-6">
            </div>
            <div class="col-xs-5">
                @php
                    $search = (isset($_GET['searchtxt'])) ? htmlentities($_GET['searchtxt']) : '';
                @endphp
                <form action="{{ url('/batch/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                    <!--  <div class="form-control"> -->
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Batch" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
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
                                                    <th>Batch Name</th>
                                                    <th>Days</th>
                                                    <th>Timing from</th>
                                                    <th>Timing till</th>
                                                    <th>Activity</th>
                                                    <th><div class="float-xs-right">Action</div></th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($batch as $bat)
                                                <tr>
                                                    <td>
                                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                                            @if($bat->standard == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/batch/'.$bat->id.'/edit') }}">{{$bat->batchname }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    @php
                                                        $found = 0;
                                                    @endphp
                                                    @foreach($days as $day)
                                                        @foreach($bat->days as $selectedday)
                                                            @if($day->id == $selectedday->id)
                                                                @php
                                                                    $found = 1;
                                                                @endphp
                                                            @endif  
                                                         @endforeach     
                                                        
                                                        @if($found == 1)
                                                        <div>{{$day->days}}</div>
                                                        @endif    
                                                        @php
                                                            $found=0;
                                                        @endphp        
                                                    @endforeach
                                                    </td>
                                                    <td>
                                                        <div>
                                                           {{$bat->start}}
                                                        </div>
                                                        @if($bat->start1!="")
                                                        <div>
                                                            {{$bat->start1}}
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div>
                                                            {{$bat->end}}
                                                        </div>
                                                        @if($bat->end1!="")
                                                        <div>
                                                            {{$bat->end1}}
                                                        </div>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        <strong>{{$bat->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/batch/'.$bat->id.'/edit') }}'">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/batch/'.$bat->id.'/delete') }}')" disabled="">Delete</button>
                                                    </div>
                                                </td>
                                                   
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="7" align="right">
                                                        <nav>
                                                            {{$batch->links()}}
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


