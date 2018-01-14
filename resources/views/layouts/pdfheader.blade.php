<!DOCTYPE html>
<!-- Main styles for this application -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<body style="background-color:#FFF">
<table border="0" width="100%">
    <tr>
        <td width="50%">
            <h2>Vikram's English Academy</h2>
        </td>
        <td width="50%" align="right">
            <img src="{{ asset('img/vealogo.png') }}" width="160px" height="120px" alt="Logo">
        </td>
    </tr> 
    <tr>
        <td width="100"%>
            @if($admission->branch=='BHANDUP')
            <h6>202, Kailash Commercial Complex, Above Jolly Studio,Opp Dreams Mall, LBS Marg, Bhandup West.<img src="{{ asset('img/phone.png') }}" width="25px" height="25px" alt="Logo"> 9769246667 </h6>
            @else
            <h6>305,Jay Commerical Plaza,M.G. Road,Mulund (W),Mumbai 80 <img src="{{ asset('img/phone.png') }}" width="25px" height="25px" alt="Logo">  022-25602727,9833602727</h6>
            @endif
        </td>
    <tr>       
</table>
<hr>
</body>
