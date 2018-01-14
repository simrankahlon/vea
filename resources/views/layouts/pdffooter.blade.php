<!DOCTYPE html>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<body style="background-color:#FFF">
<hr>
<table border="0" width="100%">
    <tr>
        <td width="70%" align="left">
            <span class="text-muted font-weight-bold font-xs">Batch timings are the sole discreation of the institute.</span>
        </td>
        <td width="30%" align="right">
            <span class="text-muted text-uppercase font-weight-bold font-xs">
                GSTIN : 27ADSPC6946J1ZZ
            </span>
        </td>
    </tr>
    <tr>
        <td width="70%" align="left">
            <span class="text-muted font-weight-bold font-xs">Fees once paid will neither be refunded nor adjusted under any circumstances</span>
        </td>
        <td width="30%" align="right">
            <span class="text-muted text-uppercase font-weight-bold font-xs">
            	@php
            	//$mytime = Carbon\Carbon::now();
				//echo $mytime->toDateTimeString();

				$ldate = date('d-M-Y H:i:s');
				echo $ldate;
            	@endphp
            </span>
        </td>
    </tr>    
</table>
</body>
