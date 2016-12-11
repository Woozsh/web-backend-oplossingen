<?php
session_start();
$dashboard = 'dashboard.php';
$loginForm = 'login-form.php';

if(isset($_POST['login']))
{
  $email = $_POST['email'];
  $paswoord = $_POST['password'];

  $db = new PDO("mysql:host=localhost;dname=opdracht-security-login", "root", "");

  $query = 'SELECT * FROM users WHERE email = :email';

  $statement = $db->prepare($query);

  $statement->bindValue(':email', $email);

  $statement->execute();

  $user = array();

  while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $user[] = $row;
  }

  $_SESSION['check'] = $user[0]['email'];

  if($email != $user[0]['email'])
  {
    $_SESSION['error']['type'] = "error";
    $_SESSION['error']['text'] = "Email werd niet gevonden in de database.";
    header('location: ' . $loginForm );
  }
  else
  {
    $salt = $user[0]['salt'];
    $saltedPassword = $paswoord . $salt;
    $newHash = hash("sha512", $saltedPassword);
    $dbHash = $user['hashed_password'];

    if($newHash != $dbHash)
    {
      $_SESSION['error']['type'] = "error";
      $_SESSION['error']['text'] = "Het wachtwoord komt niet overeen met deze email.";
      header('location: ' . $loginForm );
    }
    else
    {
      $_SESSION['error']['type'] = "success";
      $_SESSION['error']['text'] = "U bent met succes ingelogd!";
      setcookie("login", $email . "," . hash('sha512', $email . $salt), time()+2592000);
      header('location: ' . $dashboard );
    }
  }
}


 ?>
