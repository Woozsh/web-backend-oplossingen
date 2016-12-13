<?php
session_start();
include_once('partials/variables.php');


if(!isset($_COOKIE['login']))
{
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] = "U moet eerst inloggen.";
  header('location: ' . $loginForm );
}

$cookie = explode(",", $_COOKIE['login']);

$email = $cookie[0];
$saltedEmail = $cookie[1];
$db = new PDO("mysql:host=localhost;dbname=". DBNAME, "root", "");

$queryUser = "SELECT * FROM users WHERE email = :email";

$statementUser = $db->prepare($queryUser);

$statementUser->bindValue(":email", $email);

$statementUser->execute();

$userArray = $statementUser->fetch(PDO::FETCH_ASSOC);

$salt = $userArray['salt'];
$newSaltedEmail = hash('sha512', $email . $salt);

if($newSaltedEmail != $saltedEmail)
{
  unset($_SESSION['login']);
  setcookie('login', '', time()-3600);
}

//Artikels ophalen
try {
  $queryArtikelsOphalen = "SELECT * from artikels";

  $statementArtikels = $db->prepare($queryArtikelsOphalen);

  $statementArtikels->execute();

  $artikels = $statementArtikels->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] =  "Kon artikels niet ophalen. " . $e->getMessage();
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
    <title>Artikels</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>
    <h1 >Overzicht van Artikels</h1>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>
    <!-- context -->
    <div >
      <p><a href="<?= $artikelToevoegenForm ?>">Voeg een artikel toe</a></p>
        <!-- articles -->
        <div class="articles">
      <?php foreach($artikels as $artikel): ?>
          <!-- checks if article is archived -->
          <?php if($artikel['is_archived'] != 1): ?>
            <!-- checks if article is active -->
            <?php ($artikel['is_active'] == 0) ? $isActive = false : $isActive = true ?>
            <!-- article -->
            <article class="<?= ($isActive) ? 'active' : 'not-active' ?>">
              <h2 ><?= $artikel['titel'] ?></h2>
              <ul>
                <li>Artikel: <?= $artikel['artikel'] ?></li>
                <li>Kernwoorden: <?= $artikel['kernwoorden'] ?></li>
                <li>Datum: <?= $artikel['datum'] ?></li>
              </ul>
              <p><a href="<?= $artikelWijzigenForm ?>?artikel=<?= $artikel['id'] ?>">artikel wijzigen</a> | <a href="<?= $artikelActiveren ?>?artikel=<?= $artikel['id'] ?>"><?= ($isActive) ? 'artikel deactiveren' : 'artikel activeren' ?></a> | <a href="<?= $artikelVerwijderen ?>?artikel=<?= $artikel['id'] ?>">artikel verwijderen</a> </p>
            </article>
          <?php endif; ?>
      <?php endforeach; ?>
        </div>
    </div>
  </body>
</html>
