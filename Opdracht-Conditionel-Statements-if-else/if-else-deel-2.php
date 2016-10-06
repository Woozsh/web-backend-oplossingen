<?php
$sec = 221108521;

$een_jaar = (60*60*24*365);
$een_maand = (60*60*24*31);
$een_dag = (60*60*24);
$een_uur = (60*60);
$een_minuut = 60;

  $jaar = intval($sec/$een_jaar);
  $maanden = intval($sec/$een_maand);
  $dagen = intval($sec/$een_dag);
  $uren = intval($sec/$een_uur);
  $minuten = intval($sec / $een_minuut);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Seconden</title>
  </head>
  <body>
    <h1>in <?= $sec ?> seconden</h1>
    <ul>
      <li>minuten: <?php echo $minuten; ?></li>
      <li>uren: <?php echo $uren; ?></li>
      <li>dagen: <?php echo $dagen; ?></li>
      <li>maanden: <?php echo $maanden; ?></li>
      <li>jaren: <?php echo $jaar; ?></li>
    </ul>
  </body>
</html>
