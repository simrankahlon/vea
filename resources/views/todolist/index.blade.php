@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">To-Do List</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="{{ url('/todolist/create') }}"><i class="icon-plus"></i> &nbsp;Create To-Do List </a>
                </div>
            </li>
        </ol>
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-xs-6">
            </div>
            <div class="col-xs-5">
                @php
                    $search = (isset($_GET['searchtxt'])) ? htmlentities($_GET['searchtxt']) : '';
                @endphp
                <form action="{{ url('/todolist/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                  
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search To-Do List" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
                    </div>
                    <button type="submit"  form="frmserch" class="btn btn-primary right" style="margin-left:-15px;height:35px;width:65px;">Go</button>  
                </form>
            </div>
        </div><!--END DIV ROW-->
    </div><!--END CARD-BLOCK-->
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>Assigned By</th>
                                                    <th>Assigned To</th>
                                                    <th>Date Assigned</th>
                                                    <th>Date Completed</th>
                                                    <th>Task</th>
                                                    <th>Status</th>
                                                    <th>Activity</th>
                                                    <th class="text-xs-center">Action</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($todolist as $todo)
                                                <tr>
                                                    <td>
                                                        @php
                                                        $user_name=\App\Todolist::ConvertIdtoName($todo->user_id);
                                                        @endphp
                                                        <div>{{$user_name}}</div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/todolist/'.$todo->id.'/edit') }}">{{$todo->name }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                       <div>
                                                            {{ date('d-m-Y', strtotime($todo->dateassigned)) }}
                                                        </div>
                                                    </td>
                                                     <td>
                                                       <div>
                                                       @if($todo->datecompleted!=null)
                                                            {{ date('d-m-Y', strtotime($todo->datecompleted)) }}
                                                       @endif
                                                       </div>
                                                    </td>
                                                     <td>
                                                       <div>{{$todo->task}}</div>
                                                    </td>
                                                     <td>
                                                       <div>{{$todo->status}}</div>
                                                    </td>
                                                    <td>
                                                        <strong>{{$todo->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/todolist/'.$todo->id.'/edit') }}'">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/todolist/'.$todo->id.'/delete') }}')">Delete</button>
                                                    </div>
                                                </td>
                                                   
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="8" align="right">
                                                        <nav>
                                                            {{$todolist->links()}}
                                                        </nav>
                                                    </td>
                                                </tr>
                                            </tbody>
                                </table>
                
                </div>
                </div>
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

