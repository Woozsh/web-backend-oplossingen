<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Opdracht Comments: deel 1</title>
</head>
<body>
  <?php
    $surname = "Jordy";
    $name = "Pereira";
    $volledigenaam = $surname . $name;
    #Jordy Pereira jordy.pereira@student.kdg.be
  ?>
    <h1><?= $volledigenaam ?> </h1>
    <h2><?= strlen($volledigenaam) ?></h2>
</body>
</html>
