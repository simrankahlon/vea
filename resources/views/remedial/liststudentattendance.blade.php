@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/remedial/'.$batch->id.'/'.$standard.'/listattendance') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{ date('d-m-Y', strtotime($attendances->date)) }}</li>
            <li class="breadcrumb-item active">List Student Remedial Attendance</li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">                        
        <div class="card">
            <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Date of Attendance</th>
                                                    <th>Topic Taken</th>
                                                    <th>Remark</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($admission as $adm)
                                                <tr>
                                                    <td>
                                                        <div>{{$adm->studentname}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{ date('d-m-Y', strtotime($attendances->date)) }}</div>
                                                    </td>
                                                   
                                                    <td>
                                                        <div>{{$attendances->topic_taken}}</div>
                                                    </td>
                                                    
                                                    <td>
                                                        @php
                                                            $found=0;
                                                            $displayed=0;
                                                        @endphp
                                                        @foreach($adm->remedialattendances as $ad)
                                                            @if($ad->pivot->remedialatt_id==$attendances->id)
                                                                    @if($ad->pivot->attendance=='PRESENT')
                                                                        <div><strong style="color:green;">Present</strong></div>
                                                                    @elseif($ad->pivot->attendance=='ABSENT')
                                                                        <div><strong style="color:red;">Absent</strong></div>
                                                                    @elseif($ad->pivot->attendance=='LATE')
                                                                        <div><strong style="color:yellow;">Late</strong></div>
                                                                    @endif
                                                                    @php
                                                                    $displayed=1;
                                                                    @endphp
                                                            @endif
                                                            @php
                                                                $dislayed=0;
                                                            @endphp
                                                        @endforeach
                                                        @if($found==0 && $displayed!=1)
                                                             <div><strong> - </strong></div>
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                </table>
                                
            </div>
        </div>
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