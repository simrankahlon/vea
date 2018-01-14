@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/enquiry') }}">Enquiry</a>
            </li>
            <li class="breadcrumb-item"><a href="#">{{ $enquiry->name }}</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
@endsection
@section('content')
<div class="card">
                            <form action="{{ url('/enquiry/'.$enquiry->id.'/edit') }}" method="post" id="formattributes">
                                {{ method_field('PATCH')}}
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Edit Enquiry</strong>
                            </div>
                           <div class="card-block">
                                    <div class="form-group">
                                    <label for="year">Academic Year</label><span style="color:red"> *</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{$enquiry->fromyear}}" required="">
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{$enquiry->toyear}}" required="">
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
                                            @if($enquiry->branch == $code)
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
                                            @if($enquiry->standard == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('standard') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Date</label><span style="color:red"> *</span>
                                            <input name ="date" type="date" class="form-control" id="date"  placeholder="Date" value="{{ $enquiry->date }}" required="">
                                            <span style="color:red">{{ $errors->first('date') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-9">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label> <span style="color:red"> *</span>
                                        <input name ="name" type="text" class="form-control" id="name" placeholder="Enquirer name" value="{{ $enquiry->name }}" required="">
                                        <span style="color:red">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="form-group">
                                    <label for="school">School</label> <span style="color:red"> *</span>
                                    <select id="school" name="school" class="form-control" size="1" required="">
                                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                                            @if($enquiry->school == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}">{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('school') }}</span>
                                    </div>
                                    <div class="form-group" style="display: none;" id="other">
                                        <label for="otherschool">School Name</label> <span style="color:red"> *</span>
                                        <input name ="otherschool" type="text" class="form-control" id="otherschool" placeholder="School name" value="{{ $enquiry->otherschool }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fatherno">Father's Number</label> 
                                        <input name ="fatherno" type="tel" class="form-control" id="fatherno" placeholder="Father's Number" value="{{ $enquiry->fatherno }}">
                                        <span style="color:red">{{ $errors->first('fatherno') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="motherno">Mother's Number</label>
                                        <input name ="motherno" type="tel" class="form-control" id="motherno" placeholder="Mother's Number" value="{{ $enquiry->motherno }}">
                                        <span style="color:red">{{ $errors->first('motherno') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="landline">Landline</label>
                                        <input name ="landline" type="tel" class="form-control" id="landline" placeholder="Landline" value="{{ $enquiry->landline }}">
                                        <span style="color:red">{{ $errors->first('landline') }}</span>
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

    var school = $('#school').val();
    if (school === 'OTHERS') {
           $('#other').show();
        } else {
            $('#other').hide();
        }

});

$("#school" ).change(function() 
  {
   
    var school = $("#school").val();
    if (school === 'OTHERS') {
         
           $('#other').show();
        } else {

            $('#other').hide();
        }
  });

$("#formattributes").submit(function() {
    
    var fatherno=$('#fatherno').val();
    var motherno=$('#motherno').val();
    var landline=$('#landline').val();
  
    if(fatherno=="" & motherno=="" & landline=="")
    {
        alert("Please enter atlease one number.");
        return false;
    }
    
    var school=$("#school").val();

    if(school!=='OTHERS')
    {
       
        $("#otherschool").val(" ");
    }
    });

</script>
@endsection
