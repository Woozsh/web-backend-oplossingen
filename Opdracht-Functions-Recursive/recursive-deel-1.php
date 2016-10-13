<?php
  $startCapital = 100000;
  $rent = 0.08;
  $time = 10;
  function Interest($start, $rent, $time = 10){
    $start += ($start * $rent);
    --$time;
    if ($time > 0) {
      return Interest($start, $rent, $time);
    }
    else return round($start, 2, PHP_ROUND_HALF_DOWN);
  }

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Recursive</title>
   </head>
   <body>
     <p>
      Zijn geld na 10 jaar : €<?= Interest($startCapital, $rent, $time); ?>
    </p>
   </body>
 </html>
