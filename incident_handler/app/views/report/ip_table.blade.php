<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Global Cybersec</title>
    <style>
        a:link {
            color:#046380;
            text-decoration:underline;
        }
        a:visited {
            color:#A7A37E;
            text-decoration:none;
        }
        a:hover {
            color:#002F2F;
            text-decoration:underline;
        }
        a:active {
            color:#046380;
            text-decoration:none;
        }
    </style>
</head>
<body>

<p>A continuaci&oacute;n se presenta el reporte de IP por {{ $type =="source_id" ? "Origen":"Destino" }} del periodo {{ $start_date }} a {{ $end_date }}.</p>

<table align="center" width="300" style="border: #666666 1px solid;" cellpadding="0" cellspacing="0">
    {{--*/ $i = 0; /*--}}
    @foreach($iplist as $ip)
        @if($i%2 == 0)
            <tr>
                <td><p style="font-family: arial,  helvetica, sans-serif;font-size: 12px;color: #666666;"><br>{{ $ip->ip }}</p></td>
            </tr>
        @else
            <tr>
                <td bgcolor="#efefef"><p style="font-family: arial,  helvetica, sans-serif;font-size: 12px;color: #666666;"><br>{{ $ip->ip }}</p></td>
            </tr>
        @endif
        {{--*/ $i++; /*--}}
    @endforeach
</table>
</body>
</html>