<?php

function __autoload($class){
  include 'classes/' . $class . '.php';
}
$leeuw = new Animal("Arnold", "male", 100);
$zeeluipaard = new Animal("Freddy", "female", 120);
$meeuw = new Animal("Donald", "male", 70);
$simba = new Lion("Simba", "male",50, "Congo Lion");
$scar = new Lion("Scar", "male", 170, "Kenia Lion");
$zeke = new Zebra("Zeke", "male", 100, "Quagga");
$zana = new Zebra("Zana", "female", 100, "Selous");

 ?>


 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Dieren enzo</title>
   </head>
   <body>
     <h1>Animals</h1>
     <p><?= $leeuw->getName() ?> is van het geslacht <?= $leeuw->getGender() ?> en heeft momenteel <?= $leeuw->getHealth() ?> levenspunten (special move:<?= $leeuw->doSpecialMove() ?>)</p>
     <p>+50 levenspunten voor Arnold! Hij zit nu op <?php $leeuw->changeHealth(50); echo $leeuw->getHealth(); ?> levenspunten</p>
     <p><?= $zeeluipaard->getName() ?> is van het geslacht <?= $zeeluipaard->getGender() ?> en heeft momenteel <?= $zeeluipaard->getHealth() ?> levenspunten (special move:<?= $zeeluipaard->doSpecialMove() ?>)</p>
     <p><?= $meeuw->getName() ?> is van het geslacht <?= $meeuw->getGender() ?> en heeft momenteel <?= $meeuw->getHealth() ?> levenspunten (special move:<?= $meeuw->doSpecialMove() ?>)</p>
     <br>
     <p>De speciale move van <?= $simba->getName() ?> (soort: <?= $simba->getSpecies() ?>): <?= $simba->doSpecialMove() ?></p>
     <p>De speciale move van <?= $scar->getName() ?> (soort: <?= $scar->getSpecies() ?>): <?= $scar->doSpecialMove() ?></p>
     <p>De speciale move van <?= $zeke->getName() ?> (soort: <?= $zeke->getSpecies() ?>): <?= $zeke->doSpecialMove() ?></p>
     <p>De speciale move van <?= $zana->getName() ?> (soort: <?= $zana->getSpecies() ?>): <?= $zana->doSpecialMove() ?></p>

   </body>
 </html>
