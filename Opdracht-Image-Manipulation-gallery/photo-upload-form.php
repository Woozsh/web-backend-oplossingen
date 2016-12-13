<?php
session_start();
include_once('partials/variables.php');

//MESSAGE

include_once('partials/message.php');


// try {
//   $db = new PDO("mysql:host=localhost;dbname=". DBNAME, DBHOST, DBPW);
//
//   //USER OPHALEN
//   $id = $_SESSION['userid'];
//
//   $queryUserOphalen = "SELECT * from users WHERE id = :id";
//
//   $statementUser = $db->prepare($queryUserOphalen);
//   $statementUser->bindValue(":id", $id);
//   $statementUser->execute();
//
//   $user = $statementUser->fetch(PDO::FETCH_ASSOC);
//
// } catch (PDOException $e) {
//   $_SESSION['notification']['type'] = "error";
//   $_SESSION['notification']['text'] =  "Kon user niet ophalen. " . $e->getMessage();
// }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Foto uploaden</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $gallery ?>">Terug naar de gallerij</a></p>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

      <!-- context -->
      <section>
        <!-- form -->
        <form action="<?= $photoUpload ?>" method="post" enctype="multipart/form-data">
          <!-- titel -->
          <div class="row">
            <h1 >Foto uploaden</h1>
          </div>
          <!-- foto -->
          <div class="row">
            <div class="medium-6 columns">
              <label for="foto">Bestand uploaden</label>

              <input type="file" name="foto" value="">
            </div>
          </div>
          <!-- titel -->
          <div class="row">
            <div class="medium-6 columns">
              <label for="titel">Titel</label>
              <input type="text" name="titel" value="">
            </div>
          </div>
          <!-- beschrijving -->
          <div class="row">
            <div class="medium-6 columns">
              <label for="beschrijving">Beschrijving</label>
              <input type="text" name="beschrijving" value="">
            </div>
          </div>
          <!-- send -->
          <div class="row">
            <div class="medium-6 columns">
              <input class="button" type="submit" name="send" value="Verzenden">
            </div>
          </div>

        </form>

      </section>

  </body>
</html>
