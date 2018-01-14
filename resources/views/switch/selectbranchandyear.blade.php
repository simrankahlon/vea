@extends('layouts.auth')

@section('content')
<div class="container d-table">
        <div class="d-100vh-va-middle">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card-group">
                        <div class="card p-2">
                        <form class="form-horizontal" role="form" method="POST" id="setsession" action="{{ url('/setsession') }}" >
                            {{ csrf_field() }}
                            <div class="card-block">
                                <div align="center"><img src="{{ asset('img/vealogo.png') }}" alt="Logo" align="center"></div>
                                <strong>Vikram's English Academy</strong>
                                <p class="text-muted">Please Select Academic Year and Branch.</p>
                                    <div class="form-group">
                                    <label for="year">Academic Year</label><span style="color:red"> *</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            @if(!empty($user->default_fromyear))
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{$user->default_fromyear}}" required="">
                                            @else
                                            <input type="number" name="from_year" min="2015" class="form-control" max="2030" step="1" id="from_year" value="{{old('from_year')}}" required="">
                                            @endif
                                            <span style="color:red">{{ $errors->first('from_year') }}</span>
                                        </div>
                                        <div class="col-md-1"><strong style="font-size:23px;">-</strong></div>
                                        <div class="col-md-4">
                                            @if(!empty($user->default_toyear))
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{$user->default_toyear}}" required="">
                                            @else
                                            <input type="number" name="to_year" id="to_year" min="2015" class="form-control" max="2030" step="1" value="{{old('toyear')}}" required="">
                                            @endif
                                            <span style="color:red">{{ $errors->first('to_year') }}</span>
                                        </div>
                                        <div class="col-md-3">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="branch">Branch</label><span style="color:red"> * </span>
                                    <select id="branch" name="branch" class="form-control" size="1" required="">
                                        <option value="">Please select</option>
                                        @foreach(App\Http\AcatUtilities\Branch::all() as $value => $code)
                                            @if($user->default_branch == $code)
                                                <option value="{{$code}}" selected>{{$value}}</option>
                                            @else
                                                <option value="{{$code}}" @if (old('branch') == $code) selected="selected" @endif>{{$value}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->first('branch') }}</span>
                                    </div>
                                <div style="text-align: left;margin-bottom:10px">
                                    @if(!empty($user->default_branch) && !empty($user->default_fromyear) && !empty($user->default_toyear))
                                    <input type="checkbox" name="defaultbranchandyear" id="defaultbranchandyear" checked/>&nbsp;Set as Default.
                                    @else
                                    <input type="checkbox" name="defaultbranchandyear" id="defaultbranchandyear"/>&nbsp;Set as Default.
                                    @endif
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-8">
                                        <button type="submit" class="btn btn-primary px-2">Submit</button>
                                    </div>
                                    <div class="col-xs-3 text-xs-right">
                                        <a class="btn btn-link px-0" href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                        </form>
                                        
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascriptfunctions')
<script>
$( "#setsession" ).submit(function() 
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


