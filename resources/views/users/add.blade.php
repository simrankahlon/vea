@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users</a>
            </li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
@endsection

@section('content')
<div class="card">
                            <form action="{{ url('/users/create') }}" method="post">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New user</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                        <label for="name">Name</label> <span style="color:red">*</span>
                                        <input name ="name" type="text" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}" required="">
                                        <span style="color:red">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">Email</label> <span style="color:red">*</span>
                                        <input name ="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" required="">
                                        <span style="color:red">{{ $errors->first('email') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label> <span style="color:red">*</span>
                                        <input name ="password" type="password" class="form-control" id="password" placeholder="Password" required="">
                                        <span style="color:red">{{ $errors->first('password') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label> <span style="color:red">*</span>
                                        <input name ="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Password" required="">
                                        <span style="color:red">{{ $errors->first('password_confirmation') }}</span>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="save" class="btn btn-primary">Save changes</button>
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
                            </div>
                            </form>

                        </div>
@endsection
