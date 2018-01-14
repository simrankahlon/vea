@extends('layouts.pdf')
@section('content')
<br>
<br>
<div class="page1">
<table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;" width="60%"></th>
        <th style="border:0px;" width="0%"></th> 
        <th style="border:0px;" width="40%"></th>
        </tr>
        <tr>
        <td>
             <div class="h4 text-primary mb-0 mt-h">Branch : <span class="text-muted">{{$admission->branch}}</span></div>
        </td>
        <td>
        </td>
        </tr>
        <tr>
        <td width="100%">
            <div class="h4 text-primary mb-0 mt-h">Student Name : <span class="text-muted">{{$admission->studentname}}</span></div>
        </td>
        <td>
        </td>
        <td>
        </td>
        </tr>
        <tr>
        <td width="100%">
             <div class="h4 text-primary mb-0 mt-h">Std : <span class="text-muted">{{$admission->standard}}</span> </div>
        </td>
        <td>
        </td>
        <td width="100%">
             <div class="h4 text-primary mb-0 mt-h ">Batch : <span class="text-muted">{{$admission->admissionbatch}}</span> </div>
        </td>
        </tr>
 </table>
 <br>
 <br>
        @if($has_enquiry==1)
        <div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">Enquiry Details : </div>
        <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;" width="60%"></th>
        <th style="border:0px;" width="0%"></th> 
        <th style="border:0px;" width="40%"></th>
        </tr>
        <tr>
        <td>
             <div class="h4 text-primary mb-0 mt-h">Enquiry Date : <span class="text-muted">{{ date('d-m-Y', strtotime($enquiry->date)) }}</span></div>
        </td>
        <td>
        </td>
        </tr>
        <tr>
        <td width="100%">
            <div class="h4 text-primary mb-0 mt-h">School Name : <span class="text-muted">
                @if($enquiry->school=='OTHERS')
                {{$enquiry->otherschool}}
                @else
                    @foreach(App\Http\AcatUtilities\Schools::all() as $value => $code)
                        @if($code==$enquiry->school)
                        {{$value}}
                        @endif
                    @endforeach
                @endif
            </span></div>
        </td>
        <td>
        </td>
        <td>
        </td>
        </tr>
        <tr>
        <td>
             <div class="h4 text-primary mb-0 mt-h">Father's no : <span class="text-muted">{{$enquiry->fatherno}}</span> </div>
        </td>
        <td>
        </td>
        <td>
        </td>
        </tr>
        <tr>
        <td>
            <div class="h4 text-primary mb-0 mt-h ">Mother's no : <span class="text-muted">{{$enquiry->motherno}}</span> </div>
        </td>
        <td>
        </td>
        <td>
        </td>
        </tr>
        <tr>
        <td>
             <div class="h4 text-primary mb-0 mt-h ">Landline : <span class="text-muted">{{$enquiry->landline}}</span> </div>
        </td>
        <td>
        </td>
        <td>
        </td>
        </tr>
 </table>
 <br>
 <br>
 <div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">Orientation Details : </div>
 <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;" width="30%"></th>
        <th style="border:0px;" width="20%"> <div class="h4 text-primary mb-0 mt-h ">Date </div></th> 
        <th style="border:0px;" width="30%"> <div class="h4 text-primary mb-0 mt-h ">Response</div> </th>
        <th style="border:0px;" width="20%"> <div class="h4 text-primary mb-0 mt-h ">Attendance</div></th>
        </tr>
        <tr>
            <td>
            <div class="h4 text-primary mb-0 mt-h ">Orientation 1 </div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($enquiry->date1)) }}</div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{$enquiry->response1}}</div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{$enquiry->attendance1}}</div>
            </td>
        </tr>
        <tr>
            <td>
            <div class="h4 text-primary mb-0 mt-h ">Orientation 2 </div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($enquiry->date2)) }}</div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{$enquiry->response2}}</div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{$enquiry->attendance2}}</div>
            </td>
        </tr>
        <tr>
            <td>
            <div class="h4 text-primary mb-0 mt-h ">Orientation 3 </div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($enquiry->date3)) }}</div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{$enquiry->response3}}</div>
            </td>
            <td>
            <div class="h4 text-muted mb-0 mt-h ">{{$enquiry->attendance3}}</div>
            </td>
        </tr>
        
 </table>
        @else
        <div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">No Enquiry Details Present</div>
        @endif

