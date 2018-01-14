@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/'.$batch->id.'/'.$standard.'/listattendance') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{ date('d-m-Y', strtotime($attendances->date)) }}</li>
            <li class="breadcrumb-item active">Add Student Remedial Attendance</li>
</ol>
@endsection
@section('content')

@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
<input type="hidden" value="{{$attendances->id}}" id="attendance_id"/>
                        <div class="card">
                            <form action="{{ url('/remedial/'.$attendances->id.'/'.$batch->id.'/'.$standard.'/addstudentattendance') }}" method="post" name="addstudentattendance" id="addstudentattendance">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Add Student Remedial Attendance</strong>
                            </div>
                            
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th class="text-xs-center">Student Name</th>
                                                    <th class="text-xs-center">Date of Attendance</th>
                                                    <th class="text-xs-center">Topic Taken</th>
                                                    <th class="text-xs-center">Remark</th>
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
                                                        <div>{{$attendances->topic_taken}}</div>
                                                    </td>
                                                    <td class="text-xs-center">
                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                <input name ="adm[]" size="1" type="hidden" class="form-control admission" id="adm[]"  placeholder="" value="{{$adm->id}}">
                                                                </div>
                                                                        @php
                                                                            $found=0;
                                                                            $displayed=0;
                                                                        @endphp
                                                                        @foreach($adm->remedialattendances as $ad)
                                                                            @if($ad->pivot->remedialatt_id==$attendances->id)
                                                                                    <div class="col-md-6">
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
                                                                        <div class="col-md-6">
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
<!-- <script>
$(".admission").on('focus',function() {
       var marks_id=$('#marks_id').val();
       console.log(marks_id+"marks id");
       var url = $('#url').val();
       console.log(url+"url id");
       var admission_id= $(this).attr('id');
       console.log(admission_id+"admission id");

       var marks_obtained=$(this).val();
       console.log(marks_obtained+"marks Obtained");

       if(marks_obtained!="")
       {

       

       $.ajax
                ({
                    type: "GET",
                    url: url + '/ajax/addstudentmarks/' + admission_id + '/'+ marks_id + '/'+marks_obtained,
                    success: function (data) 
                    {
                        console.log(data);
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
    }

    });

</script> -->
@endsection