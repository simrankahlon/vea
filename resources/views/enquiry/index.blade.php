@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">Enquiry</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="{{ url('/enquiry/create') }}"><i class="icon-plus"></i> &nbsp;Create Enquiry </a>
                </div>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/orientation/list') }}"><i class="icon-plus"></i> &nbsp;View Orientation </a>
                </div>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/waiting_list/list') }}"><i class="icon-plus"></i> &nbsp;View Waiting List </a>
                </div>
            </li>
        </ol>
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <form action="{{ url('/enquiry/filters') }}" method="get" id="enquiry_filter">
            {{ csrf_field() }}
            <div class="col-xs-5">
                @php
                    $search = (isset($_GET['filters'])) ? htmlentities($_GET['filters']) : '';
                @endphp
                <select id="filters" name="filters" class="form-control" size="1">
                        <option value="">Please select</option>
                        @foreach(App\Http\AcatUtilities\Filters::all() as $value => $code)
                            <option value="{{$code}}" @if ($search == $code) selected="selected" @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <span style="color:red">{{ $errors->first('filters') }}</span>
            </div>
            <div class="col-xs-6"> 
                @php
                    $search_schools = (isset($_GET['filters_school'])) ? htmlentities($_GET['filters_school']) : '';
                @endphp
                
                    <!--  <div class="form-control"> -->

                    <select id="filters_school" name="filters_school" class="form-control" size="1">
                        <option value="">Please select</option>
                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                            <option value="{{$code}}" @if ($search_schools == $code) selected="selected" @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <span style="color:red">{{ $errors->first('filters_school') }}</span>
            </div>
                    <button type="submit"  form="enquiry_filter" class="btn btn-primary right"  style="margin-left:-15px;height:39px">Filter</button> 
            </form>
                <br><br>
            <div class="col-xs-6">
            </div>
            <div class="col-xs-5">
                @php
                    $search = (isset($_GET['searchtxt'])) ? htmlentities($_GET['searchtxt']) : '';
                @endphp
                <form action="{{ url('/enquiry/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                    <!--  <div class="form-control"> -->
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Enquiry" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
                    </div>
                    <button type="submit"  form="frmserch" class="btn btn-primary right" style="margin-left:-15px;height:35px;width:65px;">Go</button>  
                </form>
            </div>
        </div><!--END DIV ROW-->
    </div><!--END CARD-BLOCK-->
@php
    $url= url("/");                                               
@endphp
<input type="hidden"  value="{{$url}}" id="url"/>

