@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/attendance/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/attendance/'.$batch->id.'/'.$standard.'/listattendance') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{ date('d-m-Y', strtotime($attendances->date)) }}</li>
            <li class="breadcrumb-item active">Add Student Attendance</li>
</ol>
@endsection
@section('content')

@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
<input type="hidden" value="{{$attendances->id}}" id="attendance_id"/>
    <div class="card">
                            <form action="{{ url('/attendance/'.$attendances->id.'/'.$batch->id.'/'.$standard.'/addstudentattendance') }}" method="post" name="addstudentattendance" id="addstudentattendance">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Add Student Attendance</strong>
                            </div>
                            
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th class="text-xs-center">Student Name</th>
                                                    <th class="text-xs-center">Date of Attendance</th>
                                                    <th class="text-xs-center">Remark</th>
                                                    <th class="text-xs-center">Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($admission as $adm)
                                                <tr>
                                                    <td class="text-xs-center">
                                                        <div>{{$adm->studentname}}</div>
                                                    </td>
                                                    <td class="text-xs-center">
                                                        <div>{{ date('d-m-Y', strtotime($attendances->date)) }}</div>
                                                    </td>
                                                    <td class="text-xs-center">
                                                            <div class="form-group row">
                                                                <div class="col-md-2">
                                                                <input name ="adm[]" size="1" type="hidden" class="form-control admission" id="adm[]"  placeholder="" value="{{$adm->id}}">
                                                                </div>
                                                                        @php
                                                                            $found=0;
                                                                            $displayed=0;
                                                                        @endphp
                                                                        @foreach($adm->attendances as $ad)
                                                                            @if($ad->pivot->attendance_id==$attendances->id)
                                                                                    <div class="col-md-8">
                                                                                    <select id="remark[]" name="remark[]" class="form-control" size="1" required="" oninvalid="this.setCustomValidity('Please enter Remark')" oninput="setCustomValidity('')">
                                                                                        <option value="0">Please select</option>
                                                                                        @foreach(App\Http\AcatUtilities\StudentAttendance::all() as $value => $code)
                                                                                            @if($code==$ad->pivot->attendance)
                                                                                            <option value="{{$code}}" selected>{{$value}}</option>
                                                                                            @else
                                                                                            <option value="{{$code}}">{{$value}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                    </div>
                                                                                    @php
                                                                                    $displayed=1;
                                                                                    @endphp
                                                                            @endif
                                                                            @php
                                                                                $dislayed=0;
                                                                            @endphp
                                                                        @endforeach
                                                                        @if($found==0 && $displayed!=1)
                                                                        <div class="col-md-8">
                                                                            <select id="remark[]" name="remark[]" class="form-control" size="1" required="" oninvalid="this.setCustomValidity('Please enter Remark')" oninput="setCustomValidity('')">
                                                                                        <option value="0">Please select</option>
                                                                                        @foreach(App\Http\AcatUtilities\StudentAttendance::all() as $value => $code)
                                                                                            <option value="{{$code}}">{{$value}}</option>
                                                                                        @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @endif


                                                            </div>
                                                    </td>
                                                    
                                                    <td class="text-xs-center">
                                                        @php
                                                            $dislayed=0;
                                                        @endphp
                                                        @foreach($adm->attendances as $ad)
                                                            @if($ad->pivot->attendance_id==$attendances->id)
                                                                <input name ="comment[]" type="comment" class="form-control" id="comment[]" placeholder="Comment" value="{{$ad->pivot->comment}}">
                                                                @php
                                                                    $dislayed=1;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @if($displayed == 0)
                                                            <input name ="comment[]" type="comment" class="form-control" id="comment[]" placeholder="Comment" value="">
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                            </tbody>
                                </table>
                                <div class="card-footer">
                                     <button type="submit" id="save" class="btn btn-primary">Save changes</button>
                                     <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
                                </div>
                
                
            </form>
            </div>

                
@endsection
@section('javascriptfunctions')
<script>
$( "#addstudentattendance" ).submit(function( event ) {


  
});
</script>
@endsection