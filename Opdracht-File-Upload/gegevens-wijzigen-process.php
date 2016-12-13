<?php
session_start();
include_once('partials/variables.php');

try {
  if(isset($_POST['gegevensWijzigen']))
  {
    $email = $_POST['email'];
    $id = $_SESSION['userid'];
    $name = $_FILES['profielfoto']['name'];

    if((($_FILES['profielfoto']['type'] == "image/gif")
    || ($_FILES['profielfoto']['type'] == "image/png")
    || ($_FILES['profielfoto']['type'] == "image/jpg")
    || ($_FILES['profielfoto']['type'] == "image/jpeg"))
    && $_FILES['profielfoto']['size'] < 2000000)
    {
      if($_FILES['profielfoto']['error'] > 0)
      {
        throw new Exception("Return code: " . $_FILES['profielfoto']['error']);
        header('location: ' . $gegevensWijzigenForm);
      }
      else
      {
        define("ROOT", dirname(__FILE__));

        do{
          $timestamp = date("d-m-Y-H-i-s");
          $bestandsnaam = $timestamp . "_" . $name;
        }while(file_exists(ROOT . "/img/" . $bestandsnaam));

        move_uploaded_file($_FILES['profielfoto']['tmp_name'], ROOT . "/img/" . $bestandsnaam);

        //gegevens updaten
        $db = new PDO("mysql:host=localhost;dbname=". DBNAME, "root", "");

        $queryUserUpdaten = "UPDATE users SET email = :email, profile_picture = :profielfoto WHERE id = :id";

        $statementUser = $db->prepare($queryUserUpdaten);
        $statementUser->bindValue(":email", $email);
        $statementUser->bindValue(":profielfoto", $bestandsnaam);
        $statementUser->bindValue(":id", $id);
        $success = $statementUser->execute();

        if($success){
          $_SESSION['notification']['type'] = "success";
          $_SESSION['notification']['text'] =  "Gegevens aangepast";
          header('location: ' . $gegevensWijzigenForm);
        }

      }
    }else
		{
			throw new Exception( 'Ongeldig bestand' );
      header('location: ' . $gegevensWijzigenForm);
		}
  }

}

catch (PDOException $e)
{
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon user niet updaten. " . $e->getMessage();
  header('location: ' . $gegevensWijzigenForm);
}
header('location: ' . $gegevensWijzigenForm);
?>
