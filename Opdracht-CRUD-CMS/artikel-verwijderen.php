<?php
session_start();
include_once('partials/variables.php');

try {
  if(isset($_GET['artikel']))
  {
    $id = $_GET['artikel'];
    $userid = $_SESSION['userid'];

    //tracking_details updaten
    $db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

    //Get TRACK ID
    $queryGetTrackID = "SELECT tracking_details_id FROM artikels WHERE id = :id";

    $getTrackID = $db->prepare($queryGetTrackID);
    $getTrackID->bindValue(":id", $id);
    $getTrackID->execute();
    $trackid = $getTrackID->fetch(PDO::FETCH_ASSOC);
    $trackid = $trackid['tracking_details_id'];
    //Update TRACK
    $queryTrack = "UPDATE tracking_details SET is_archived = 1, archived_by_user_id = :userid, archived_on = NOW() WHERE id = :trackid";

    $statementTrack = $db->prepare($queryTrack);

    $statementTrack->bindValue(":userid", $userid);
    $statementTrack->bindValue(":trackid", $trackid);

    $statementTrack->execute();
    //Artikel Archiveren

    $queryToggle = "UPDATE artikels SET is_archived = 1 WHERE id = :id";

    $statementToggle = $db->prepare($queryToggle);

    $statementToggle->bindValue(":id", $id);

    $toggled = $statementToggle->execute();

    if($toggled)
    {
      $_SESSION['notification']['type'] = "success";
      $_SESSION['notification']['text'] =  "Artikel is verwijderd. ";
    }
  }


  header("location: " . $artikelOverzicht);
} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon artikel niet activeren. " . $e->getMessage();
}

header("location: " . $artikelOverzicht);
 ?>
