<?php
  $timestamp = mktime(22, 35, 25,01, 21 , 1904 );

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
       <?= date("d F Y, g:i:s a", $timestamp) ?>
     </p>
   </body>
 </html>
