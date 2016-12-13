<?php

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

$user = $statementUser->fetch(PDO::FETCH_ASSOC);

$_SESSION['userid'] = $user['id'];

$salt = $user['salt'];
$newSaltedEmail = hash('sha512', $email . $salt);

if($newSaltedEmail != $saltedEmail)
{
  unset($_SESSION['login']);
  setcookie('login', '', time()-3600);
}
 ?>
