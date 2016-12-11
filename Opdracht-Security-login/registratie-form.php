<?php
session_start();
$email = '';
$paswoord = '';
$message = '';
$messageType = '';
$dashboard = "dashboard.php";
$loginForm = 'login-form.php';

if(isset($_COOKIE['login'])){
  header('location: ' . $dashboard );
}
if(isset($_SESSION['generate'])){
  $email = $_SESSION['generate']['email'];
  $paswoord = $_SESSION['generate']['password'];
}

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
    <link rel="stylesheet" href="css/master.css">
    <title>Registreren</title>
  </head>
  <body>
    <h1 class="text-center">Registreren</h1>
    <div class="<?= ($messageType) ? 'callout' : '' ?> <?= $messageType ?>">
      <p class="text-center "><?= $message ?></p>
    </div>
    <form action="registratie-process.php" method="post">
        <!-- EMAIL -->
      <div class="row medium-6 columns">
        <label for="email">e-mail</label>
        <input type="text" name="email" value="<?= $email ?>">
      </div>
      <!-- PASSWORD -->
      <div class="row medium-6 columns">
        <label for="password">paswoord</label>
        <div class="input-group">
          <input class="input-group-field" type="<?= ($paswoord != '') ? 'text' : 'password' ?>" name="password" value="<?= $paswoord ?>">
            <!-- GENERATE -->
          <div class="input-group-button">
            <input class="button" type="submit" name="generate" value="Genereer een paswoord">
          </div>
        </div>
        <!-- SEND -->
        <input class="button" type="submit" name="send" value="Registreer">
      </div>
      <p class="text-center">Ga naar de <a  href="<?= $loginForm ?>">login-pagina</a> als u al een account heeft.</p>

    </form>
  </body>
</html>
