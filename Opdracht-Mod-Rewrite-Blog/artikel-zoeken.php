<?php
session_start();
include_once('classes/config.php');
include_once('classes/message-set.php');

//artikels ophalen
try {
  $db = new PDO("mysql:host=localhost;dbname=". DBNAME, "root", "");

  //zoeken op woord
  if (isset($_GET['query-woord'])) {
    $query = "SELECT * FROM artikels WHERE artikel LIKE  :woord  ";

    $artikelsShow = $db->prepare($query);

    $artikelsShow->bindValue(':woord', '%' . $_GET['query-woord'] . '%');

    $titel = "Artikels die het woord " . "\"" . $_GET['query-woord'] . "\" bevatten";
  }

  //zoeken op datum
  if (isset($_GET['query-datum'])) {
    $query = "SELECT * FROM artikels WHERE datum LIKE :jaar ";

    $artikelsShow = $db->prepare($query);

    $artikelsShow->bindValue(":jaar", '%' . $_GET['query-datum'] . '%');

    $titel = "Artikels van het jaar " . $_GET['query-datum'];
  }

  //altijd uitvoeren

  $artikelsShow->execute();
  $artikels = $artikelsShow->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon artikels niet ophalen. " . $e->getMessage();
}
 ?>


 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="/../foundation.min.css">
     <link rel="stylesheet" href="css/master.css">
     <title>Artikel Overzicht</title>
   </head>
   <body>
     <?php include_once('classes/message-show.php') ?>
     <a href="artikel-overzicht.php">Terug naar overzicht</a>

     <form class="" action="artikel-zoeken.php" method="get">
       <div class="row">
         <label for="query-woord">Zoeken in artikels</label>
       </div>
       <div class="row">
         <input type="text" name="query-woord" value="">
         <input type="submit" class="button" name="" value="Zoeken">
       </div>
     </form>

     <form class="" action="artikel-zoeken.php" method="get">
       <div class="row">
         <label for="query-datum">Zoeken in artikels</label>
       </div>
       <div class="row">
         <select name="query-datum" id="query-datum">
           <?php for($i = 0; $i < 18; $i++): ?>
             <?php if($i < 10): ?>
              <option value="200<?= $i ?>">200<?= $i ?></option>
            <?php else: ?>
              <option value="20<?= $i ?>">20<?= $i ?></option>
            <?php endif; ?>
           <?php endfor; ?>
         </select>
         <input type="submit" class="button" name="" value="Zoeken">
       </div>
     </form>

     <h1><?= $titel ?></h1>
     <?php foreach($artikels as $artikel): ?>
       <article>
         <h2><?= $artikel['titel'] ?> | <?= $artikel['datum'] ?></h2>
         <p><?= $artikel['artikel'] ?></p>
         <p>Keywords: <?= $artikel['kernwoorden'] ?></p>
       </article>
     <?php endforeach; ?>
   </body>
 </html>
