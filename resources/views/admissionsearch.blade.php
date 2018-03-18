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
                                                    <th>Batch</th>
                                                    <th>Name</th>
                                                    <th>Number</th>
                                                    <th>Activity</th>
                                                    
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
                                                    <td><div>{{$adm->standard}}</div></td>
                                                    <td><div>{{$adm->admissionbatch}}</div></td>
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
                                                    
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="7" align="right">
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
