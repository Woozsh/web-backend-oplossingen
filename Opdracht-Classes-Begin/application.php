<?php
require_once 'classes/Percent.php';
$new = 150;
$unit = 100;
$percent = new Percent($new, $unit);

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../foundation.min.css">
     <title>Classes Begin</title>
   </head>
   <body>
     <table>
       <th>Hoeveel procent is <?= $new ?> van <?= $unit ?></th>
       <tr>
         <td>Absoluut</td>
         <td><?= $percent->absolute ?></td>
       </tr>
       <tr>
         <td>Relatief</td>
         <td><?= $percent->relative ?></td>
       </tr>
       <tr>
         <td>Geheel Getal</td>
         <td><?= $percent->hundred ?>%</td>
       </tr>
       <tr>
         <td>Nominaal</td>
         <td><?= $percent->nominal ?></td>
       </tr>
     </table>
   </body>
 </html>
