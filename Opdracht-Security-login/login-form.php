<?php
session_start();
$message = '';
$messageType = '';
$registrationFormName = 'registratie-form.php';

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
    <title>Inloggen</title>
  </head>
  <body>
    <p><?=  $_SESSION['check'] ?></p>
    <h1 class="text-center">Inloggen</h1>
    <div class="<?= ($messageType) ? 'callout' : '' ?> <?= $messageType ?>">
      <p class="text-center "><?= $message ?></p>
    </div>
    <form action="login-process.php" method="post">
        <!-- EMAIL -->
      <div class="row medium-6 columns">
        <label for="email">e-mail</label>
        <input type="text" name="email" value="">
      </div>
      <!-- PASSWORD -->
      <div class="row medium-6 columns">
        <label for="password">paswoord</label>
        <div class="input-group">
          <input class="input-group-field" type="password" name="password" value="">

        </div>
        <!-- SEND -->
        <input class="button" type="submit" name="login" value="Login">
      </div>

      <p class="text-center">Nog geen account? Maak er dan eentje aan op de <a  href="<?= $registrationFormName ?>">registratiepagina</a>.</p>
    </form>
  </body>
</html>
