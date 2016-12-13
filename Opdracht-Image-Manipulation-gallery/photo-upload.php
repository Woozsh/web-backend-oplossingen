<?php
session_start();
include_once('partials/variables.php');

try {
  if(isset($_POST['send']))
  {
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];

    $filename = $_FILES['foto']['name'];

    var_dump($_FILES['foto']);

    if((($_FILES['foto']['type'] == "image/gif")
    || ($_FILES['foto']['type'] == "image/png")
    || ($_FILES['foto']['type'] == "image/jpg")
    || ($_FILES['foto']['type'] == "image/jpeg"))
    && $_FILES['foto']['size'] < 2000000)
    {
      if($_FILES['foto']['error'] > 0)
      {
        throw new Exception("Return code: " . $_FILES['foto']['error']);
        header('location: ' . $photoUploadForm);
      }
      else
      {
        //generate md5 hashed filename
        $fileParts	=	pathinfo($filename);
        $bestandsnaam = generateFilename($fileParts);
        //upload file
        move_uploaded_file($_FILES['foto']['tmp_name'], ROOT . "/" . IMGPATH . $bestandsnaam);
        //create thumbnail
        $thumb = createThumb($bestandsnaam);

        if($thumb)//if thumbnail is made (true)
        {
          //gegevens inserten
          $db = new PDO("mysql:host=localhost;dbname=". DBNAME, DBHOST, DBPW);

          $queryInsert = "INSERT INTO gallery (file_name, title, caption) VALUES (:bestandsnaam, :titel, :beschrijving)";

          $statementInsert = $db->prepare($queryInsert);
          $statementInsert->bindValue(":bestandsnaam", $bestandsnaam);
          $statementInsert->bindValue(":titel", $titel);
          $statementInsert->bindValue(":beschrijving", $beschrijving);
          $success = $statementInsert->execute();

          if($success){
            $_SESSION['notification']['type'] = "success";
            $_SESSION['notification']['text'] =  "Gegevens geüpload.";
            header('location: ' . $photoUploadForm);
          }
        }


      }
    }else
		{
			throw new Exception( 'Ongeldig bestand' );
      header('location: ' . $photoUploadForm);
		}
  }else
  {
    throw new Exception( 'Fout in het verzenden van het formulier' );
    header('location: ' . $photoUploadForm);
  }

}

catch (PDOException $e)
{
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Fout: " . $e->getMessage();
  header('location: ' . $photoUploadForm);
}
header('location: ' . $photoUploadForm);


function generateFilename($fileParts)
{
  define("ROOT", dirname(__FILE__));
  do{
    $timestamp = date("d-m-Y-H-i-s");
    $bestandsnaam = $timestamp . $fileParts['filename'];
    $md5Filename = md5($bestandsnaam) . "." . $fileParts['extension'];
  }while(file_exists(ROOT . "/" . IMGPATH . $md5Filename));

  return $md5Filename;
}

function createThumb($file)
{
  // Haal de bestandsnaam en de extensie uit het bestand
  $fileParts	=	pathinfo($file);
  $fileName	=	$fileParts['filename'];
  $ext		=	$fileParts['extension'];
  $imagePath = ROOT . "/" . IMGPATH . $file;

  // thumb naam
  $bestandsnaam = $fileName . "_thumbs";

  // Bepaal de dimensies van de verkleining
  $thumbDimensions['w']	=	50;
  $thumbDimensions['h']	=	50;

  // Haal de breedte en de hoogte op uit het originele bestand
  list($width, $height)	=	getimagesize($imagePath); // kent automatisch de value uit getimagesize (retunt array(width, height)) toe aan de variabele in de list in de overeenstemmende volgorde

  // get Dimension type
  if($width == $height)
  {
    $dimension = 'square';
  }elseif($width>$height)
  {
    $dimension = 'landscape';
  }else {
    $dimension = 'portrait';
  }
  // Controleer om welke extensie het gaat en voer de overeenstemmende methode uit
  switch ($ext)
  {
    case ('jpg'):
    case ('jpeg'):
      $source 	= 	imagecreatefromjpeg($imagePath);
      break;

    case ('png'):
      $source 	=	imagecreatefrompng($imagePath);
      break;

    case ('gif'):
      $source 	=	imagecreatefromgif($imagePath);
      break;
  }

  //CROP based on dimension type
  switch($dimension)
  {
    case 'landscape':
      $cropped = imagecrop($source, ['x' => (($width-$height)/2), 'y' => 0, 'width' => $height, 'height' => $height]);

      $width = $height;
    break;

    case 'portrait':
      $cropped = imagecrop($source, ['x' => 0, 'y' => (($height-$width)/2), 'width' => $width, 'height' => $width]);

      $height = $width;
    break;

    default: $cropped = $source;
  }
  // Creëer een leeg canvas met de dimensies van de nieuwe afbeelding
  $thumb 	=	imagecreatetruecolor($thumbDimensions['w'], $thumbDimensions['h']);

  // Resize het origineel naar de gewenste dimensies en plaats het de verkleinde versie in het nieuwe canvas.
  // nieuwe canvas = destination, oude canvas = source, destination x, destination y, source x, source y, destination width, destination height, source width, source height
  imagecopyresized($thumb, $cropped, 0,0,0,0, $thumbDimensions['w'],$thumbDimensions['h'], $width, $height);

  // Slaag het nieuwe canvas op (canvas, (folder).fileName, kwaliteit)
  $resized 	= 	imagejpeg($thumb, (ROOT . "/" . IMGPATH. "thumbs/" . $bestandsnaam . "." . $ext), 100);

  return $resized;
}
?>
