<?php
  session_start();
  include_once('partials/variables.php');


  //Generate Password on button press
  if(isset($_POST['generate']))
  {
    $generatedPassword = generatePassword(6);

    $_SESSION['generate']['email'] = $_POST['email'];

    $_SESSION['generate']['password'] = $generatedPassword;

    header('location: ' . $registrationForm );
  }

  if(isset($_POST['send'])){
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['notification']['type'] = "error";
        $_SESSION['notification']['text'] = "Invalid email format";
        header('location: ' . $registrationForm );
    }elseif($password == "")
    {
      $_SESSION['notification']['type'] = "error";
      $_SESSION['notification']['text'] = "Empty password";
      header('location: ' . $registrationForm);
    }
    else
    {
        $db = new PDO("mysql:host=localhost;dbname=opdracht-crud-cms", "root", "");

        $queryCheckUser = "SELECT * FROM users WHERE email = :email";

        $statementCheckUser = $db->prepare($queryCheckUser);

        $statementCheckUser->bindValue(":email", $email);

        $statementCheckUser->execute();

        $userExists  = $statementCheckUser->fetch(PDO::FETCH_ASSOC);

        if($userExists['email'] == $email)
        {
          $_SESSION['notification']['type'] = "error";
          $_SESSION['notification']['text'] = $email . " adres is al in gebruik!";
          header('location: ' . $registrationForm );
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
            $_SESSION['notification']['type'] = "success";
            $_SESSION['notification']['text'] = "U bent met succes toegevoegd aan de database!";
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
  
  header('location: ' . $registrationForm );

 ?>
