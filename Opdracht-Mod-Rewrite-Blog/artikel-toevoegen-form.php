<?php
session_start();

include_once('classes/message-set.php');

if(isset($_SESSION['data']))
{
  $titel = $_SESSION['data']['titel'];
  $artikel = $_SESSION['data']['artikel'];
  $kernwoorden = $_SESSION['data']['kernwoorden'];
  $datum = $_SESSION['data']['datum'];

  unset($_SESSION['data']);
}
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <title>Artikels Toevoegen</title>
  </head>
  <body>

    <?php include_once('classes/message-show.php') ?>

    <h1>Artikel Toevoegen</h1>
    <a href="artikel-overzicht.php">Terug naar overzicht</a>
    <form class="" action="artikel-toevoegen.php" method="post">
      <div class="row">
        <label for="titel">Titel</label>
        <input type="text" name="titel" value="<?php if(isset($titel)) echo $titel ?>">
      </div>
      <div class="row">
        <label for="artikel">Artikel</label>
        <input type="text" name="artikel" value="<?php if(isset($artikel)) echo $artikel ?>">
      </div>
      <div class="row">
        <label for="kernwoorden">Kernwoorden</label>
        <input type="text" name="kernwoorden" value="<?php if(isset($kernwoorden)) echo $kernwoorden ?>">
      </div>
      <div class="row">
        <label for="datum">Datum</label>
        <input type="text" name="datum" value="<?php if(isset($datum)) echo $datum; else echo 'dd / mm / jjjj'?> ">
      </div>
      <div class="row">
        <input class="button" type="submit" name="submit" value="Verzenden">
      </div>
    </form>
  </body>
</html>
