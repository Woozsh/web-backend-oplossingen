<?php
function berekenSom($getal1, $getal2){
  return $getal1 + $getal2;
}
function vermenigvuldig($getal1, $getal2){
  return $getal1 * $getal2;
}
function isEven($getal){
  return ($getal%2 == 0) ? 'ja' : 'nee';
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Functions</title>
  </head>
  <body>
    <p>
      1 + 5 = <?= berekenSom(1,5); ?>
    </p>
    <p>
      1 * 5 = <?= vermenigvuldig(1,5); ?>
    </p>
    <p>
      is 7 een even getal?  <?= isEven(7); ?>
    </p>
  </body>
</html>
