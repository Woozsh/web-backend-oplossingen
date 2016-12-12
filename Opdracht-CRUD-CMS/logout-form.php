<?php
session_start();

$message = '';
$messageType = '';
$loginForm = 'login-form.php';

unset($_SESSION['login']);
setcookie('login', '', time()-3600);

  $_SESSION['error']['type'] = "success";
  $_SESSION['error']['text'] = "U bent uitgelogd. Tot de volgende keer.";
  header('refresh:3;url=' . $loginForm );

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
    <title>Uitgelogd</title>
  </head>
  <body>
    <h1 class="text-center">Uitgelogd</h1>
    <div class="<?= ($messageType) ? 'callout' : '' ?> <?= $messageType ?>">
      <p class="text-center "><?= $message ?></p>
    </div>
  </body>
</html>
