<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="VEA - Vikram's English Academy">
    <meta name="author" content="VEA">
    <meta name="keyword" content="VEA">
    
    
    

    <title>Vikram's English Academy : VEA</title>
    <!-- Icons -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    
<style type="text/css">
    .allborders {
        border-color: #000;
        border-width: 1px;
        border-style: solid;
    }

    .nt table {
        border-collapse: collapse;
    }
    .nt td, th {
        border: 1px solid orange;
    }
    div.page
    {
        page-break-after: auto;
        page-break-inside: avoid;
    }
    div.page1
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
    

    #table1 td {
    border: solid 1px #D3D3D3;
    }

    #table1 table td {
        border: none;
    }

    thead { display: table-header-group }
    tfoot { display: table-row-group }
    tr { page-break-inside: avoid }

</style>
</head>
<body style="background-color:#FFF">
<!--MAIN CONTENT-->
@yield('content')
<!--/MAIN CONTENT-->
</body>
</html>