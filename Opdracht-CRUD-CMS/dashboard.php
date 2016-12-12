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
$db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

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

//MESSAGE

include_once('partials/message.php');

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <title>Dashboard</title>
  </head>
  <body>
    <!-- topbar -->
    <p ><a href="<?= $dashboard ?>">Terug naar Dashboard</a> | Ingelogd als <?= $cookie[0] ?> | <a href="<?= $logoutForm ?>">uitloggen</a></p>

    <!-- titel -->
    <h1 >Dashboard</h1>

    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

    <!-- context -->
    <div >
      <ul>
        <li><a href="<?= $artikelOverzicht ?>">Artikels</a></li>
      </ul>
    </div>
  </body>
</html>
