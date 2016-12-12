<?php
session_start();
include_once('partials/variables.php');

// redirect if logged in
if(isset($_COOKIE['login'])){
  header('location: ' . $dashboard );
}

//MESSAGE

include_once('partials/message.php');

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
    <h1 class="text-center">Inloggen</h1>
    <!-- messages -->
    <?php include_once('partials/message-show.php') ?>

    <!-- form -->
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

      <p class="text-center">Nog geen account? Maak er dan eentje aan op de <a  href="<?= $registrationForm ?>">registratiepagina</a>.</p>
    </form>
  </body>
</html>
