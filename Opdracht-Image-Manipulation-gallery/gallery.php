<?php
session_start();
include_once('partials/variables.php');

//classes
function __autoload($class){
  include 'classes/' . $class . '.php';
}

$thumb = new Thumbnail(THUMBPATH);

//Foto's ophalen
try {
  $db = new PDO("mysql:host=localhost;dbname=". DBNAME, DBHOST, DBPW);

  $queryFotosOphalen = "SELECT * from gallery";

  $statementFotos = $db->prepare($queryFotosOphalen);

  $statementFotos->execute();

  $fotos = $statementFotos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon foto's niet ophalen. " . $e->getMessage();
}


//MESSAGE
include_once('partials/message.php');


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Fotogallerij</title>
  </head>
  <body>

    <h1 >Fotogallerij</h1>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

    <p ><a href="<?= $photoUploadForm ?>">Foto toevoegen</a></p>

    <!-- context -->
    <section>
        <!-- articles -->
        <div class="fotos">
          <ul>
            <?php foreach($fotos as $foto): ?>
              <?php if($foto['is_archived'] != 1): ?>
                  <li class="picture">
                    <a href="<?= IMGPATH . $foto['file_name'] ?>">
                      <img src="<?= $thumb->getPath($foto['file_name']) ?>" alt="<?= $foto['title'] ?>">
                    </a>
                    <figcaption><?= $foto['caption'] ?></figcaption>
                    <a class="button" href="<?= $photoDelete ?>?delete=<?= $foto['id'] ?>">Verwijderen</a>
                  </li>
              <?php endif; ?>
          <?php endforeach; ?>
          </ul>
        </div>
    </section>
  </body>
</html>