</div>
</div>
<br>
<br>
<div class="page1">
<div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">Fee Details : </div>
 <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Installment</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Date</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Mode of Payment</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Receipt Id</div></th>
            @if($admission->receipt_no1!=null)
            <tr>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">1st Installment (On Admission)</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($admission->installment_date1)) }}</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->installment_mode1}}</div>
                    @if($admission->installment_mode1=='CHEQUE')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank1}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Branch : {{$admission->branch1}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Cheque no : {{$admission->chequeno1}}</div>
                    @elseif($admission->installment_mode1=='ONLINEPAYMENT')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank_transactionid1}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Trans Id : {{$admission->transactionid1}}</div>
                    @endif
                </td>
                 <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->receipt_no1}}</div>
                </td>
            </tr>
            @endif
            @if($admission->receipt_no2!=null)
            <tr>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">2nd Installment</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($admission->installment_date2)) }}</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->installment_mode2}}</div>
                    @if($admission->installment_mode2=='CHEQUE')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank2}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Branch : {{$admission->branch2}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Cheque no : {{$admission->chequeno2}}</div>
                    @elseif($admission->installment_mode2=='ONLINEPAYMENT')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank_transactionid2}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Trans Id : {{$admission->transactionid2}}</div>
                    @endif
                </td>
                 <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->receipt_no2}}</div>
                </td>
            </tr>
            @endif
            @if($admission->receipt_no3!=null)
            <tr>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">3rd Installment</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($admission->installment_date3)) }}</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->installment_mode3}}</div>
                    @if($admission->installment_mode3=='CHEQUE')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank3}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Branch : {{$admission->branch3}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Cheque no : {{$admission->chequeno3}}</div>
                    @elseif($admission->installment_mode3=='ONLINEPAYMENT')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank_transactionid3}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Trans Id : {{$admission->transactionid3}}</div>
                    @endif
                </td>
                 <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->receipt_no3}}</div>
                </td>
            </tr>
            @endif
            @if($admission->receipt_no0!=null)
            <tr>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">Full Payment</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($admission->installment_date0)) }}</div>
                </td>
                <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->installment_mode0}}</div>
                    @if($admission->installment_mode0=='CHEQUE')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank0}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Branch : {{$admission->branch0}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Cheque no : {{$admission->chequeno0}}</div>
                    @elseif($admission->installment_mode0=='ONLINEPAYMENT')
                    <div class="h4 text-muted mb-0 mt-h ">Bank : {{$admission->bank_transactionid0}}</div>
                    <div class="h4 text-muted mb-0 mt-h ">Trans Id : {{$admission->transactionid0}}</div>
                    @endif
                </td>
                 <td>
                    <div class="h4 text-muted mb-0 mt-h ">{{$admission->receipt_no0}}</div>
                </td>
            </tr>
            @endif
        </tr>
</table>
</div>
<div class="page1">
<div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">Marks Details : </div>
 <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Date</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Topic </div></th> 
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Portion </div></th> 
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Total Marks</div> </th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Pass. Marks</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Marks Obt.</div></th>
        </tr>
        @foreach($marks as $mark)
        <tr>
        <td><div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($mark->date)) }}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->topic_name}}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->portion}}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->total_marks}}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->passing_marks}}</div></td>
        <td>
            @php
                $found=0;
                $displayed=0;
            @endphp
            @foreach($admission->marks as $ad)
                @if($ad->pivot->mark_id==$mark->id)
                    @if($ad->pivot->marks_obtained < $mark->passing_marks)
                        <div class="h4 text-danger mb-0 mt-h ">{{$ad->pivot->marks_obtained}}</div>
                    @else
                        <div class="h4 text-muted mb-0 mt-h ">{{$ad->pivot->marks_obtained}}</div>
                    @endif
                    @php
                        $displayed=1;
                    @endphp
                @endif
                @php
                    $dislayed=0;
                @endphp
            @endforeach
            @if($found==0 && $displayed!=1)
                <div class="h4 text-muted mb-0 mt-h "> - </div>
            @endif
        </td>
        </tr>
        @endforeach
</table>
</div>
<br>
<br>
<div class="page1">
<div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">School Marks Details : </div>
 <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Date</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Topic </div></th> 
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Portion </div></th> 
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Total Marks</div> </th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Pass. Marks</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h ">Marks Obt.</div></th>
        </tr>
        @foreach($schoolmarks as $mark)
        <tr>
        <td><div class="h4 text-muted mb-0 mt-h ">{{ date('d-m-Y', strtotime($mark->date)) }}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->topic_name}}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->portion}}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->total_marks}}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$mark->passing_marks}}</div></td>
        <td>
            @php
                $found=0;
                $displayed=0;
            @endphp
            @foreach($admission->schoolmarks as $ad)
                @if($ad->pivot->schoolmark_id==$mark->id)
                    @if($ad->pivot->schoolmarks_obtained < $mark->passing_marks)
                        <div class="h4 text-danger mb-0 mt-h ">{{$ad->pivot->schoolmarks_obtained}}</div>
                    @else
                        <div class="h4 text-muted mb-0 mt-h ">{{$ad->pivot->schoolmarks_obtained}}</div>
                    @endif
                    @php
                        $displayed=1;
                    @endphp
                @endif
                @php
                    $dislayed=0;
                @endphp
            @endforeach
            @if($found==0 && $displayed!=1)
                <div class="h4 text-muted mb-0 mt-h "> - </div>
            @endif
        </td>
        </tr>
        @endforeach
</table>
</div>
<br>
<br>
<div class="page1">
<div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">Attendance Details : </div>
 <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> No. of Lectures</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Lectures Attended </div></th>
        <tr>
        <td><div class="h4 text-muted mb-0 mt-h ">{{ $attendancecount }}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$attended}}</div></td>
        </tr>
</table>

<br>
<br>
@if($admission->remedial_list==1)
<div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">Remedial Details : </div>
 <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Remedial Branch</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Remedial Batch </div></th>
        <tr>
        <td><div class="h4 text-muted mb-0 mt-h ">{{ $admission->remedialbranch }}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{ $admission->remedialbatch }}</div></td>
        </tr>
</table>

<br>
<br>
<div class="h3 text-success mb-0 mt-h" style="font-style: Bold; font-size: 30px;">Remedial Attendance Details : </div>
 <table border="0px" width="100%" cellpadding="5" style="table-layout: fixed;">
        <tr>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> No. of Lectures</div></th>
        <th style="border:0px;"><div class="h4 text-primary mb-0 mt-h "> Lectures Attended </div></th>
        <tr>
        <td><div class="h4 text-muted mb-0 mt-h ">{{ $remedialattendance }}</div></td>
        <td><div class="h4 text-muted mb-0 mt-h ">{{$remedialattended}}</div></td>
        </tr>
</table>
@endif
</div>

@endsection
