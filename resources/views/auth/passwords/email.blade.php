@extends('layouts.auth')

@section('content')
<div class="container d-table">
        <div class="d-100vh-va-middle">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card-group">
                        <div class="card p-2">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}" >
                        {{ csrf_field() }}    
                            <div class="card-block">
                                <div align="center"><img src="{{ asset('img/vealogo.png') }}" alt="Logo" align="center"></div>
                                <strong>VEA Reset Password</strong>
                                <p class="text-muted">Enter your email address in the form below</p>
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
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
                                
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="submit" class="btn btn-primary px-2">Send Password Reset Link</button>
                                    </div>
                                    <div class="col-xs-6 text-xs-right">
                                        <a class="btn btn-link px-0" href="{{ url('/login') }}">Login</a>
                                        
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
