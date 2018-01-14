@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/schoolmarks/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/schoolmarks/'.$batch->id.'/'.$standard.'/listmarks') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{$marks->topic_name}}</li>
            <li class="breadcrumb-item active">Add Student School Marks</li>
</ol>
@endsection
@section('content')

@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
<input type="hidden" value="{{$marks->id}}" id="marks_id"/>
                        <div class="card">
                            <form action="{{ url('/schoolmarks/'.$marks->id.'/'.$batch->id.'/'.$standard.'/addstudentmarks') }}" method="post" name="addmarks" id="addmarks">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Add Student Marks</strong>
                            </div>
                            
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th class="text-xs-center">Student Name</th>
                                                    <th class="text-xs-center">Topic Name</th>
                                                    <th class="text-xs-center">Total Marks</th>
                                                    <th class="text-xs-center">Marks Obtained</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($admission as $adm)
                                                <tr>
                                                    <td class="text-xs-center">
                                                        <div>{{$adm->studentname}}</div>
                                                    </td>
                                                    <td class="text-xs-center">
                                                        <div>{{$marks->topic_name}}</div>
                                                    </td>
                                                    <td class="text-xs-center">
                                                    <div>{{$marks->total_marks}}</div>
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
                                                                        @foreach($adm->schoolmarks as $ad)
                                                                            @if($ad->pivot->schoolmark_id==$marks->id)
                                                                                    <div class="col-md-6">
                                                                                    <input type="text" placeholder="Marks Obtained" name="marks[]" id="marks[]" class="form-control" size="1" oninvalid="this.setCustomValidity('Please enter Marks')" oninput="setCustomValidity('')" value="{{$ad->pivot->schoolmarks_obtained}}" required="">
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
                                                                            <input type="text" placeholder="Marks Obtained" name="marks[]" id="marks[]" class="form-control" size="1" required="" value="">
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