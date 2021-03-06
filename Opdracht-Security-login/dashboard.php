<?php
session_start();
$loginForm = 'login-form.php';

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
var_dump( $_SESSION);

if(isset($_SESSION['error']['text'])) {
  $messageType = $_SESSION['error']['type'];
  $message = $_SESSION['error']['text'];
}
switch($messageType){
  case 'error': $messageType = 'alert';
  break;
  case 'success': $messageType = 'success';
  break;
  default: $messageType = '';
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../foundation.min.css">
    <title>Dashboard</title>
  </head>
  <body>
    <h1 class="text-center ">Dashboard</h1>
    <div class="<?= ($messageType) ? 'callout' : '' ?> <?= $messageType ?>" data-closable>
      <p class="text-center "><?= $message ?></p>
      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
    

  </body>
</html>
