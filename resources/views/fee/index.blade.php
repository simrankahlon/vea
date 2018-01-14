@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item active">Fee</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="{{ url('/fee/create') }}"><i class="icon-plus"></i> &nbsp;Create Fee Structure </a>
                </div>
            </li>
        </ol>
@endsection

@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>Standard</th>
                                                    <th>1st Installment (On Admission)</th>
                                                    <th>2nd Installment</th>
                                                    <th>3rd Installment</th>
                                                    <th>Total</th>
                                                    <th>Activity</th>
                                                    <th>Action</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($fee as $fe)
                                                <tr>
                                                    <td>
                                                        @foreach(App\Http\AcatUtilities\Standard::all() as $value => $code)
                                                            @if($fe->standard == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                        <div><strong>C.GST % </strong>{{$fe->cgst}}</div>
                                                        <div><strong>S.GST % </strong>{{$fe->sgst}}</div>
                                                    </td>
                                                    <td>
                                                        <div><strong>Installment : </strong>{{$fe["1stinstallment"]}}</div>
                                                        <div><strong>GST : </strong>{{$fe["1gst"]}}</div>
                                                        <div><strong>Total : </strong>{{$fe["1total"]}}</div>
                                                       
                                                    </td>
                                                    <td>
                                                        <div><strong>Installment : </strong>{{$fe["2ndinstallment"]}}</div>
                                                        <div><strong>GST : </strong>{{$fe["2gst"]}}</div>
                                                        <div><strong>Total : </strong>{{$fe["2total"]}}</div>
                                                    </td>
                                                    <td>
                                                        <div><strong>Installment : </strong>{{$fe["3rdinstallment"]}}</div>
                                                        <div><strong>GST : </strong>{{$fe["3gst"]}}</div>
                                                        <div><strong>Total : </strong>{{$fe["3total"]}}</div>
                                                    </td>
                                                    <td>
                                                        <div><strong>Installment : </strong>{{$fe->totalinstallment}}</div>
                                                        <div><strong>GST : </strong>{{$fe->totalgst}}</div>
                                                        <div><strong>Total : </strong>{{$fe->totalfee}}</div>
                                                    </td>
                                                    <td>
                                                        <strong>{{$fe->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                   <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/fee/'.$fe->id.'/edit') }}'">Edit</button>
                                                    <!-- <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/fee/'.$fe->id.'/delete') }}')" disabled="">Delete</button> -->
                                                    </div>
                                                </td>
                                                   
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="7" align="right">
                                                        <nav>
                                                            {{$fee->links()}}
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


