<?php
session_start();
include_once('partials/variables.php');

//classes
function __autoload($class){
  include 'classes/' . $class . '.php';
}

$thumb = new Thumbnail(THUMBPATH);

try {
  if(isset($_GET['delete']))
  {
    $id = $_GET['delete'];

    $db = new PDO("mysql:host=localhost;dbname=". DBNAME, DBHOST, DBPW);

    $queryGetFilename = "SELECT file_name FROM gallery WHERE id = :id";

    $statementGetFilename = $db->prepare($queryGetFilename);
    $statementGetFilename->bindValue(":id", $id);
    $statementGetFilename->execute();
    $filename = $statementGetFilename->fetch(PDO::FETCH_ASSOC);
    $filename = $filename['file_name'];

    define("ROOT", dirname(__FILE__));

    $thumbpath = ROOT . "/" . $thumb->getPath($filename);
    $imgpath = ROOT . "/" . IMGPATH . $filename;

    $newthumbpath = ROOT . BINPATH .  $thumb->getFilename($filename);
    $newimgpath = ROOT . BINPATH . $filename;

    if(file_exists($imgpath))
    {
      rename($imgpath, $newimgpath);
    }

    if(file_exists($thumbpath))
    {
      rename($thumbpath, $newthumbpath);
    }

    $queryArchive = "UPDATE gallery SET is_archived = 1 WHERE id = :id";

    $statementArchive = $db->prepare($queryArchive);
    $statementArchive->bindValue(":id", $id);
    $success = $statementArchive->execute();

    if($success){
      $_SESSION['notification']['type'] = "success";
      $_SESSION['notification']['text'] =  "Foto verwijderd.";
      header('location: ' . $gallery);
    }

  }
  else{
    throw new Exception ("Foute submit.");
  }

}
catch (PDOException $e)
{
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Fout: " . $e->getMessage();
  header('location: ' . $gallery);
}



 ?>
