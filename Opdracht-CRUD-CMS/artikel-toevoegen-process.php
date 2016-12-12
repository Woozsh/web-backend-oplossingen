<?php
  session_start();
  include_once('partials/variables.php');


  if(isset($_POST['artikelToevoegen'])){

    $titel = $_POST['titel'];
    $artikel = $_POST['artikel'];
    $kernwoorden = $_POST['kernwoorden'];
    $datum = $_POST['datum'];
    $userid = $_SESSION['userid'];

    $db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

    //tracking_details updaten

    $queryTrack = "INSERT INTO tracking_details(created_by_user_id, created_on) VALUES (:userid, NOW())";

    $statementTrack = $db->prepare($queryTrack);

    $statementTrack->bindValue(":userid", $userid);

    $statementTrack->execute();

    $last_id = $db->lastInsertId();

    //Artikel toevoegen

    $queryAddArtikel = "INSERT INTO artikels(titel, artikel, kernwoorden, datum, tracking_details_id) VALUES (:titel, :artikel, :kernwoorden, :datum, :last_id)";

    $statementAddArtikel = $db->prepare($queryAddArtikel);

    $statementAddArtikel->bindValue(":titel", $titel);
    $statementAddArtikel->bindValue(":artikel", $artikel);
    $statementAddArtikel->bindValue(":kernwoorden", $kernwoorden);
    $statementAddArtikel->bindValue(":datum", $datum);
    $statementAddArtikel->bindValue(":last_id", $last_id);

    $insertSuccess = $statementAddArtikel->execute();



    if($insertSuccess)
    {
      $_SESSION['notification']['type'] = "success";
      $_SESSION['notification']['text'] =  "Artikel \"" . $titel . "\" is toegevoegd!";
      header('location: ' . $artikelOverzicht );
    }
    else
    {
      $_SESSION['notification']['type'] = "error";
      $_SESSION['notification']['text'] =  "Artikel \"" . $titel . "\" Kon niet worden toegevoegd. " . $db->errorInfo();
      header('location: ' . $artikelToevoegenForm );
      }
    }




  header('location: ' . $artikelToevoegenForm );

 ?>
