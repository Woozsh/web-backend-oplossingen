<?php
  session_start();
  $registrationFormName = 'registratie-form.php';
  $dashboard = "dashboard.php";

  //Generate Password on button press
  if(isset($_POST['generate']))
  {
    $generatedPassword = generatePassword(6);

    $_SESSION['generate']['email'] = $_POST['email'];

    $_SESSION['generate']['password'] = $generatedPassword;

    header('location: ' . $registrationFormName );
  }

  if(isset($_POST['send'])){
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['error']['type'] = "error";
        $_SESSION['error']['text'] = "Invalid email format";
        header('location: ' . $registrationFormName );
    }elseif($password == "")
    {
      $_SESSION['error']['type'] = "error";
      $_SESSION['error']['text'] = "Empty password";
      header('location: ' . $registrationFormName );
    }
    else
    {
        $db = new PDO("mysql:host=localhost;dbname=opdracht-security-login", "root", "");

        $queryCheckUser = "SELECT * FROM users WHERE email = :email";

        $statementCheckUser = $db->prepare($queryCheckUser);

        $statementCheckUser->bindValue(":email", $email);

        $statementCheckUser->execute();

        $userExists = array();

        while($row = $statementCheckUser->fetch(PDO::FETCH_ASSOC)){
          $userExists[] = $row;
        }

        if($userExists[0]['email'] == $email)
        {
          $_SESSION['error']['type'] = "error";
          $_SESSION['error']['text'] = $email . " adres is al in gebruik!";
          header('location: ' . $registrationFormName );
        }
        else
        {
          $salt = uniqid(mt_rand(), true);
          $saltedPassword = $password . $salt;
          $hashedPassword = hash('sha512', $saltedPassword);

          $queryAddUser = "INSERT INTO users(email, salt, hashed_password, last_login_time) VALUES(:email, :salt, :hashed_password, NOW()) ";

          $statementAddUser = $db->prepare($queryAddUser);

          $statementAddUser->bindValue(":email", $email);
          $statementAddUser->bindValue(":salt", $salt);
          $statementAddUser->bindValue(":hashed_password", $hashedPassword);

          $UserAdded = $statementAddUser->execute();

          if($UserAdded)
          {
            $_SESSION['error']['type'] = "success";
            $_SESSION['error']['text'] = "U bent met succes toegevoegd aan de database!";
            setcookie("login", $email . "," . hash('sha512', $email . $salt), time()+2592000);
            header('location: ' . $dashboard );
          }
        }

    }
    unset($_SESSION['generate']);
  }

  function generatePassword($length,$kleine = true, $grote = true, $cijfers = true, $special = false){

    $word = array();

    $special ? $min = 33 : ($cijfers ? $min = 48 : ($grote ? $min = 65 : $min = 97));

    $max = 122;

    for ($i=0; $i < $length; $i++) {
      $word[] = chr(rand($min,$max));
    }

    $password = implode("",$word);

    return $password;
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href="<?= $registrationFormName ?>"><?= $registrationFormName ?></a>
  </body>
</html>
