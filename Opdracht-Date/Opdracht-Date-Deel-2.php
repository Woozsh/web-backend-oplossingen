<?php
  $timestamp = mktime(22, 35, 25,01, 21 , 1904 );
  setlocale(LC_TIME, array('da_DA.UTF-8','da_DA@euro','da_DA','dutch'));
 ?>


 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../foundation.min.css" media="screen" title="no title">
     <title>Opdracht Date</title>
   </head>
   <body>
     <h1>Opdracht Date</h1>
     <p>
       <?= strftime("%d %B %Y, %I:%M:%S", $timestamp) . date(" a", $timestamp) ?>
     </p>
   </body>
 </html>
