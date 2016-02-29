<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{$ticket->title}}</title>
</head>
<body style="width: 100%; height: auto;">
<table align="center" cellspacing="0" cellpadding="0" style="border: 4px solid #BBB;width: 50%;min-width: 500px;">
    <tbody>
    <tr>
        <td colspan="2"
            style="text-align: center;background-color: #DDD;width: 25%; border: 1px solid #BBB;padding: 5px;">
            <h1 style="text-align: center;margin: 0;">{{$ticket->title}} {{$ticket->status->name}}</h1></td>
    </tr>
    <tr>
        <td style="text-align: center;background-color: #DDD;width: 25%; border: 1px solid #BBB;padding: 5px;">Folio
        </td>
        <td style="text-align: center;background-color: #EEE;width: 75%; border: 1px solid #BBB;padding: 5px;">
            <strong>{{$ticket->internal_number}}</strong></td>
    </tr>
    <tr>
        <td style="text-align: center;background-color: #DDD;width: 25%; border: 1px solid #BBB;padding: 5px;">Cliente
        </td>
        <td style="text-align: center;background-color: #EEE;width: 75%; border: 1px solid #BBB;padding: 5px;">{{$ticket->customer->name}}</td>
    </tr>
    <tr>
        <td style="text-align: center;background-color: #DDD;width: 25%; border: 1px solid #BBB;padding: 5px;">Severidad
        </td>
        <td style="text-align: center;width: 75%; border: 1px solid #BBB;padding: 5px; color: white; background-color: @if($ticket->criticity->id==1)#CC3F44 @elseif($ticket->criticity->id==2)#ff7900 @elseif($ticket->criticity->id==3)#f7cc31 @endif;">{{$ticket->criticity->name}}</td>
    </tr>
    <tr>
        <td colspan="2"
            style="background-color: #FFF;padding: 20px;text-align: justify; width: 25%; border: 1px solid #BBB;"><strong>{{$ticket_message->handler->person->fullName()}}:</strong> {!! $ticket_message->message !!}</td>
    </tr>
    </tbody>
</table>
</body>
</html>