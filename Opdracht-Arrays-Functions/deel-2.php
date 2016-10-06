<?php
$dieren = array("koe","kat","hond","schaap","varken");
asort($dieren);
$zoogdieren = array("dolfijn", "paard", "mens");
$dierenLijst = array_merge($dieren, $zoogdieren);
$dierencount = count($dieren);
$teZoekenDier = "kat";
$dierGevonden = in_array($teZoekenDier, $dieren);
if($dierGevonden) $output = "Gevonden";
else $output = "Niet Gevonden";
 ?>


 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Dieren arrays</title>
   </head>
   <body>
     <p>
       Er zijn
       <?= $dierencount ?>
        verschillende dieren in de boerderij.
     </p>
     <p>
       Het dier is <?= $output ?>
     </p>
   </body>
 </html>
