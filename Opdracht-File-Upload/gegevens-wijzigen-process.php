<?php
session_start();
include_once('partials/variables.php');

try {
  if(isset($_POST['gegevensWijzigen']))
  {
    $email = $_POST['email'];
    $id = $_SESSION['userid'];

  }

}

catch (PDOException $e)
{
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon user niet updaten. " . $e->getMessage();
}

?>
