<?php
session_start();
include_once('partials/variables.php');

try {
  if(isset($_POST['artikelWijzigen']))
  {
    $id = $_POST['id'];
    $titel = $_POST['titel'];
    $artikel = $_POST['artikel'];
    $kernwoorden = $_POST['kernwoorden'];
    $datum = $_POST['datum'];
    $userid = $_SESSION['userid'];
    $trackid = $_POST['track_id'];

    $db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

    //tracking_details updaten

    $queryTrack = "UPDATE tracking_details SET changed_by_user_id = :userid, changed_on = NOW() WHERE id = :trackid";

    $statementTrack = $db->prepare($queryTrack);

    $statementTrack->bindValue(":userid", $userid);
    $statementTrack->bindValue(":trackid", $trackid);

    $statementTrack->execute();

    //WIJZIGEN
    $queryUpdate = "UPDATE artikels SET titel = :titel, artikel = :artikel, kernwoorden = :kernwoorden, datum = :datum WHERE id = :id";

    $statementUpdate = $db->prepare($queryUpdate);

    $statementUpdate->bindValue(":id", $id);
    $statementUpdate->bindValue(":titel", $titel);
    $statementUpdate->bindValue(":artikel", $artikel);
    $statementUpdate->bindValue(":kernwoorden", $kernwoorden);
    $statementUpdate->bindValue(":datum", $datum);

    $updated = $statementUpdate->execute();

    if($updated)
    {
      $_SESSION['notification']['type'] = "success";
      $_SESSION['notification']['text'] =  "Artikel is successvol gewijzigd. ";
    }
  }

  header("location: " . $artikelOverzicht);

} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon artikel niet wijzigen. " . $e->getMessage();
  header("location: " . $artikelWijzigenForm);

}


 ?>
