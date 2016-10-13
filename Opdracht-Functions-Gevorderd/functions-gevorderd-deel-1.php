<?php
global $md5HashKey;
$md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';
$g1 = '2';
$g2 = '8';
$g3 = 'a';
function countChar($char, $key){
  return (substr_count($key, $char)/strlen($key) ) *100;
}
$countChar = 'countChar';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Functions</title>
  </head>
  <body>
    <p>
      Functie 1: De needle '<?= $g1 ?>' komt <?= countChar($g1,$md5HashKey); ?>% voor in de hash key <?= $md5HashKey ?>
    </p>
    <p>
      Functie 2: De needle '<?= $g2 ?>' komt <?= $countChar($g2,$md5HashKey); ?>% voor in de hash key <?= $md5HashKey ?>
    </p>
    <p>
      Functie 3: De needle '<?= $g3 ?>' komt <?= countChar($g3,$md5HashKey); ?>% voor in de hash key <?= $md5HashKey ?>
    </p>
  </body>
</html>
