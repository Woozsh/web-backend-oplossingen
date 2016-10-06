<?php
$getal = rand(1,100);
if($getal <= 10) $output = "Het getal ligt tussen 0 en 10";
elseif($getal <= 20) $output = "Het getal ligt tussen 10 en 20";
elseif($getal <= 30) $output = "Het getal ligt tussen 20 en 30";
elseif($getal <= 40) $output = "Het getal ligt tussen 30 en 40";
elseif($getal <= 50) $output = "Het getal ligt tussen 40 en 50";
elseif($getal <= 60) $output = "Het getal ligt tussen 50 en 60";
elseif($getal <= 70) $output = "Het getal ligt tussen 60 en 70";
elseif($getal <= 80) $output = "Het getal ligt tussen 70 en 80";
elseif($getal <= 90) $output = "Het getal ligt tussen 80 en 90";
else $output = "Het getal ligt tussen 90 en 100";
$output = strrev($output);
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>if else if</title>
   </head>
   <body>
     <h2>Het getal <?= $getal ?></h2>
     <h1><?= $output ?></h1>
   </body>
 </html>