<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>WL</th>
                                                    <th>Class</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>School</th>
                                                    <th>F No.</th>
                                                    <th>M No.</th>
                                                    <th>Landline</th>
                                                    <th>Activity</th>
                                                    <th>Action</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($enquiry as $enq)
                                                <tr>
                                                    <td>
                                                        <div class="checkbox">
                                                            <label for="checkbox1">
                                                                @if($enq->waiting_list==1)
                                                                    <input type="checkbox" id="waiting_list" name="waiting_list" class="waiting_list" value="{{$enq->id}}" checked>
                                                                @elseif($enq->adm_id!=null)
                                                                    <input type="checkbox" id="waiting_list" name="waiting_list" class="waiting_list" value="{{$enq->id}}" disabled="">
                                                                @else
                                                                    <input type="checkbox" id="waiting_list" name="waiting_list" class="waiting_list" value="{{$enq->id}}">
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                                            @if($enq->standard == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div>
                                                        {{ date('d-m-Y', strtotime($enq->date)) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/enquiry/'.$enq->id.'/edit') }}">{{$enq->name }}</a>
                                                            @if($enq->date1=="")
                                                            <span style="color:red;font-size:22px;"> *</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                    @if($enq->school=='OTHERS')
                                                        <div>{{$enq->otherschool}}</div>
                                                    @else
                                                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                                                            @if($enq->school == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    </td>
                                                    <td>
                                                        @if(empty($enq->fatherno))
                                                        <div><center>....</center></div>
                                                        @else
                                                        <div>{{$enq->fatherno}}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(empty($enq->motherno))
                                                        <div><center>....</center></div>
                                                        @else
                                                        <div>{{$enq->motherno}}</div>
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        @if(empty($enq->landline))
                                                        <div><center>....</center></div>
                                                        @else
                                                        <div>{{$enq->landline}}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong>{{$enq->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/enquiry/'.$enq->id.'/edit') }}'">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/enquiry/'.$enq->id.'/delete') }}')">Delete</button>
                                                    <button type="button"  value="{{$enq->id}}" class="btn btn-outline-success btn-sm open-orientation">Orientation</button>
                                                    @if($enq->adm_id!=null)
                                                    <button type="button"  value="{{$enq->id}}" class="btn btn-outline-warning btn-sm" onclick="window.location.href='{{ url('/admission/'.$enq->id.'/add') }}'" disabled="">Admission</button>
                                                    @else
                                                    <button type="button"  value="{{$enq->id}}" class="btn btn-outline-warning btn-sm" onclick="window.location.href='{{ url('/admission/'.$enq->id.'/add') }}'">Admission</button>
                                                    @endif
                                                    </div>
                                                </td>
                                                   
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="10" align="right">
                                                        <nav>
                                                            {{$enquiry->links()}}
                                                        </nav>
                                                    </td>
                                                </tr>
                                            </tbody>
                                </table>
                
                </div>
                </div>
        </div>
@endsection

@section('modalfun')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add/Edit Orientation Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
            <label for="ename">Enquirer Name:</label>
            <input name ="ename" type="text" class="form-control" id="ename"  placeholder="ename" value="" disabled>
            </div>
            <div class="row">
            <div class="col-md-4">
            <strong>1st Orientation</strong>
          <div class="form-group">
            <label for="date">Date:</label>
            <input name ="date1" type="date" class="form-control" id="date1"  placeholder="Date" value="">
          </div>
          <div class="form-group">
            <label for="response" class="form-control-label">Response:</label>
            <input type="text" class="form-control" id="response1" placeholder="Response" name="response1">
          </div>
          <div class="form-group">
            <label for="attendance">Attendance:</label>
            <select id="attendance1" name="attendance1" class="form-control" size="1">
                <option value="">Please select</option>
                @foreach(App\Http\AcatUtilities\Attendance::all() as $value => $code)
                <option value="{{$code}}">{{$value}}</option>
                @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-4">
            <strong>2nd Orientation</strong>
          <div class="form-group">
            <label for="date">Date:</label>
            <input name ="date2" type="date" class="form-control" id="date2"  placeholder="Date" value="">
          </div>
          <div class="form-group">
            <label for="response" class="form-control-label">Response:</label>
            <input type="text" class="form-control" id="response2" placeholder="Response" name="response2">
          </div>
          <div class="form-group">
            <label for="attendance">Attendance:</label>
            <select id="attendance2" name="attendance2" class="form-control" size="1">
                <option value="">Please select</option>
                @foreach(App\Http\AcatUtilities\Attendance::all() as $value => $code)
                <option value="{{$code}}">{{$value}}</option>
                @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-4">
            <strong>3rd Orientation</strong>
          <div class="form-group">
            <label for="date">Date:</label>
            <input name ="date3" type="date" class="form-control" id="date3"  plaplaceholder="Date">
          </div>
          <div class="form-group">
            <label for="response" class="form-control-label">Response:</label>
            <input type="text" class="form-control" id="response3" placeholder="Response" name="response3">
          </div>
          <div class="form-group">
           <label for="attendance">Attendance:</label>
            <select id="attendance3" name="attendance3" class="form-control" size="1">
                <option value="">Please select</option>
                @foreach(App\Http\AcatUtilities\Attendance::all() as $value => $code)
                <option value="{{$code}}">{{$value}}</option>
                @endforeach
            </select>
          </div>
          </div>
          </div>
          <div class="form-group">
            <label for="remark">Remark :</label>
            <input name ="remark" type="text" class="form-control" id="remark"  placeholder="Remark" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>&nbsp;
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="hidden" id="enquiry_id" name="enquiry_id" value="">
      </div>
    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('javascriptfunctions')
<script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
   document.location = delUrl;
  }
}

$(document).ready(function()
{
        var url = $('#url').val();    
            $('#tasks-list').on('click', '.open-orientation',function()
            { 
                var enquiry_id = $(this).val();

                $.get(url + '/ajax/orientation/'+enquiry_id, function (data) {
                            //success data
                         
                         $('#ename').val(data.name);
                         $('#enquiry_id').val(enquiry_id);
                         $('#date1').val(data.date1);
                         $('#response1').val(data.response1);
                         $('#attendance1').val(data.attendance1);
                         $('#date2').val(data.date2);
                         $('#response2').val(data.response2);
                         $('#attendance2').val(data.attendance2);
                         $('#date3').val(data.date3);
                         $('#response3').val(data.response3);
                         $('#attendance3').val(data.attendance3);
                         $('#remark').val(data.remark);
                         $('#myModal').modal('show');
                        })
            });


            $(".waiting_list").on('click',function()
            { 
               
                var enquiry_id = $(this).val();
                
                var check=0;
                if($(this).is(':checked'))
                {
                    check=1;
                }
                $.ajax
                ({
                    type: "GET",
                    url: url + '/ajax/waiting_list/' + enquiry_id + '/'+check,
                    success: function (data) 
                    {
                        
                    },
                    statusCode: 
                    {
                        401: function()
                        { 
                            window.location.href =url+'/login';
                        }
                    },
                    error: function (data) 
                    {
                        console.log('Error:', data);
                    }
                });
            });

});



$('#btn-save').on('click',function(e){ 

        var date1=$("#date1").val();
        var date2=$("#date2").val();
        var date3=$("#date3").val();

        var attendance1=$("#attendance1").val();
        var attendance2=$("#attendance2").val();
        var attendance3=$("#attendance3").val();

        var response1=$("#response1").val();
        var response2=$("#response2").val();
        var response3=$("#response3").val();

        if(date1!="")
        {
            if(response1=="")
            {
                alert("Please add response for 1st Orientation");
                return false;
            }
        }

        if(date2!="")
        {
            
            if(response2=="")
            {
                alert("Please add response for 2nd Orientation");
                return false;
            }
        }

        if(date3!="")
        {
            if(response3=="")
            {
                alert("Please add response for 3rd Orientation");
                return false;
            }
        }

        $('#myModal').modal('hide');
        var enquiry_id=$('#enquiry_id').val();

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            date1: $('#date1').val(),
            response1: $('#response1').val(),
            attendance1:$('#attendance1').val(),
            date2: $('#date2').val(),
            response2: $('#response2').val(),
            attendance2:$('#attendance2').val(),
            date3: $('#date3').val(),
            response3: $('#response3').val(),
            attendance3:$('#attendance3').val(),
            remark:$('#remark').val(),

        }
        var url = $('#url').val();
        
        var type = "POST";
        

        $.ajax({
            type: type,
            url: url + '/ajax/orientation/'+enquiry_id,
            data: formData,
            dataType: 'json',
            success: function (data) {
            },
            statusCode: 
                    {
                        401: function()
                        { 
                            window.location.href =url+'/login';
                        }
                    },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection


