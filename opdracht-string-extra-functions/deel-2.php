<?php
  $fruit = "ananas";
  $fruita = strpos($fruit,strrchr($fruit, "a"));
  $fruit = strtoupper($fruit);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Opdracht Ananas</title>
  </head>
  <body>
    <h2><?= $fruita ?></h2>
    <h1><?= $fruit ?></h1>
  </body>
</html>
