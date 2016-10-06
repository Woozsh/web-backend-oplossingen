<?php
$lettertje = "e";
$cijfertje = 3;
$langstewoord = "zandzeepsodemineralenwatersteenstralen";
$nlangstewoord = str_replace($lettertje, $cijfertje, $langstewoord);

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Replace</title>
   </head>
   <body>
     <h1>Het woord: <?= $langstewoord ?></h1>
     <h2>Het experiment: <?= $nlangstewoord ?></h2>
   </body>
 </html>
