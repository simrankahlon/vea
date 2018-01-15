@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/remedialbatch') }}">Remedial Batch</a>
            </li>
            <li class="breadcrumb-item"><a href="#">{{ $batch->batchname }}</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')
<div class="card">
                            <form action="{{ url('/remedialbatch/'.$batch->id.'/edit') }}" method="post" name="editbatch" id="editbatch">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Edit Remedial Batch</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                    <label for="year">Academic Year</label><span style="color:red"> *</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{$batch->fromyear}}" required="">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{$batch->toyear}}" required="">
                                            <span style="color:red">{{ $errors->first('to_year') }}</span>
                                        </div>
                                        <div class="col-md-8">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label><span style="color:red"> * </span>
                                    <select id="branch" name="branch" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($batch->branch == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('branch') }}</span>
                                    </div>
                                   <div class="form-group">
                                    <label for="standard">Standard</label><span style="color:red"> *</span>
                                    <select id="standard" name="standard" class="form-control" size="1" required="">
                                       <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            @if($batch->standard == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="bname">Batch Name</label> <span style="color:red"> *</span>
                                        <input name ="bname" type="text" class="form-control" id="bname" placeholder="Batch name" value="{{ $batch->batchname }}" required="">
                                        <span style="color:red">{{ $errors->first('bname') }}</span>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-1 form-control-label">Days <span style="color:red"> *</span></label>
                                        <div class="col-md-11">
                                            <div class="checkbox">
                                            @php
                                            $found=0;
                                            @endphp
                                            @foreach($days as $day)
                                            @foreach($batch->days as $selectedday)
                                            @if($day->id == $selectedday->id)
                                            @php
                                            $found=1; 
                                            @endphp  
                                            @endif  
                                            @endforeach
                                            @if($found==1)
                                            <input type="checkbox" class="cb" id="checkbox-{{$day->id}}" name="days[]" value="{{$day->id}}" checked> {{$day->days}}
                                            </br>
                                            @else
                                            <input type="checkbox" class="cb" id="checkbox-{{$day->id}}" name="days[]" value="{{$day->id}}"> {{$day->days}}
                                            </br>
                                            @endif
                                            @php
                                            $found=0;
                                            @endphp
                                            @endforeach
                                            </div>
                                        </div>
                                        <span style="color:red">{{ $errors->first('days') }}</span>
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-sm-1">
                                        <div><strong>Day 1</strong></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="from">Timing From</label><span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="from" name="from" placeholder="Timings from" value="{{ $batch->start }}" required="">
                                             <span style="color:red">{{ $errors->first('from') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="to">Timing till</label>
                                            <span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="to" name="to"placeholder="Timings till" value="{{ $batch->end }}" required="">
                                             <span style="color:red">{{ $errors->first('to') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-5">
                                    </div>
                                    </div>

                                    <div id="onemore" style="display:none;">
                                    <div class="form-group row">
                                    <div class="col-sm-1">
                                        <div><strong>Day 2</strong></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="from">Timing From</label><span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="from1" name="from1" placeholder="Timings from" value="{{ $batch->start1 }}">
                                             <span style="color:red">{{ $errors->first('from1') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="to">Timing till</label>
                                            <span style="color:red"> *</span>
                                            <input type="text" class="form-control" id="to1" name="to1"placeholder="Timings till" value="{{ $batch->end1 }}">
                                             <span style="color:red">{{ $errors->first('to1') }}</span>
                                        </div>

                                    </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher_name">Teacher Name</label> <span style="color:red"> *</span>
                                        <input name ="teacher_name" type="text" class="form-control" id="teacher_name" placeholder="Teacher Name" value="{{ $batch->teacher_name }}" required="" pattern="[A-Z a-z\s]{3,}">
                                        <span style="color:red">{{ $errors->first('teacher_name') }}</span>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="save" class="btn btn-primary">Save changes</button>
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
                            </div>
                            </form>
                        </div>
@endsection

@section('javascriptfunctions')
<script>
$( document ).ready(function() {
   var check = $('#editbatch').find('input[type=checkbox]:checked').length;
   if(check==2)
   {
        $('#onemore').show();
   }
   else
   {
        $('#onemore').hide();
   }
});

$('.cb').click(function () {
   var check = $('#editbatch').find('input[type=checkbox]:checked').length;
   if(check==2)
   {
        $('#onemore').show();
        $('#from').val("");
        $('#to').val("");
        $('#from1').val("");
        $('#to1').val("");
   }
   else
   {
        $('#onemore').hide();
   }
   if(check==1)
   {
        $('#from').val("");
        $('#to').val("");
   }
});

$("#editbatch").submit(function(){

    var check = $('#editbatch').find('input[type=checkbox]:checked').length;
    var start=$('#from1').val();
    var end=$('#to1').val();
    

    if(check==2)
    {
        if(start=="" || end=="")
        {
            alert('Please enter the timings.');
            return false;
        }
    }
    
    if(check==1)
    {
       
        $('#from1').val("");
        $('#to1').val("");
    }
    var from_year=$('#from_year').val();
    var to_year=$('#to_year').val();
    var my_val=parseInt(from_year)+1;
    if(my_val !=to_year)
    {
        alert('Please enter correct academic year...')
        return false;
    }
   
});

</script>
@endsection
