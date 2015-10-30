<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GCS | Nuevo Usuario</title>
</head>
<body>
<h4>Se ha creado un nuevo usuario para <b>{{$user->person->fullName()}}</b></h4>
<table>
    <tr>
        <td>Nombre de usuario:</td>
        <td><b>{{$user->username}}</b></td>
    </tr>
    <tr>
        <td>Contraseña:</td>
        <td><b>{{$password}}</b></td>
    </tr>
</table>
</body>
</html>