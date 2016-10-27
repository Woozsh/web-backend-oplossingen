<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sessions</title>
    <link rel="stylesheet" href="../foundation.min.css" media="screen" title="no title">
  </head>
  <body>
    <h1>Deel 1: Registratie gegevens</h1>
    <form class="" action="adrespagina.php" method="post">
      <div class="row">
        <label for="mail">E-mail</label>
        <input type="email" name="mail" id="mail" required>
        <label for="nickname">Nickname</label>
        <input type="text" name="nickname" id="nickname" required>
        <input type="submit" name="volgende" class="button" value="Volgende">
      </div>

    </form>
  </body>
</html>
