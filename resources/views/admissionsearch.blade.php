@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a></li>
            <li class="breadcrumb-item active">Search Result</li>
            
</ol>
@endsection
@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                    <table class="table table-hover table-outline mb-0 hidden-sm-down enquiry">
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>School</th>
                                                    <th>Standard</th>
                                                    <th>Name</th>
                                                    <th>Number</th>
                                                    <th>Activity</th>
                                                    <th>Action</th>
                                                    <th>Fee Add</th>
                                                    <th>Fee Details</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($admission as $adm)
                                                <tr>
                                                    <td>
                                                        <div>{{ date('d-m-Y', strtotime($adm->date)) }}</div>
                                                    </td>
                                                    <td>
                                                        @if($adm->school=='OTHERS')
                                                            <div>{{$adm->otherschool}}</div>
                                                        @else
                                                        @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                                                            @if($adm->school == $code)
                                                                <div>{{$value}}</div>
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div>{{$adm->standard}}</div>
                                                        <div>{{$adm->admissionbatch}}</div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ url('/admission/'.$adm->id.'/list') }}">{{$adm->studentname }}</a>
                                                        </div>
                                                    </td>
                                                    @php
                                                    $value=1;
                                                    $text=$adm->whatsappon;
                                                    @endphp
                                                    @if($text=='MCELL')
                                                    @php
                                                    $value=2;
                                                    @endphp
                                                    @elseif($text=='FCELL')
                                                    @php
                                                    $value=3;
                                                    @endphp
                                                    @endif
                                                    <td>
                                                        <div>
                                                        @if($value==3)
                                                        <img src="{{ asset('img/whatsapp.jpg') }}" class="img-avatar" alt="{{ Auth::user()->name }}" height="22px" width="22px">
                                                        @else
                                                        @endif
                                                        F No. : 
                                                        {{$adm->fatherno}}
                                                        </div>
                                                        <div>
                                                        @if($value==2)
                                                        <img src="{{ asset('img/whatsapp.jpg') }}" class="img-avatar" height="22px" width="22px" alt="{{ Auth::user()->name }}">
                                                        @else
                                                        @endif
                                                        M No. : 
                                                        {{$adm->motherno}}
                                                        </div>
                                                        <div>Landline : 
                                                        {{$adm->landline}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <strong>{{$adm->updated_at->diffForHumans()}}</strong>
                                                    </td>
                                                    <td>
                                                    <div class="float-xs-right"> 
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ url('/admission/'.$adm->id.'/edit') }}'">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/admission/'.$adm->id.'/delete') }}')">Delete</button>
                                                    <a href="{{ url('/admission/'.$adm->id.'/report') }}" style="color:purple" target="_blank">REPORT</a>
                                                    @if($adm->standard!='X')
                                                    <a href="{{ url('/admission/'.$adm->id.'/transferadm') }}" style="color:green">TRANSFER</a>
                                                    @endif
                                                    @if($adm->remedial_list === 1)
                                                    <a href="{{ url('/admission/'.$adm->id.'/remedialdetails') }}" style="color:maroon">REMEDIAL</a>
                                                    @endif
                                                    </div>
                                                    </td>
                                                    @php
                                                    $first=1;
                                                    $second=2;
                                                    $third=3;
                                                    $full=0;
                                                    @endphp
                                                    <td>
                                                    <div class="float-xs-right">
                                                    <select id="admission-{{$adm->id}}" name="admission-actions[]" class="form-control" onchange="javascript:confirmChange(this.value,{{$adm->id}})">
                                                        <option value="pleaseselect">Please select</option>
                                                        @if($adm->installment_date0!="")
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$first.'/fee') }}" disabled="">1st Installment</option>
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$second.'/fee') }}" disabled="">2nd Installment</option>
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$third.'/fee') }}" disabled="">3rd Installment</option>
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$full.'/fee') }}">Full Payment</option>
                                                        @else
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$first.'/fee') }}">1st Installment</option>
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$second.'/fee') }}">2nd Installment</option>
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$third.'/fee') }}">3rd Installment</option>
                                                        @if($adm->installment_date1!="" or $adm->installment_date2!="" or $adm->installment_date3!="")
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$full.'/fee') }}" disabled="">Full Payment</option>
                                                        @else
                                                        <option value="{{ url('/admission/'.$adm->id.'/'.$full.'/fee') }}">Full Payment</option>
                                                        @endif
                                                        @endif
                                                    </select>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        @if($adm->installment_date0!="")
                                                        <div><strong>Full Payment :</strong>
                                                        <a href="{{ url('/admission/'.$adm->id.'/0'.'/viewfeereceipt') }}">@if($adm->installment_date0!="")
                                                        PAID
                                                        @if($adm->mail_receipt0==1) <span style="color:red"> *</span>
                                                        @endif
                                                        @else
                                                        PENDING
                                                        @endif
                                                        </a></div>
                                                        @else
                                                        <div><strong>1st Inst (On Admission) :</strong>@if($adm->installment_date1!="")
                                                        <a href="{{ url('/admission/'.$adm->id.'/1'.'/viewfeereceipt') }}">
                                                        PAID
                                                        @if($adm->mail_receipt1==1) <span style="color:red"> *</span>
                                                        @endif
                                                        @else
                                                        <a href="#">
                                                        PENDING
                                                        @endif
                                                        </a></div>
                                                        <div><strong>2nd Installment :</strong>
                                                        @if($adm->installment_date2!="")
                                                        <a href="{{ url('/admission/'.$adm->id.'/2'.'/viewfeereceipt') }}">
                                                        PAID
                                                        @if($adm->mail_receipt2==1) <span style="color:red"> *</span>
                                                        @endif
                                                        @else
                                                        <a href="#">
                                                        PENDING
                                                        @endif
                                                        </a></div>
                                                        <div><strong>3rd Installment :</strong>
                                                        @if($adm->installment_date3!="")
                                                        <a href="{{ url('/admission/'.$adm->id.'/3'.'/viewfeereceipt') }}">
                                                        PAID
                                                        @if($adm->mail_receipt3==1) <span style="color:red"> *</span>
                                                        @endif
                                                        @else
                                                        <a href="#">
                                                        PENDING
                                                        @endif
                                                        </a></div>
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="9" align="right">
                                                        <nav>
                                                            {{$admission->appends(Request::only('searchtxt'))->links()}}
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
function confirmChange(Url,id) {
document.location = Url;
  }

$(document).ready(function($){
  $('select').find('option[value=pleaseselect]').attr('selected','selected');
});

function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
   document.location = delUrl;
  }
}

</script>
@endsection
