<html>

  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table >
        <thead>
            <tr>

                <th>
                  IP
                </th>
                <th>Origen</th>


            </tr>
        </thead>
        <tbody>
          <?php foreach ($blacklist as $b): ?>
            <?php if (preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', str_replace(" ","",$b->ip)) && strlen($b->location)>3): ?>
              <tr>
                <td>
                  <?php echo $b->ip ?>
                </td>
                <td>
                  <?php echo ucwords(strtolower($b->location)); ?>
                </td>
              </tr>
            <?php endif ?>
          <?php endforeach ?>
        </tbody>
    </table>
  </body>
</html>
