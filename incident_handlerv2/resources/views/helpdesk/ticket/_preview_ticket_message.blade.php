<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{$message->ticket->title}}</title>
    <style>
        html, body {
            width: 100%;
            height: auto;
        }

        h1, h2, h3, h4, h5, h6 {
            text-align: center;
            margin: 0;
        }

        table {
            border: solid 4px #bbbbbb;
            width: 50%;
            min-width: 500px;
        }

        table tbody tr td {
            border: solid 1px #bbbbbb;
            padding: 5px;
        }

        table tbody tr td:nth-child(1) {
            text-align: center;
            background-color: #dddddd;
            width: 25%;
        }

        table tbody tr td:nth-child(2) {
            text-align: center;
            background-color: #eeeeee;
            width: 75%;
        }

        table tbody tr td.criticity-1 {
            background-color: #CC3F44;
            color: white;
        }

        table tbody tr td.criticity-2 {
            background-color: #ff7900;
            color: white;
        }

        table tbody tr td.criticity-3 {
            background-color: #f7cc31;
            color: white;
        }

        table tbody tr td.message {
            background-color: white;
            padding: 20px;
            text-align: justify;
        }
    </style>
</head>
<body>
<table align="center" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
        <td colspan="2">
            <h1>{{$message->ticket->title}}</h1></td>
    </tr>
    <tr>
        <td>Folio</td>
        <td><strong>{{$message->ticket->internal_number}}</strong></td>
    </tr>
    <tr>
        <td>Cliente</td>
        <td>{{$message->ticket->customer->name}}</td>
    </tr>
    <tr>
        <td>Severidad</td>
        <td class="criticity-{{$message->ticket->criticity->id}}">{{$message->ticket->criticity->name}}</td>
    </tr>
    <tr>
        <td colspan="2" class="message">{!! $message->message !!}</td>
    </tr>
    </tbody>
</table>
</body>
</html>