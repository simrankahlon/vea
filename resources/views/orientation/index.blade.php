@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">Orientation</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/enquiry/create') }}"><i class="icon-plus"></i> &nbsp;Create Enquiry </a>
                </div>
            
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/enquiry') }}"><i class="icon-plus"></i> &nbsp;List Enquiry </a>
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
                <form action="{{ url('/orientation/filters') }}" method="get" id="enquiry_filter">
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
                    <button type="submit"  form="enquiry_filter" class="btn btn-primary right"  style="margin-left:-15px;height:39px">Filter</button> 
                </form>
                <br><br>
            <div class="col-xs-6">
            </div>
            <div class="col-xs-5">
                @php
                    $search = (isset($_GET['searchtxt'])) ? htmlentities($_GET['searchtxt']) : '';
                @endphp
                <form action="{{ url('/orientation/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                    <!--  <div class="form-control"> -->
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Orientation" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
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
                    <div  class="col-lg-12">
                        <div class="card">
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>Class</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>School</th>
                                                    <th>Number</th>
                                                    <th>Orient. 1</th>
                                                    <th>Orient. 2</th>
                                                    <th>Orient. 3</th>
                                                    <th>Remark</th>
                                                    <th>Activity</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($enquiry as $enq)
                                                <tr>
                                                    <td>
                                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                                            @if($enq->standard == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div>{{ date('d-m-Y', strtotime($enq->date)) }}</div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/enquiry/'.$enq->id.'/edit') }}">{{$enq->name}}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    @if($enq->school=='OTHERS')
                                                        <div>{{$enq->otherschool}}</div>
                                                    @else
                                                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                                                            @if($enq->school == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <div><strong>F No. : </strong>
                                                        @if(!empty($enq->fatherno))
                                                        {{$enq->fatherno}}
                                                        @else
                                                        &nbsp;&nbsp;&nbsp;...
                                                        @endif
                                                        </div>
                                                        <div><strong>M No. : </strong>
                                                        @if(!empty($enq->motherno))
                                                        {{$enq->motherno}}
                                                        @else
                                                        &nbsp;&nbsp;&nbsp;...
                                                        @endif
                                                        </div>
                                                        <div><strong>Landline : </strong>
                                                        @if(!empty($enq->landline))
                                                        {{$enq->landline}}
                                                        @else
                                                        &nbsp;&nbsp;&nbsp;...
                                                        @endif
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                       <div><strong>Date:</strong> @if($enq->date1!=""){{ date('d-m-Y', strtotime($enq->date1)) }}@endif</div>
                                                       <div><strong>Response:</strong> {{$enq->response1}}</div>
                                                       <div><strong>Attendance:</strong> {{$enq->attendance1}}</div>
                                                    </td>
                                                    <td>
                                                       <div><strong>Date:</strong> @if($enq->date2!=""){{ date('d-m-Y', strtotime($enq->date2)) }}@endif</div>
                                                       <div><strong>Response:</strong> {{$enq->response2}}</div>
                                                       <div><strong>Attendance:</strong> {{$enq->attendance2}}</div>
                                                    </td>
                                                    <td>
                                                       <div><strong>Date:</strong> @if($enq->date3!=""){{ date('d-m-Y', strtotime($enq->date3)) }}@endif</div>
                                                       <div><strong>Response:</strong> {{$enq->response3}}</div>
                                                       <div><strong>Attendance:</strong> {{$enq->attendance3}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$enq->remark}}</div>
                                                    </td>
                                                    <td>
                                                        <strong>{{$enq->updated_at->diffForHumans()}}</strong>
                                                    </td>

                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="10" align="right">
                                                        <nav>
                                                            {{$enquiry->links()}}
                                                        </nav>
                                                    </td>
                                                </tr>
                                            </tbody>
                                </table>
                
                </div>
                </div>
        </div>
@endsection



