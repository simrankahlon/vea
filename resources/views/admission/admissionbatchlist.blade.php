@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            
            <li class="breadcrumb-item"><a href="{{ url('/admission') }}">Admission</a></li>
            <li class="breadcrumb-item active">{{ $standard }} - {{ $batch->batchname}}</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    
                    <a class="btn btn-secondary" href="{{ url('/admission/create') }}"><i class="icon-plus"></i> &nbsp;Create Admission </a>
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
                <form action="{{ url('/admission/'.$batch->id.'/'.$standard.'/search') }}" method="get" id="frmserch">
                    {{ csrf_field() }}
                  
                    <input name ="searchtxt" type="text" class="form-control left" id="searchtxt" placeholder="Search Admission" value="{{ $search }}" > <span style="color:red">{{ $errors->first('searchtxt') }}</span>
                    </div>
                    <button type="submit"  form="frmserch" class="btn btn-primary right" style="margin-left:-15px;height:35px;width:65px;">Go</button>  
                </form>
            </div>
        </div><!---END DIV ROW-->
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
                                                    <th class="text-xs-center">Date</th>
                                                    <th class="text-xs-center">Name</th>
                                                    <th class="text-xs-center">Number</th>
                                                    <th class="text-xs-center">Activity</th>
                                                    <th class="text-xs-center">Action</th>
                                                    <th class="text-xs-center">Fee Add</th>
                                                    <th class="text-xs-center">Fee Details</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tasks-list">
                                             @foreach ($admission as $adm)
                                                <tr>
                                                    <td>
                                                        <div>{{ date('d-m-Y', strtotime($adm->date)) }}</div>
                                                    </td>
                                                    
                                                    <!-- <td>
                                                        <div>{{$adm->date}}</div>
                                                    </td> -->
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
                                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="javascript:confirmDelete('{{ url('/admission/'.$adm->id.'/delete') }}')" disabled="">Delete</button>
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
                                                        @else
                                                        PENDING
                                                        @endif
                                                        </a></div>
                                                        @else
                                                        <div><strong>1st Inst (On Admission) :</strong>@if($adm->installment_date1!="")
                                                        <a href="{{ url('/admission/'.$adm->id.'/1'.'/viewfeereceipt') }}">
                                                        PAID
                                                        @else
                                                        <a href="#">
                                                        PENDING
                                                        @endif
                                                        </a></div>
                                                        <div><strong>2nd Installment :</strong>
                                                        @if($adm->installment_date2!="")
                                                        <a href="{{ url('/admission/'.$adm->id.'/2'.'/viewfeereceipt') }}">
                                                        PAID
                                                        @else
                                                        <a href="#">
                                                        PENDING
                                                        @endif
                                                        </a></div>
                                                        <div><strong>3rd Installment :</strong>
                                                        @if($adm->installment_date3!="")
                                                        <a href="{{ url('/admission/'.$adm->id.'/3'.'/viewfeereceipt') }}">
                                                        PAID
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
                                                    <td colspan="8" align="right">
                                                        <nav>
                                                            {{$admission->links()}}
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
</script>
@endsection