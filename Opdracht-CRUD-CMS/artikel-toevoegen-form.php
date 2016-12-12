<?php
session_start();
$loginForm = 'login-form.php';
$dashboard = 'dashboard.php';
$logoutForm = 'logout-form.php';
$artikelOverzicht = 'artikel-overzicht.php';
$artikelToevoegenForm = 'artikel-toevoegen-form.php';
$artikelToevoegenProcess = 'artikel-toevoegen-process.php';

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

//MESSAGE

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
    <link rel="stylesheet" href="css/master.css">
    <title>Artikels Toevoegen</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>
    <p><a href="<?= $artikelOverzicht ?>">Terug naar overzicht</a></p>

    <!-- messages -->
    <?php if(isset($message)): ?>
    <div class="<?= ($messageType) ? 'callout' : '' ?> <?= $messageType ?>">
      <p ><?= $message ?></p>
    </div>
  <?php endif; ?>
    <!-- context -->
    <div >
      <form action="<?= $artikelToevoegenProcess ?>" method="post">
        <div class="row">
          <h1 >Artikel Toevoegen</h1>

        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="titel">Titel</label>
            <input type="text" name="titel" value="">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="artikel">Artikel</label>
            <input type="text" name="artikel" value="">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="kernwoorden">Kernwoorden</label>
            <input type="text" name="kernwoorden" value="">
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <label for="datum">Datum (dd-mm-jj)</label>
            <input type="text" name="datum" value="">
          </div>
        </div>
        <div class="row">
          <input class="button" type="submit" name="artikelToevoegen" value="Artikel Toevoegen">
        </div>
      </form>
    </div>
  </body>
</html>
