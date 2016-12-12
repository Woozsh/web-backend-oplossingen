<?php
  session_start();
  include_once('variables.php');


  if(isset($_POST['artikelToevoegen'])){

    $titel = $_POST['titel'];
    $artikel = $_POST['artikel'];
    $kernwoorden = $_POST['kernwoorden'];
    $datum = $_POST['datum'];

    $db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

    $queryAddArtikel = "INSERT INTO artikels(titel, artikel, kernwoorden, datum) VALUES (:titel, :artikel, :kernwoorden, :datum)";

    $statementAddArtikel = $db->prepare($queryAddArtikel);

    $statementAddArtikel->bindValue(":titel", $titel);
    $statementAddArtikel->bindValue(":artikel", $artikel);
    $statementAddArtikel->bindValue(":kernwoorden", $kernwoorden);
    $statementAddArtikel->bindValue(":datum", $datum);

    $insertSuccess = $statementAddArtikel->execute();

    if($insertSuccess)
    {
      $_SESSION['error']['type'] = "success";
      $_SESSION['error']['text'] =  "Artikel \"" . $titel . "\" is toegevoegd!";
      header('location: ' . $artikelOverzicht );
    }
    else
    {
      $_SESSION['error']['type'] = "error";
      $_SESSION['error']['text'] =  "Artikel is " . $titel . " Kon niet worden toegevoegd.";
      header('location: ' . $artikelToevoegenForm );
      }
    }




  header('location: ' . $artikelToevoegenForm );

 ?>
