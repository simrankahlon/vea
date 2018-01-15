@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/testscheduler') }}">Test Schedule</a>
            </li>
            <li class="breadcrumb-item active">{{ $testscheduler->portion_set }}
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
@endsection
@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>
@section('content')
<div class="card">
                            <form action="{{ url('/testscheduler/'.$testscheduler->id.'/edit') }}" method="post" id="edittestschedule">
                                {{ method_field('PATCH')}}
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Edit Test Schedule</strong>
                            </div>
                           <div class="card-block">
                                    <div class="form-group">
                                    <label for="year">Academic Year</label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{$testscheduler->fromyear}}">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{$testscheduler->toyear}}">
                                            <span style="color:red">{{ $errors->first('to_year') }}</span>
                                        </div>
                                        <div class="col-md-8">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select id="branch" name="branch" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($testscheduler->branch == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('branch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ann_date">Announcement Date</label>
                                            <input name ="ann_date" type="date" class="form-control" id="ann_date"  placeholder="Announcement Date" value="{{$testscheduler->announcement_date}}">
                                            <span style="color:red">{{ $errors->first('ann_date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="standard">Standard</label>
                                    <select id="standard" name="standard" class="form-control" size="1">
                                       <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                            @if($testscheduler->standard == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="batch">Batch</label>
                                        <select id="batch" name="batch" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach($batch as $bat)
                                            @if($testscheduler->batch == $bat->batchname)
                                                <option value="{{$bat->batchname}}" selected>{{$bat->batchname}}</option>
                                            @else
                                                <option value="{{$bat->batchname}}">{{$bat->batchname}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->first('batch') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="test_date">Test Date</label>
                                            <input name ="test_date" type="date" class="form-control" id="test_date"  placeholder="Test Date" value="{{ $testscheduler->test_date }}">
                                            <span style="color:red">{{ $errors->first('test_date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="portion">Portion (Set)</label>
                                        <input name ="portion" type="text" class="form-control" id="portion" placeholder="Portion (Set)" value="{{ $testscheduler->portion_set }}">
                                        <span style="color:red">{{ $errors->first('portion') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="marks">Marks</label>
                                        <input name ="marks" type="text" class="form-control" id="marks" placeholder="Marks" value="{{ $testscheduler->marks }}" pattern="[0-9]{1,3}">
                                        <span style="color:red">{{ $errors->first('marks') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="qp_ready">Question paper ready</label>
                                    <select id="qp_ready" name="qp_ready" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            @if($testscheduler->question_paper_ready == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('qp_ready') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="xerox">Xerox ready</label>
                                    <select id="xerox" name="xerox" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            @if($testscheduler->xerox == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('xerox') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="corr_done">Correction done by</label>
                                        <input name ="corr_done" type="text" class="form-control" id="corr_done" placeholder="Correction done by" value="{{ $testscheduler->correction_done_by }}" pattern="[a-zA-Z\s]+">
                                        <span style="color:red">{{ $errors->first('corr_done') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dis_date">Distribution Date</label>
                                            <input name ="dis_date" type="date" class="form-control" id="dis_date"  placeholder="Distribution Date" value="{{ $testscheduler->distribution_date }}">
                                            <span style="color:red">{{ $errors->first('dis_date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="an_uploaded">Answer key uploaded</label>
                                    <select id="an_uploaded" name="an_uploaded" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            @if($testscheduler->anwer_key_uploaded == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('an_uploaded') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="msg_sent">Msg sent</label>
                                    <select id="msg_sent" name="msg_sent" class="form-control" size="1">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Yesno::all() as $value => $code)
                                            @if($testscheduler->msg_send == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('msg_sent') }}</span>
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
$("#standard" ).change(function() 
  {
    var standard = $("#standard").val();
    var branch = $("#branch").val();
    var url = $('#url').val();
    var fromyear = $("#from_year").val();
    var toyear = $("#to_year").val();
    if (standard === 'VIII') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
        } 

    else if(standard==='IX') {

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })

            
        }
    else if(standard==='X'){

        $.get(url + '/ajax/admission/'+standard+'/'+branch+'/'+fromyear+'/'+toyear, function (data) {
                    
                    $('#batch').empty();
                    $("#batch").append('<option value="">Please select</option>');
                    $.each( data, function( key, value ) {
                      $("#batch").append("<option value='"+ value.batchname +"'>" + value.batchname + "</option>");
                    });
                })
    }
    
  });

$( "#edittestschedule" ).submit(function() 
{
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
