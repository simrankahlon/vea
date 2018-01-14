@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/todolist') }}">To-Do List</a>
            </li>
            <li class="breadcrumb-item active">Add</li>
</ol>
@endsection

@section('content')
<div class="card">
                            <form action="{{ url('/todolist/create') }}" method="post" name="addtodolist" id="addtodolist">
                                {{ csrf_field() }}
                            <div class="card-header">
                                <strong>New Task</strong>
                            </div>
                            <div class="card-block">
                                    <div class="form-group">
                                        <label for="name">Name</label> <span style="color:red"> *</span>
                                        <input name ="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}" required="">
                                        <span style="color:red">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="date_assigned">Date Assigned</label><span style="color:red"> *</span>
                                            <input name ="date_assigned" type="date" class="form-control" id="date_assigned"  placeholder="Date Assigned" value="{{ old('date_assigned') }}" required="">
                                            <span style="color:red">{{ $errors->first('date_assigned') }}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datecompleted">Date Completed</label>
                                            <input name ="datecompleted" type="date" class="form-control" id="datecompleted"  placeholder="Date Completed" value="{{ old('datecompleted') }}">
                                        </div>
                                        </div>
                                        <div class="col-md-10">     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="task">Task</label><span style="color:red"> * </span>
                                        <textarea name ="task" class="form-control" id="task" placeholder="Task" required="">{{old('task')}}</textarea>
                                        <span style="color:red">{{ $errors->first('task') }}</span>
                                    </div> 
                                    <div class="form-group">
                                        <label for="status">Status</label> 
                                        <input name ="status" type="text" class="form-control" id="status" placeholder="Status" value="{{ old('status') }}">
                                        <span style="color:red">{{ $errors->first('status') }}</span>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="save" class="btn btn-primary">Save changes</button>
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a> 
                            </div>
                            </form>
                        </div>
@endsection

