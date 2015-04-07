<html>
  <head>
    <title></title>
  </head>
  <body>
    <?php if (isset($token)){ ?>
        Token de confirmación: <?php echo $token; ?> 
    <?php }else{ ?>
        Registrado Usuario: <?php echo $user ?><br>
        pass: <?php echo $pass ?>
      <?php } ?>
  </body>
</html>
