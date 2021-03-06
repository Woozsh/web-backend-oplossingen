<?php
session_start();
include_once('partials/variables.php');


if(isset($_POST['login']))
{
  $email = $_POST['email'];
  $paswoord = $_POST['password'];

  $db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

  $query = 'SELECT * FROM users WHERE email = :email';

  $statement = $db->prepare($query);

  $statement->bindValue(':email', $email);

  $statement->execute();

  $user = $statement->fetch(PDO::FETCH_ASSOC);


  if($email != $user['email'])
  {
    $_SESSION['notification']['type'] = "error";
    $_SESSION['notification']['text'] = "Email werd niet gevonden in de database.";
    header('location: ' . $loginForm );
  }
  else
  {
    $salt = $user['salt'];
    $saltedPassword = $paswoord . $salt;
    $newHash = hash("sha512", $saltedPassword);
    $dbHash = $user['hashed_password'];

    if($newHash != $dbHash)
    {
      $_SESSION['notification']['type'] = "error";
      $_SESSION['notification']['text'] = "Het wachtwoord komt niet overeen met deze email.";
      header('location: ' . $loginForm );
    }
    else
    {
      $_SESSION['notification']['type'] = "success";
      $_SESSION['notification']['text'] = "U bent met succes ingelogd!";
      setcookie("login", $email . "," . hash('sha512', $email . $salt), time()+2592000);
      header('location: ' . $dashboard );
    }
  }
}

header('location: ' . $loginForm );

 ?>
