@extends('layouts.app')


@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">Users</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/users/create') }}"><i class="icon-plus"></i> &nbsp;Create User </a>
                </div>
            </li>
        </ol>
@endsection

@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <table class="table table-hover table-outline mb-0 hidden-sm-down">
                                            <thead class="thead-default">
                                                <tr>
                                                    <th class="text-xs-center"><i class="icon-people"></i>
                                                    </th>
                                                    <th>User</th>
                                                    <th>Email</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($users as $user)
                                                <tr>
                                                    <td class="text-xs-center">
                                                        <div class="avatar">
                                                            <img src="{{ asset('img/user-icon.png') }}" class="img-avatar" alt="Client Logo">
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><a href="{{ url('/users/'.$user->id.'/edit') }}">{{$user->name}}</a></div>
                                                    </td>
                                                    <td>
                                                        <div><a href="mailtp:{{$user->email}}">{{$user->email}}</a></div>
                                                    </td>
                                                    <td>
                                                        
                                                        <strong>{{$user->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                        
                                                    <td>
                                                        <button type="button" id="userEdit-{{$user->id}}" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/users/'.$user->id.'/edit') }}'">Edit</button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/users/'.$user->id.'/delete') }}')">Delete</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="8" align="right">
                                                        <nav>
                                                            {{$users->links()}}
                                                        </nav>
                                                    </td>
                                                </tr>
                                                
                                                
                                            </tbody>
                                </table>
                                
                        </div>
                    </div>
                    <!--/col-->
                </div>
@endsection
@section('javascriptfunctions')
<script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
   document.location = delUrl;
  }
}
</script>
@endsection

