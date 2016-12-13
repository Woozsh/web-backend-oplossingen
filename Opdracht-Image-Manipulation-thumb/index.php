<?php

  if(isset($_POST['upload']))
  {
    if((($_FILES['foto']['type'] == "image/gif")
    || ($_FILES['foto']['type'] == "image/png")
    || ($_FILES['foto']['type'] == "image/jpg")
    || ($_FILES['foto']['type'] == "image/jpeg"))
    && $_FILES['foto']['size'] < 5000000)
    {
      $imageFile	=	$_FILES['foto']['name'];

      //upload original file
      define("ROOT", dirname(__FILE__));
      move_uploaded_file($_FILES['foto']['tmp_name'], ROOT . "/img/" . $imageFile);

    	// Haal de bestandsnaam en de extensie uit het bestand
    	$fileParts	=	pathinfo($imageFile);
    	$fileName	=	$fileParts['filename'];
    	$ext		=	$fileParts['extension'];
      $imageFile = ROOT . "/img/" . $imageFile;
      //unieke thumb naam
      $timestamp = date("d-m-Y-H-i-s");
      $bestandsnaam = "thumb-" . $timestamp . "_" . $fileName;

    	// Bepaal de dimensies van de verkleining
    	$thumbDimensions['w']	=	100;
    	$thumbDimensions['h']	=	100;

    	// Haal de breedte en de hoogte op uit het originele bestand
    	list($width, $height)	=	getimagesize($imageFile); // kent automatisch de value uit getimagesize (retunt array(width, height)) toe aan de variabele in de list in de overeenstemmende volgorde

      //get Dimension type
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
    			$source 	= 	imagecreatefromjpeg($imageFile);
    			break;

    		case ('png'):
    			$source 	=	imagecreatefrompng($imageFile);
    			break;

    		case ('gif'):
    			$source 	=	imagecreatefromgif($imageFile);
    			break;
    	}

      //CROP based on dimension type
      switch($dimension)
      {
        case 'landscape': $cropped = imagecrop($source, ['x' => (($width-$height)/2), 'y' => 0, 'width' => $height, 'height' => $height]);
        $width = $height;
        break;
        case 'portrait': $cropped = imagecrop($source, ['x' => 0, 'y' => (($height-$width)/2), 'width' => $width, 'height' => $width]);
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
    			$resized 	= 	imagejpeg($thumb, (ROOT . "/img/" . $bestandsnaam. '.jpg'), 100);
    }
  }



?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thumbnail genereren</title>
    <link rel="stylesheet" href="../foundation.min.css">
</head>

<body>

	<section>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <h1>Thumbnail genereren</h1>
      </div>
      <!-- foto -->
      <div class="row">
        <div class="medium-6 columns">
          <label for="foto">Foto kiezen</label>
          <input type="file" name="foto" value="">
        </div>
      </div>
      <!-- send -->
      <div class="row">
        <div class="medium-6 columns">
          <input class="button" type="submit" name="upload" value="Thumbnail genereren">
        </div>
      </div>
		</form>

	</section>

</body>
</html>
