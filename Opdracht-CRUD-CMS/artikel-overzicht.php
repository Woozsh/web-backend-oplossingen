<?php
session_start();
$loginForm = 'login-form.php';
$dashboard = 'dashboard.php';
$logoutForm = 'logout-form.php';
$artikelOverzicht = 'artikel-overzicht.php';
$artikelToevoegenForm = 'artikel-toevoegen-form.php';

if(!isset($_COOKIE['login']))
{
  $_SESSION['error']['type'] = "error";
  $_SESSION['error']['text'] = "U moet eerst inloggen.";
  header('location: ' . $loginForm );
}

$cookie = explode(",", $_COOKIE['login']);

$email = $cookie[0];
$saltedEmail = $cookie[1];
$db = new PDO("mysql:host=localhost;dbname=opdracht-security-login", "root", "");

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

//Artikels ophalen
try {
  $queryArtikelsOphalen = "SELECT * from artikels";

  $statementArtikels = $db->prepare($queryArtikelsOphalen);

  $statementArtikels->execute();

  $artikels = $statementArtikels->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  $_SESSION['error']['type'] = "error";
  $_SESSION['error']['text'] =  "Kon artikels niet ophalen." . $e->getMessage();
}


//MESSAGE
var_dump($artikels);
if(isset($_SESSION['error']['text'])) {
  $messageType = $_SESSION['error']['type'];
  $message = $_SESSION['error']['text'];
}
if(isset($messageType))
{
  switch($messageType)
  {
    case 'error': $messageType = 'alert';
    break;
    case 'success': $messageType = 'success';
    break;
    default: $messageType = '';
  }
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <title>Artikels</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>
    <h1 >Overzicht van Artikels</h1>

    <!-- messages -->
    <?php if(isset($message)): ?>
    <div class="<?= ($messageType) ? 'callout' : '' ?> <?= $messageType ?>">
      <p ><?= $message ?></p>
    </div>
  <?php endif; ?>
    <!-- context -->
    <div >
      <p><a href="<?= $artikelToevoegenForm ?>">Voeg een artikel toe</a></p>
      <?php foreach($artikels as $artikel): ?>
        <div class="">
          <?php if($artikel['is_archived'] != 1): ?>
            <?php ($artikel['is_active'] == 0) ? $isActive = true : $isActive = false?>
            <div class="">
              <h2><?= $artikel['titel'] ?></h2>
              <ul>
                <li>Artikel: <?= $artikel['artikel'] ?></li>
                <li>Kernwoorden: <?= $artikel['kernwoorden'] ?></li>
                <li>Datum: <?= $artikel['datum'] ?></li>
              </ul>
              <p><a href="#">artikel wijzigen</a> | <a href="#">artikel activeren</a> | artikel verwijderen</p>
            </div>
          <?php endif; ?>
      <?php endforeach; ?>
        </div>
    </div>
  </body>
</html>
