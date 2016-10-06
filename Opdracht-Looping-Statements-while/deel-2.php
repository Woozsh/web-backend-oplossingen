<?php
$boodschappenlijstje = array("boter"," ice-tea","pizza");
$i = 0;
$lijstcount = count($boodschappenlijstje);


 ?>


 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Boodschappenlijstje</title>
   </head>
   <body>
     <ul>
       <?php while($i < $lijstcount){ ?>
       <li><?php echo $boodschappenlijstje[$i]; ?></li>
       <?php $i++; } ?>
     </ul>
   </body>
 </html>
