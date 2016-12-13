<?php
session_start();

include_once('partials/variables.php');


unset($_SESSION['login']);
unset($_SESSION['userid']);

setcookie('login', '', time()-3600);

  $_SESSION['notification']['type'] = "success";
  $_SESSION['notification']['text'] = "U bent uitgelogd. Tot de volgende keer.";
  header('refresh:3;url=' . $loginForm );

  //MESSAGE

  include_once('partials/message.php');


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
    <h1>Uitgelogd</h1>
    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

  </body>
</html>
