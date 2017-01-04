<?php
session_start();

include_once('classes/config.php');
try {
  //fix date for sql
  $date = explode("/", $_POST['datum']);
  $date = array_reverse($date);
  $date = implode("-",$date);


  $db = new PDO("mysql:host=localhost;dbname=". DBNAME, "root", "");

  $query = "INSERT INTO artikels (titel, artikel, kernwoorden, datum) VALUES (:titel, :artikel, :kernwoorden, :datum)";

  $toevoegen = $db->prepare($query);

  $toevoegen->bindValue(":titel", $_POST['titel']);
  $toevoegen->bindValue(":artikel", $_POST['artikel']);
  $toevoegen->bindValue(":kernwoorden", $_POST['kernwoorden']);
  $toevoegen->bindValue(":datum", $date);

  $success = $toevoegen->execute();

  if($success)
  {
    $_SESSION['notification']['type'] = "success";
    $_SESSION['notification']['text'] = "Artikel toegevoegd";
    header('location: ' . 'artikel-overzicht.php' );
  }
  else {
    $_SESSION['data']['titel'] = $_POST['titel'];
    $_SESSION['data']['artikel'] = $_POST['artikel'];
    $_SESSION['data']['kernwoorden'] = $_POST['kernwoorden'];
    $_SESSION['data']['datum'] = $_POST['datum'];

    $_SESSION['notification']['type'] = "error";
    $_SESSION['notification']['text'] = "Artikel toevoegen mislukt";
    header('location: ' . 'artikel-toevoegen-form.php' );
  }

} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] = "Invalid email format";
  header('location: ' . 'artikel-toevoegen-form.php' );
}


 ?>
