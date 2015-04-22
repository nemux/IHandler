<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<table>
    <thead>
    <tr>

        <th>
            IP
        </th>
        <th>Ocurrencias</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($ips as $ip): ?>
        <tr>
            <td>
                <?php echo $ip->ip_rgx; ?>
            </td>
            <td>
                <?php echo $ip->total; ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>
