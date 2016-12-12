<?php
session_start();
include_once('partials/variables.php');

// COOKIE
if(!isset($_COOKIE['login']))
{
  $_SESSION['notification']['type'] = "error";
  $_SESSION['notification']['text'] = "U moet eerst inloggen.";
  header('location: ' . $loginForm );
}

$cookie = explode(",", $_COOKIE['login']);

$email = $cookie[0];
$saltedEmail = $cookie[1];
$db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

$queryUser = "SELECT * FROM users WHERE email = :email";

$statementUser = $db->prepare($queryUser);

$statementUser->bindValue(":email", $email);

$statementUser->execute();

$userArray = array();

while($row = $statementUser->fetch(PDO::FETCH_ASSOC)) $userArray[] = $row;

$salt = $userArray[0]['salt'];
$newSaltedEmail = hash('sha512', $email . $salt);

if($newSaltedEmail != $saltedEmail)
{
  unset($_SESSION['login']);
  setcookie('login', '', time()-3600);
}

//VALUES OPHALEN ARTIKEL OM TE WIJZIGEN
if(isset($_GET['artikel']))
{
  try {
    $id = $_GET['artikel'];

    $queryArtikelOphalen = "SELECT * from artikels WHERE id = :id";

    $statementArtikel = $db->prepare($queryArtikelOphalen);

    $statementArtikel->bindValue(":id", $id);

    $statementArtikel->execute();

    $artikel = $statementArtikel->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e) {
    $_SESSION['notification']['type'] = "error";
    $_SESSION['notification']['text'] =  "Kon artikels niet ophalen. " . $e->getMessage();
  }
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
    <title>Artikels Toevoegen</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>
    <p><a href="<?= $artikelOverzicht ?>">Terug naar overzicht</a></p>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

    <!-- context -->
    <div >
      <form action="<?= $artikelWijzigenProcess ?>" method="post">
        <div class="row">
          <h1 >Artikel Wijzigen</h1>

        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="titel">Titel</label>
            <input type="text" name="titel" value="<?= $artikel['titel'] ?>">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="artikel">Artikel</label>
            <textarea name="artikel" rows="4" ><?= $artikel['artikel'] ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="kernwoorden">Kernwoorden</label>
            <input type="text" name="kernwoorden" value="<?= $artikel['kernwoorden'] ?>">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="datum">Datum (jjjj-mm-dd)</label>
            <input type="text" name="datum" value="<?= $artikel['datum'] ?>">
          </div>
        </div>
        <div class="row">
          <input type="hidden" name="id" value="<?= $artikel['id'] ?>">
          <input type="hidden" name="track_id" value="<?= $artikel['tracking_details_id'] ?>">
          <input class="button" type="submit" name="artikelWijzigen" value="Artikel Wijzigen">
        </div>
      </form>
    </div>
  </body>
</html>
