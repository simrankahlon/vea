@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/marks/create') }}">Batch List</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/marks/'.$batch->id.'/'.$standard.'/listmarks') }}">{{$standard}} - {{$batch->batchname}}</a></li>
            <li class="breadcrumb-item active">{{$marks->topic_name}}</li>
            <li class="breadcrumb-item active">List Student Marks</li>
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
                <form action="{{ url('/marks/'.$marks->id.'/'.$batch->id.'/'.$standard.'/filters') }}" method="get" id="marks_filter">
                    {{ csrf_field() }}
                    <select id="filters" name="filters" class="form-control" size="1">
                        <option value="">Please select</option>
                        @foreach(App\Http\AcatUtilities\MarksFilters::all() as $value => $code)
                            <option value="{{$code}}" @if($search == $code) selected="selected" @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <span style="color:red">{{ $errors->first('filters') }}</span>
            </div>
                    <button type="submit"  form="marks_filter" class="btn btn-primary right"  style="margin-left:-15px;height:39px">Filter</button> 
                </form>
                <br><br>
        </div>  
        </div><!--END DIV ROW-->
    </div><!--END CARD-BLOCK-->

<div class="row">
    <div class="col-lg-12">                        
        <div class="card">
            <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Date of Examination</th>
                                                    <th>Topic Name</th>
                                                    <th>Total Marks</th>
                                                    <th>Passing Marks</th>
                                                    <th>Marks Obtained</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($admission as $adm)
                                                <tr>
                                                    <td>
                                                        <div>{{$adm->studentname}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{ date('d-m-Y', strtotime($adm->date)) }}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$adm->topic_name}}</div>
                                                    </td>
                                                    <td>
                                                    <div>{{$adm->total_marks}}</div>
                                                    </td>
                                                    <td>
                                                    <div>{{$adm->passing_marks}}</div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            @if($adm->marks_obtained!=null)
                                                                @if($adm->marks_obtained < $adm->passing_marks)
                                                                    <strong style="color:red">{{$adm->marks_obtained}}</strong>
                                                                @else
                                                                    <strong>{{$adm->marks_obtained}}</strong></div>
                                                                @endif
                                                            @else
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