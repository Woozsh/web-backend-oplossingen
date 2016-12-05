<?php
$messageContainer = '';
if(isset($_POST['submit'])){
  try {
    $db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $brnaam = $_POST['brnaam'];
    $adres = $_POST['adres'];
    $postcode = $_POST['postcode'];
    $gemeente = $_POST['gemeente'];
    $omzet = $_POST['omzet'];

    $queryString = "INSERT INTO brouwers (brnaam, adres, postcode, gemeente, omzet) VALUES(:brnaam, :adres, :postcode, :gemeente, :omzet) ";

    $statement = $db->prepare($queryString);

    $statement->bindValue(':brnaam', $brnaam);
    $statement->bindValue(':adres', $adres);
    $statement->bindValue(':postcode', $postcode);
    $statement->bindValue(':gemeente', $gemeente);
    $statement->bindValue(':omzet', $omzet);

    $statement->execute();
    $lastID = $db->lastInsertID();
    $messageContainer = "Gelukt! " . $lastID;
  } catch (PDOException $e) {
      $messageContainer = 'Something went wrong: ' . $e->getMessage();
  }

}

 ?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Brouwer Toevoegen</title>
  </head>
  <body>
    <h1>Voeg een brouwer toe</h1>
    <p><?= $messageContainer ?></p>
    <form method="post">
      <label for="brnaam">Brouwernaam</label>
      <input type="text" name="brnaam" value="">
      <label for="adres">adres</label>
      <input type="text" name="adres" value="">
      <label for="postcode">postcode</label>
      <input type="text" name="postcode" value="">
      <label for="gemeente">gemeente</label>
      <input type="text" name="gemeente" value="">
      <label for="omzet">omzet</label>
      <input type="text" name="omzet" value="">
      <input class="button" type="submit" name="submit" value="Send">
    </form>
  </body>
</html>
