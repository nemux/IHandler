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
<table align="center" width="600" style="border: #666666 1px solid;" cellpadding="0" cellspacing="0">
    <tr>        <td bgcolor="#efefef" style="border-bottom: #666666 1px solid;" ><br>
            <table border="0" align="center">
                <TR>
                    <TD><img src="{{ $message->embed('assets/img/banner_email.png') }}" alt="" border="0"></TD>
                </TR>
            </table>
            <br>
        </td>
    </tr>
    <tr>
        <td><table width="510" border="0" cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <td><p style="font-family: arial,  helvetica, sans-serif;font-size: 25px;color: #666666;"><br>{{ $title }}</p>
                        <p style="font-family: arial,  helvetica, sans-serif;font-size: 15px;color: #666666;">{{ $subtitle }}</p>
                        <p style="font-family: arial,  helvetica, sans-serif;font-size: 12px;color: #666666;">{{ $body  }} </p>
                        <br>
                        <font face="Verdana, Arial, Helvetica, sans-serif" color="#666666" size="1">El Equipo de Respuesta a Incidentes<br />Global Cybersec<br />csirt@globalcybersec.com<br/><a href="http://www.globalcybersec.com/">http://www.globalcybersec.com/</a></font><br><br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
