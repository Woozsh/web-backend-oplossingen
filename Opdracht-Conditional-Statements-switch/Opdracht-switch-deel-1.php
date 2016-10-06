<?php
  $getal = rand(1,7);
  switch($getal){
    case 1:
      $dag = "maandag";
      break;
    case 2:
      $dag = "dinsdag";
      break;
    case 3:
      $dag = "woensdag";
      break;
    case 4:
      $dag = "donderdag";
      break;
    case 5:
      $dag = "vrijdag";
      break;
    case 6:
      $dag = "zaterdag";
      break;
    case 7:
      $dag = "zondag";
      break;
    default:
      $dag = "Oeps";
  }


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Random Dag</title>
  </head>
  <body>
    <h1><?= $dag ?></h1>
  </body>
</html>
