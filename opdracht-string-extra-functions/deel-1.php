<?php
  $fruit = "kokosnoot";
  $fruitlen = strlen($fruit);
  $fruitposo = strpos($fruit, "o");
 ?>
 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Opdracht Kokosnoot</title>
  </head>
  <body>
    <p><?= $fruitlen ?> </p>
    <p><?= $fruitposo ?> </p>
  </body>
</html>
