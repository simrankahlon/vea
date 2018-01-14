@extends('layouts.auth')

@section('content')
<div class="container d-table">
        <div class="d-100vh-va-middle">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card-group">
                        <div class="card p-2">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}" >
                        {{ csrf_field() }}   
                        <input type="hidden" name="token" value="{{ $token }}"> 
                            <div class="card-block">
                                <div align="center"><img src="{{ asset('img/vealogo.png') }}" alt="Logo" align="center"></div>
                                <strong>VEA Reset Password</strong>
                                <p class="text-muted">Enter your email address in the form below</p>
                               

                                <div class="input-group mb-1">
                                    <!--<span class="input-group-addon"><i class="icon-user"></i>
                                    </span>-->
                                    <!--<input type="text" class="form-control" placeholder="Email">-->
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                     @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="input-group mb-1">
                                    <!--<span class="input-group-addon"><i class="icon-user"></i>
                                    </span>-->
                                    <!--<input type="text" class="form-control" placeholder="Email">-->
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group mb-1">
                                    <!--<span class="input-group-addon"><i class="icon-user"></i>
                                    </span>-->
                                    <!--<input type="text" class="form-control" placeholder="Email">-->
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="submit" class="btn btn-primary px-2">Reset Password</button>
                                    </div>
                                    <div class="col-xs-6 text-xs-right">
                                        <a class="btn btn-link px-0" href="{{ url('/password/reset') }}">Login</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
