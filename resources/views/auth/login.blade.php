@extends('layouts.auth')

@section('content')
<div class="container d-table">
        <div class="d-100vh-va-middle">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card-group">
                        <div class="card p-2">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" >
                        {{ csrf_field() }}    
                            <div class="card-block">
                                <div align="center"><img src="{{ asset('img/vealogo.png') }}" alt="Logo" align="center"></div>
                                <strong>VEA Login</strong>
                                <p class="text-muted">Sign In to your account</p>

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
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <!--<input type="password" class="form-control" placeholder="Password">-->
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                     @endif
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="submit" class="btn btn-primary px-2">Login</button>
                                    </div>
                                    <div class="col-xs-6 text-xs-right">
                                        <a class="btn btn-link px-0" href="{{ url('/password/reset') }}">Forgot password?</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
                            <div class="card-block text-xs-center">
                                <div>
                                    <h2>VIKRAM'S ENGISH ACADEMY</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <!--<button type="button" class="btn btn-primary active mt-1">Register Now!</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
