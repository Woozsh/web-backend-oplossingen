<?php
session_start();
include_once('partials/variables.php');


//Cookie Check
include_once('partials/cookieCheck.php');


//MESSAGE

include_once('partials/message.php');


try {
  $db = new PDO("mysql:host=localhost;dbname=". DBNAME, "root", "");

  //USER OPHALEN
  $id = $_SESSION['userid'];

  $queryUserOphalen = "SELECT * from users WHERE id = :id";

  $statementUser = $db->prepare($queryUserOphalen);
  $statementUser->bindValue(":id", $id);
  $statementUser->execute();

  $user = $statementUser->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon user niet ophalen. " . $e->getMessage();
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Gegevens Wijzigen</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

      <!-- context -->
      <div >
        <!-- form -->
        <form action="<?= $gegevensWijzigenProcess ?>" method="post" enctype="multipart/form-data">
          <!-- titel -->
          <div class="row">
            <h1 >Gegevens Wijzigen</h1>
          </div>
          <!-- profielfoto -->
          <div class="row">
            <div class="medium-6 columns">
              <label for="profielfoto">Profielfoto</label>
              <img src="img/<?= ($user['profile_picture'] == '') ? 'schild.png' : $user['profile_picture'] ?>" alt="profielfoto">
              <input type="file" name="profielfoto" value="">
            </div>
          </div>
          <!-- email -->
          <div class="row">
            <div class="medium-6 columns">
              <label for="email">e-mail</label>
              <input type="text" name="email" value="<?= $user['email'] ?>">
            </div>
          </div>
          <!-- send -->
          <div class="row">
            <div class="medium-6 columns">
              <input class="button" type="submit" name="gegevensWijzigen" value="Gegevens Wijzigen">
            </div>
          </div>

        </form>

      </div>

  </body>
</html>
