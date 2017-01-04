<?php
session_start();
include_once('classes/config.php');
include_once('classes/message-set.php');

//artikels ophalen
try {
  $db = new PDO("mysql:host=localhost;dbname=". DBNAME, "root", "");

  $query = "SELECT * FROM artikels";

  $artikelsShow = $db->prepare($query);
  $artikelsShow->execute();
  $artikels = $artikelsShow->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon artikels niet ophalen. " . $e->getMessage();
}

$dirname = explode("/", $_SERVER['REQUEST_URI']);
$basePath = "/" . $dirname[1] . "/";
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

     <form class="" action="artikel-zoeken-redirect.php" method="get">
       <div class="row">
         <label for="query-woord">Zoeken in artikels</label>
       </div>
       <div class="row">
         <input type="text" name="query-woord" value="">
         <input type="submit" class="button" name="" value="Zoeken">
       </div>
     </form>

     <form class="" action="artikel-zoeken-redirect.php" method="get">
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

     <h1>Artikels Overzicht</h1>
     <a href="artikels/toevoegen">Artikel toevoegen</a>
     <?php foreach($artikels as $artikel): ?>
       <article class="">
         <h2><?= $artikel['titel'] ?> | <?= $artikel['datum'] ?></h2>
         <p><?= $artikel['artikel'] ?></p>
         <p>Keywords: <?= $artikel['kernwoorden'] ?></p>
       </article>
     <?php endforeach; ?>
   </body>
 </html>
