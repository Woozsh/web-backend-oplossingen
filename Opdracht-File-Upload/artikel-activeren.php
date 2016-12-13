<?php
session_start();
include_once('partials/variables.php');

try {
  if(isset($_GET['artikel']))
  {
    $id = $_GET['artikel'];
    $userid = $_SESSION['userid'];

    $db = new PDO("mysql:host=localhost;dbname=". DBNAME, "root", "");

    //Get TRACK ID
    $queryGetTrackID = "SELECT tracking_details_id FROM artikels WHERE id = :id";

    $getTrackID = $db->prepare($queryGetTrackID);
    $getTrackID->bindValue(":id", $id);
    $getTrackID->execute();
    $trackid = $getTrackID->fetch(PDO::FETCH_ASSOC);
    $trackid = $trackid['tracking_details_id'];

    //Update TRACK
    $queryTrack = "UPDATE tracking_details SET is_active = IF(is_active=1, 0, 1), activated_by_user_id = :userid, activated_on = NOW() WHERE id = :trackid";

    $statementTrack = $db->prepare($queryTrack);

    $statementTrack->bindValue(":userid", $userid);
    $statementTrack->bindValue(":trackid", $trackid);

    $statementTrack->execute();

    //Artikel Activeren

    $queryToggle = "UPDATE artikels SET is_active = IF(is_active=1, 0, 1) WHERE id = :id";

    $statementToggle = $db->prepare($queryToggle);

    $statementToggle->bindValue(":id", $id);

    $toggled = $statementToggle->execute();

    if($toggled)
    {
      $_SESSION['notification']['type'] = "success";
      $_SESSION['notification']['text'] =  "Artikel is getoggled. ";
    }
  }
  header("location: " . $artikelOverzicht);

} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon artikel niet activeren. " . $e->getMessage();
}

header("location: " . $artikelOverzicht);
 ?>
